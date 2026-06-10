<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $employees = Employee::all();

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'caste'             => 'nullable|string|max:255',
            'phone'             => 'required|string|max:20',
            'role'              => 'required|string|max:255',
            'employee_payments' => 'nullable|numeric',
            'joining_date'      => 'required|date',
        ]);

        // Get last machine number
        $lastNumber = Employee::max('machine_number');

        // If null start from 01 else increment
        $nextNumber = $lastNumber ? ((int)$lastNumber + 1) : 1;

        // Format to 2 digits (01, 02, 10)
        $validated['machine_number'] = str_pad($nextNumber, 2, '0', STR_PAD_LEFT);

        Employee::create($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee): View
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee): RedirectResponse
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'caste'             => 'nullable|string|max:255',
            'phone'             => 'required|string|max:20',
            'role'              => 'required|string|max:255',
            'employee_payments' => 'nullable|numeric',
            'joining_date'      => 'required|date',
        ]);

        // Update employee information
        $employee->update($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        DB::transaction(function () use ($employee) {
            $employee->delete();
        });

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully');
    }
}
