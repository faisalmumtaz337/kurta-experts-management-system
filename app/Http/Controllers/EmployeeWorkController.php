<?php

namespace App\Http\Controllers;

use App\Models\EmployeeWork;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeWorkController extends Controller
{
    // Index - resource
    public function index(): View
    {
        $employees = EmployeeWork::with(['employee', 'order'])->latest()->paginate(20);

        return view('employees.works.index', compact('employees'));
    }

    // Employee work search resource
    public function employeeWorkSearch(Request $request): View
    {
        $search = $request->get('search');

        $employees = EmployeeWork::with(['employee', 'order'])
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    // direct columns search
                    $q->where('work_type', 'LIKE', "%{$search}%")
                        ->orWhere('qty', 'LIKE', "%{$search}%")
                        ->orWhere('rate', 'LIKE', "%{$search}%");

                    // relation search: employee
                    $q->orWhereHas('employee', function ($q2) use ($search) {
                        $q2->where('name', 'LIKE', "%{$search}%");
                    });

                    // relation search: order
                    $q->orWhereHas('order', function ($q2) use ($search) {
                        $q2->where('order_number', 'LIKE', "%{$search}%");
                    });
                });
            })
            ->latest()
            ->paginate(20);

        // AJAX response (sirf table body return karo)
        return view('employees.works.partials.employee-work-table-body', compact('employees'));
    }
}
