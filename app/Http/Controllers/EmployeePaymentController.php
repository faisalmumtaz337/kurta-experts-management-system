<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeePayment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $employees = Employee::query()
            ->withSum('works', 'amount')
            ->withSum('payments', 'amount')
            ->havingRaw('COALESCE(works_sum_amount,0) - COALESCE(payments_sum_amount,0) != 0')
            ->paginate(15);

        return view('payments.employees.index', compact('employees'));
    }

    // Payment history details
    public function paymentHistory(): View
    {
        $payments = EmployeePayment::with('employee')->paginate(20);
        return view('payments.employees.payment-history', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $employeeId = $request->employee_id;

        $employees = Employee::with(['works', 'payments'])->get();
        $selectedEmployee = null;

        if ($employeeId) {
            $selectedEmployee = Employee::with(['works', 'payments'])
                ->find($employeeId);
        }

        return view('payments.employees.create', compact('employees', 'selectedEmployee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'employee_id'    => 'required|exists:employees,id',
            'amount'         => 'required|numeric|min:1',
            'payment_type'   => 'required',
            'payment_method' => 'required',
            'payment_date'   => 'required|date',
            'notes'          => 'nullable'
        ]);

        $employee = Employee::with(['works', 'payments'])
            ->findOrFail($validated['employee_id']);

        $earned = $employee->works->sum('amount');
        $paid   = $employee->payments->sum('amount');

        $balance = $earned - $paid;

        if ($validated['amount'] > $balance) {
            return back()->withErrors([
                'amount' => 'Payment exceeds remaining balance.'
            ])->withInput();
        }

        EmployeePayment::create($validated);

        return redirect()
            ->route('employee-payments.index')
            ->with('success', 'Payment added successfully.');
    }

    // Details the record
    public function show(EmployeePayment $employee_payment): View
    {
        return view('payments.employees.show', compact('employee_payment'));
    }

    // Employee payment search resource
    public function employeePaymentSearch(Request $request): View
    {
        $search = $request->get('search');

        $payments = EmployeePayment::with('employee')

            // SEARCH LOGIC
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    // EmployeePayment table columns (adjust if needed)
                    $q->where('amount', 'LIKE', "%{$search}%")
                        ->orWhere('payment_date', 'LIKE', "%{$search}%")
                        ->orWhere('notes', 'LIKE', "%{$search}%");

                    // Employee relation search
                    $q->orWhereHas('employee', function ($q2) use ($search) {
                        $q2->where('name', 'LIKE', "%{$search}%")
                            ->orwhere('caste', 'LIKE', "%{$search}%")
                            ->orWhere('phone', 'LIKE', "%{$search}%");
                    });
                });
            })

            ->latest()
            ->paginate(20);

        return view('payments.employees.partials.employee-payments-table-body', compact('payments'));
    }
}
