<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // All payment records
        $payments = Payment::with(['order', 'customer'])->latest()->paginate(25);

        // Total received
        $totalReceived = Payment::sum('amount');

        // Pending dues
        $pendingDues = Order::sum('total_amount') - $totalReceived;

        // Today received payment
        $todayReceived = Payment::whereDate('payment_date', today())
            ->sum('amount');

        return view('payments.index', compact(
            'payments',
            'totalReceived',
            'pendingDues',
            'todayReceived',
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment): View
    {
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment): View
    {
        return view('payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment): RedirectResponse
    {
        // Validate request data
        $validated = $request->validate([
            'payment_date'   => 'required|date',
            'new_payment'    => 'nullable|numeric|min:0',
            'payment_method' => 'required|string',
            'notes'          => 'nullable|string',
        ]);

        // Get current payment amount
        $currentAmount = $payment->amount;

        // Get new payment amount (default 0 if empty)
        $newPayment = $validated['new_payment'] ?? 0;

        // Calculate updated paid amount
        $updatedAmount = $currentAmount + $newPayment;

        // Get order total amount
        $totalAmount = $payment->order->total_amount;

        // Prevent payment from exceeding order total amount
        if ($updatedAmount > $totalAmount) {
            return back()
                ->withErrors([
                    'new_payment' => 'Payment amount cannot exceed total order amount.'
                ])
                ->withInput();
        }

        // Automatically determine payment type
        if ($updatedAmount <= 0) {
            $paymentType = 'pending';
        } elseif ($currentAmount == 0 && $updatedAmount < $totalAmount) {
            // First partial payment
            $paymentType = 'advance';
        } elseif ($updatedAmount < $totalAmount) {
            // Remaining partial payments
            $paymentType = 'installment';
        } else {
            // Full payment completed
            $paymentType = 'final';
        }

        // Update payment record
        $payment->update([
            'amount'         => $updatedAmount,
            'payment_method' => $validated['payment_method'],
            'payment_type'   => $paymentType,
            'payment_date'   => $validated['payment_date'],
            'notes'          => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('payments.show', $payment->id)
            ->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment): RedirectResponse
    {
        // Prevent deletion if payment is not final
        if ($payment->payment_type !== 'final') {
            return redirect()
                ->back()
                ->with('error', 'You cannot delete this payment. Only final payments can be deleted.');
        }

        // Delete only final payments
        DB::transaction(function () use ($payment) {
            $payment->delete();
        });

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment record deleted successfully');
    }

    // Order search in payment section 
    public function search(Request $request)
    {
        $search = trim($request->search);

        $payments = Payment::with(['order', 'customer'])
            ->where(function ($q) use ($search) {

                // PAYMENT TABLE FIELDS
                $q->where('payment_method', 'LIKE', "%{$search}%")
                    ->orWhere('payment_type', 'LIKE', "%{$search}%")
                    ->orWhere('amount', 'LIKE', "%{$search}%")

                    // ORDER RELATION
                    ->orWhereHas('order', function ($oq) use ($search) {
                        $oq->where('order_number', 'LIKE', "%{$search}%");
                    })

                    // CUSTOMER RELATION
                    ->orWhereHas('customer', function ($cq) use ($search) {
                        $cq->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('caste', 'LIKE', "%{$search}%")
                            ->orWhere('phone', 'LIKE', "%{$search}%");
                    });
            })
            ->latest()
            ->get();

        return view('payments.partials.payment-table-body', compact('payments'));
    }

    public function pendingAmount(): View
    {
        $pendingOrders = Order::with(['customer', 'payments'])
            ->withSum('payments', 'amount')
            ->whereRaw('total_amount > (select COALESCE(sum(amount), 0) from payments where payments.order_id = orders.id)')
            ->paginate(25);

        $pendingOrders->getCollection()->transform(function ($order) {
            $paid = $order->payments_sum_amount ?? 0;
            $order->paid_amount = $paid;
            $order->pending_amount = $order->total_amount - $paid;
            return $order;
        });

        return view('payments.pending-dues', compact('pendingOrders'));
    }
}
