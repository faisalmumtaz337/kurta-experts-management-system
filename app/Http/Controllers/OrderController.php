<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\EmployeeWork;
use App\Models\Order;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(25);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $customers = Customer::orderBy('created_at', 'desc')->paginate(5);

        return view('orders.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id'   => 'required|exists:customers,id',
            'total_amount'  => 'nullable|numeric',
            'paid_amount'   => 'nullable|numeric',
            'suit_quantity' => 'required|numeric',
            'is_urgent'     => 'required|in:0,1',
            'notes'         => 'nullable|string',
            'delivery_date' => 'nullable|date|after_or_equal:today',
        ]);

        try {

            $order = DB::transaction(function () use ($validated) {

                // Load customer with latest measurement record
                $customer = Customer::with(['measurement' => function ($q) {
                    $q->latest();
                }])->findOrFail($validated['customer_id']);

                // Get latest measurement
                $measurement = $customer->measurement->first();

                if (!$measurement) {
                    throw new \Exception('Customer measurement not found.');
                }

                // Create a snapshot of measurement data for historical record
                $snapshot = $measurement->only([
                    'length_type',
                    'length_value',
                    'shoulder',
                    'chest',
                    'waist',
                    'hips',
                    'sleeve',
                    'cuff',
                    'front_pati',
                    'collar',
                    'suit_type'
                ]);

                // Generate next order number in a safe way using locking
                $lastNumber = DB::table('orders')
                    ->selectRaw("MAX(CAST(SUBSTRING(order_number, 5) AS UNSIGNED)) as max_no")
                    ->lockForUpdate()
                    ->value('max_no');

                $nextNumber = ($lastNumber ?? 0) + 1;
                $orderNumber = str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

                // Create order record
                $order = Order::create([
                    'order_number'         => $orderNumber,
                    'customer_id'          => $customer->id,
                    'measurement_snapshot' => $snapshot,
                    'status'               => 'Pending',
                    'total_amount'         => $validated['total_amount'] ?? 0,
                    'paid_amount'          => 0,
                    'suit_quantity'        => $validated['suit_quantity'],
                    'is_urgent'            => $validated['is_urgent'],
                    'notes'                => $validated['notes'] ?? null,
                    'order_date'           => now(),
                    'delivery_date'        => $validated['delivery_date'] ?? null,
                ]);

                // Convert paid amount into float for safe calculation
                $paidAmount = (float) ($validated['paid_amount'] ?? 0);

                // Create payment record as ledger entry (always created even if amount is zero)
                Payment::create([
                    'order_id'        => $order->id,
                    'customer_id'     => $customer->id,
                    'amount'          => $paidAmount,
                    'payment_method'  => 'cash',
                    'payment_type'    => $paidAmount > 0 ? 'advance' : 'pending',
                    'payment_date'    => now(),
                    'notes'           => $paidAmount > 0
                        ? 'Initial payment recorded at order creation'
                        : 'No advance payment received at order creation',
                ]);

                return $order;
            });

            // Load relationships for invoice generation
            $order = Order::with('customer', 'payments')->findOrFail($order->id);

            // Generate PDF invoice
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('invoices.order', [
                'order' => $order
            ])->setPaper([0, 0, 226.77, 1000], 'portrait');

            // Stream invoice in browser
            return $pdf->stream('invoice-' . $order->order_number . '.pdf');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $order = Order::with('customer')->findOrFail($id);

        $employee = $order->employees()
            ->where('employee_order.order_id', $order->id)
            ->latest('employee_order.created_at')
            ->first();

        return view('orders.show', compact('order', 'employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order): View
    {
        $employees = Employee::all();

        $employee = $order->employees()
            ->latest('employee_order.created_at')
            ->first();

        return view('orders.edit', compact('order', 'employees', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'suit_quantity' => 'nullable|numeric',
            'emp_qty'       => 'required|numeric',
            'status'        => 'required|in:Pending,Cutting,Stitching,Packing,Delivered',
            'notes'         => 'nullable|string',
            'rate'          => 'required|numeric',
            'delivery_date' => 'nullable|date',
            'employee_id'   => 'nullable|exists:employees,id',
        ]);

        try {

            DB::transaction(function () use ($validated, $request, $order) {

                /*
                |-----------------------------------------
                | 1. UPDATE ORDER
                |-----------------------------------------
                */
                $order->update([
                    'status'        => $validated['status'],
                    'suit_quantity' => $validated['suit_quantity'] ?? 0,
                    'notes'         => $validated['notes'] ?? null,
                    'delivery_date' => $validated['delivery_date'] ?? null,
                ]);

                /*
                |-----------------------------------------
                | 2. ONLY IF EMPLOYEE ASSIGNED
                |-----------------------------------------
                */
                if (
                    $request->filled('employee_id')
                    && $validated['status'] !== 'Pending'
                ) {

                    $employeeId = $request->employee_id;

                    /*
                    |-----------------------------------------
                    | 3. ASSIGN EMPLOYEE TO ORDER
                    |-----------------------------------------
                    */
                    $order->employees()->syncWithoutDetaching([
                        $employeeId => [
                            'work_type' => $validated['status']
                        ]
                    ]);

                    /*
                    |-----------------------------------------
                    | 4. PREVENT DUPLICATE EMPLOYEE WORK
                    |-----------------------------------------
                    */
                    $exists = EmployeeWork::where('employee_id', $employeeId)
                        ->where('order_id', $order->id)
                        ->where('work_type', $validated['status'])
                        ->exists();

                    if (!$exists) {

                        /*
                        |-----------------------------------------
                        | 5. RATE LOGIC (TEMPORARY ADMIN MAP)
                        |-----------------------------------------
                        */

                        if ($validated['emp_qty']) {
                            $qty = $validated['emp_qty'];
                        } else {
                            $qty = $order->suit_quantity ?? 1;
                        }


                        /*
                        |-----------------------------------------
                        | 6. CREATE EMPLOYEE WORK (EARNING)
                        |-----------------------------------------
                        */
                        EmployeeWork::create([
                            'employee_id' => $employeeId,
                            'order_id'    => $order->id,
                            'work_type'   => $validated['status'],
                            'qty'         => $qty,
                            'rate'        => $validated['rate'],
                            'amount'      => $qty * $validated['rate'],
                            'work_date'   => now(),
                            'notes'       => 'Auto generated from order update'
                        ]);
                    }
                }
            });

            return redirect()
                ->route('orders.show', $order->id)
                ->with('success', 'Order updated successfully.');
        } catch (ValidationException $e) {

            return back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {

            return back()->with(
                'error',
                'Order update failed: ' . $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): RedirectResponse
    {
        DB::transaction(function () use ($order) {
            $order->delete();
        });

        return redirect()->route('orders.index')
            ->with('success', 'Booking order deleted successfully');
    }

    // Order Customer Search resource
    public function search(Request $request): View
    {
        $customers = Customer::search($request->search)
            ->latest()
            ->limit(20)
            ->get();

        return view('orders.partials.customer-table-body', compact('customers'));
    }

    // Order general search resource
    public function orderSearch(Request $request): View
    {
        $search = $request->search;

        $orders = Order::with('customer')
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('order_number', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhereHas('customer', function ($q2) use ($search) {
                            $q2->where('name', 'like', "%{$search}%")
                                ->orWhere('phone', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->limit(50)
            ->get();

        return view('orders.partials.order-table-body', compact('orders'));
    }

    // Generate order invoice for printer
    public function orderInvoice($id)
    {
        $order = Order::with('customer')->findOrFail($id);

        $pdf = Pdf::loadView('invoices.order', compact('order'))
            ->setPaper([0, 0, 226.77, 1000]);
        // 80mm width

        return $pdf->download('invoice-' . $id . '.pdf');
    }

    // Pending orders resource
    public function pendingOrders(): View
    {
        $orders = Order::where('status', 'Pending')
            ->latest()
            ->paginate(20);

        return view('orders.pending-orders', compact('orders'));
    }

    // Urgent orders resource
    public function urgentOrders(): View
    {
        $orders = Order::where('is_urgent', 1)
            ->oldest()
            ->paginate(20);

        return view('orders.urgent-orders', compact('orders'));
    }

    // Ready for delivery resource
    public function ReadyForDelivery(): View
    {
        $orders = Order::where('status', 'Packing')
            ->oldest()
            ->paginate(20);

        return view('orders.ready-orders', compact('orders'));
    }
}
