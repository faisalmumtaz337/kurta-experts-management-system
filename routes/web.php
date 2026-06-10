<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeePaymentController;
use App\Http\Controllers\EmployeeWorkController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
=====================================================
===== KURTA EXPERTS MANAGEMENT SYSTEM (ROUTES) ======
=====================================================
*/

Route::get('/', function () {
  return redirect()->route('login');
});

// Auth routes
Route::middleware('guest')->group(function () {
  // INDEX PAGE - Login
  Route::get('/login', [LoginController::class, 'index'])->name('login');
  Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Secure dashboard routes
Route::middleware(['auth', 'role:Admin'])->group(function () {
  // DASHBOARD ===================================
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  // CUSTOMERS / MEASUREMENTS ===================================

  // Customer search
  Route::get('/customers/search', [CustomerController::class, 'search'])
    ->name('customers.search');

  // Customers CRUD
  Route::resource('/customers', CustomerController::class)->except('update');

  // Measurements
  Route::get('/measurements/create', [CustomerController::class, 'createMeasurement'])
    ->name('measurements.create');

  // Update customer, measurement
  Route::put('/customers/{customer}/measurement', [CustomerController::class, 'updateMeasurement'])
    ->name('measurements.update');

  Route::post('/measurements/store', [CustomerController::class, 'storeMeasurement'])
    ->name('measurements.store');

  // ORDERS ======================================

  // Order customer search
  Route::get('/order-customers/search', [OrderController::class, 'search'])
    ->name('order-customers.search');

  // Order search
  Route::get('/orders/search', [OrderController::class, 'orderSearch'])->name('orders.search');

  // Pending order
  Route::get('/orders/pending-orders', [OrderController::class, 'pendingOrders'])->name('orders.pending');

  // Urgent order
  Route::get('/orders/urgent-orders', [OrderController::class, 'urgentOrders'])->name('orders.urgent');

  // Ready for delivery order
  Route::get('/orders/ready-orders', [OrderController::class, 'readyForDelivery'])->name('orders.ready');

  Route::resource('/orders', OrderController::class);

  // EMPLOYEES ===================================

  // Employee work search
  Route::get('/employee-work/search', [EmployeeWorkController::class, 'employeeWorkSearch'])
    ->name('employee-work-search');

  Route::resource('/employees', EmployeeController::class)->except('show');

  // PAYMENTS ====================================

  // Order payment search
  Route::get('/order-payments/search', [PaymentController::class, 'search'])
    ->name('order-payments.search');

  Route::get('/payments/pending-dues', [PaymentController::class, 'pendingAmount'])
    ->name('pending-dues');

  // Payment history
  Route::get('/employee-payments/payment-history', [EmployeePaymentController::class, 'paymentHistory'])
    ->name('employee-payments.payment-history');

  // Employee payments search
  Route::get('/employee-payments/search', [EmployeePaymentController::class, 'employeePaymentSearch'])
    ->name('employee-payment-search');

  // Employee payments
  Route::resource('/employee-payments', EmployeePaymentController::class);
  Route::resource('/employee-works', EmployeeWorkController::class);

  Route::resource('/payments', PaymentController::class)
    ->except('create', 'store');

  // USERS ===================================
  Route::resource('/users', UserController::class);

  // INVOICES ===================================
  Route::get('/order-invoice/{id}', [OrderController::class, 'orderInvoice'])
    ->name('order-invoice');
  Route::get('/measurement-invoice/{id}', [CustomerController::class, 'measurementInvoice'])
    ->name('measurement-invoice');
});

Route::get('/register', [LoginController::class, 'create'])->name('create.user');
Route::post('/register', [LoginController::class, 'store'])->name('store');
