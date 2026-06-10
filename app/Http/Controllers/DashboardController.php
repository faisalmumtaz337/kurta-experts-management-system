<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Customers count
        $totalCustomers = Customer::count();

        // Total orders count
        $totalOrders = Order::count();

        // Pending orders count
        $pendingOrders = Order::where('status', 'Pending')->count();

        // Padding orders count
        $readyOrders = Order::where('status', 'Packing')->count();

        // Urgent Order Count
        $urgentOrders = Order::where('is_urgent', 1)->count();

        // Total Revenue
        $totalRevenue = Payment::sum('amount');

        // Orders data for chart
        $monthlyOrders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('total', 'month');

        $orderData = [];

        for ($i = 1; $i <= 12; $i++) {
            $orderData[] = $monthlyOrders[$i] ?? 0;
        }

        return view('dashboard', compact(
            'totalCustomers',
            'totalOrders',
            'pendingOrders',
            'readyOrders',
            'urgentOrders',
            'orderData',
            'totalRevenue',
        ));
    }
}
