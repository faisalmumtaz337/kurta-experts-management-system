<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Measurement;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $customers = Customer::orderBy('created_at', 'desc')->paginate(25);

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('customers.create');
    }

    /**
     * Store a customer data in session.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate data
        $validatedData = $request->validate([
            'name' => 'required',
            'caste' => 'required',
            'phone' => 'required|max:11',
            'address' => 'nullable',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        // Profile Image Upload
        if ($request->hasFile('profile_image')) {

            $file = $request->file('profile_image');

            // extension
            $extension = $file->getClientOriginalExtension();

            // unique file name (UUID)
            $imageName = Str::uuid() . '.' . $extension;

            // store file
            $path = $file->storeAs('profile_images', $imageName, 'public');

            $validatedData['profile_image'] = $path;
        } else {
            // Default image
            $validatedData['profile_image'] = 'profile_images/avatar.png';
        }

        // Store customer data in SESSION
        session([
            'customer_data' => $validatedData,
            'customer_data_time' => now()
        ]);

        return redirect()->route('measurements.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $customer = Customer::with('measurement')->findOrFail($id);

        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $customer = Customer::with('measurement')->findOrFail($id);

        return view('customers.edit', compact('customer'));
    }

    // Create measurements resource
    public function createMeasurement()
    {
        $customer = session('customer_data');
        $time = session('customer_data_time');

        if (!$customer) {
            return redirect()->route('customers.create')
                ->with('error', 'First add customer info');
        }

        // If 30 mintues completed session will be expired
        if ($time && now()->diffInMinutes($time) > 30) {
            session()->forget(['customer_data', 'customer_data_time']);

            return redirect()->route('customers.create')
                ->with('error', 'Session expired, please re-enter customer');
        }

        $customer = (object) $customer;

        return view('customers.measurements.index', compact('customer'));
    }

    // Store measurement resource
    public function storeMeasurement(Request $request): RedirectResponse
    {
        // 1. Validate Measurement Data
        $validatedMeasurement = $request->validate([
            'length_type' => 'nullable|string|max:255',
            'length_value' => 'nullable|numeric',
            'length_cotton' => 'nullable|numeric',
            'length_washing_wear' => 'nullable|numeric',

            'shoulder' => 'nullable|numeric|between:0,999.99',
            'shoulder_type' => 'nullable|string|max:255',

            'chest' => 'nullable|numeric|between:0,999.99',
            'waist' => 'nullable|numeric|between:0,999.99',
            'hips' => 'nullable|numeric|between:0,999.99',

            'sleeve' => 'nullable|numeric|between:0,999.99',

            'cuff_type' => 'nullable|string|max:255',
            'cuff' => 'nullable|string|max:255',
            'front_pati' => 'nullable|string|max:255',
            'cuff_single' => 'nullable|string|max:255',
            'cuff_double' => 'nullable|string|max:255',

            'collar' => 'nullable|string|max:255',
            'collar_nok' => 'nullable|string|max:255',
            'pacho_extra' => 'nullable|string|max:255',
            'pocket_style' => 'nullable|string|max:255',
            'extra_pocket_style' => 'nullable|string|max:255',
            'front_pati_length' => 'nullable|string|max:255',
            'cover_pati' => 'nullable|string|max:255',
            'collar_value' => 'nullable|numeric|between:0,999.99',

            'sherwani' => 'nullable|string|max:255',
            'khasi' => 'nullable|string|max:255',
            'shirt_type' => 'nullable|string|max:255',

            'shalwar_value' => 'nullable|numeric|between:0,999.99',
            'shalwar_type' => 'nullable|string|max:255',
            'aasam' => 'nullable|string|max:255',

            'ankle_opening_value' => 'nullable|numeric|between:0,999.99',
            'ankle_type' => 'nullable|string|max:255',

            'sewing_type' => 'nullable|string|max:255',

            'golpati' => 'nullable|string|max:255',
            'golkani' => 'nullable|string|max:255',
            'chhati' => 'nullable|string|max:255',

            'extra_request_waist' => 'nullable|string|max:255',

            'pocket_type' => 'nullable|string|max:255',
            'pocket_size' => 'nullable|string|max:255',
            'extra_request_pocket' => 'nullable|string|max:255',

            'notes' => 'nullable|string',
        ]);

        // 2. Get Session Data
        $customerData = session('customer_data');
        $time = session('customer_data_time');

        if (
            !$customerData ||
            !$time ||
            now()->greaterThan(Carbon::parse($time)->addMinutes(30))
        ) {
            session()->forget(['customer_data', 'customer_data_time']);

            return redirect()->route('customers.create')
                ->with('error', 'Session expired, please re-enter customer');
        }

        try {
            DB::transaction(function () use ($customerData, $validatedMeasurement) {

                // 3. Customer Number Generate
                $lastCustomer = Customer::latest()->first();

                if ($lastCustomer && $lastCustomer->customer_number) {
                    $lastNumber = (int) substr($lastCustomer->customer_number, 4);
                    $nextNumber = $lastNumber + 1;
                } else {
                    $nextNumber = 1;
                }

                $customerData['customer_number'] = 'KEC-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

                // 4. Save Customer
                $customer = Customer::create($customerData);

                // 5. Save Measurement
                $validatedMeasurement['customer_id'] = $customer->id;
                Measurement::create($validatedMeasurement);
            });

            // 6. Clear Session
            session()->forget(['customer_data', 'customer_data_time']);

            return redirect()->route('customers.index')
                ->with('success', 'Customer information saved successfully');
        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateMeasurement(Request $request, Customer $customer): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'caste' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        DB::transaction(function () use ($request, $customer) {

            // -------------------------
            // CUSTOMER DATA UPDATE
            // -------------------------
            $customerData = $request->only([
                'name',
                'caste',
                'phone',
                'address',
            ]);

            // -------------------------
            // PROFILE IMAGE UPDATE
            // -------------------------
            if ($request->hasFile('profile_image')) {

                // DEFAULT IMAGE PROTECTION
                $defaultImage = 'profile_images/avatar.png';

                if (
                    $customer->profile_image &&
                    $customer->profile_image !== $defaultImage &&
                    Storage::disk('public')->exists($customer->profile_image)
                ) {
                    Storage::disk('public')->delete($customer->profile_image);
                }

                // NEW IMAGE UPLOAD
                $image = $request->file('profile_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();

                $path = $image->storeAs('profile_images', $filename, 'public');

                $customerData['profile_image'] = $path;
            }

            // UPDATE CUSTOMER
            $customer->update($customerData);

            // -------------------------
            // MEASUREMENT UPDATE
            // -------------------------
            $measurementData = $request->only([
                'length_type',
                'length_value',
                'length_cotton',
                'length_washing_wear',
                'shoulder',
                'shoulder_type',
                'chest',
                'waist',
                'hips',
                'sleeve',
                'cuff_type',
                'cuff',
                'front_pati',
                'cover_pati',
                'collar',
                'sherwani',
                'collar_value',
                'collar_nok',
                'pacho_extra',
                'pocket_style',
                'extra_pocket_style',
                'front_pati_length',
                'khasi',
                'shirt_type',
                'shalwar_value',
                'shalwar_type',
                'aasam',
                'ankle_opening_value',
                'ankle_type',
                'sewing_type',
                'notes',
                'cuff_single',
                'cuff_double',
                'golpati',
                'golkani',
                'chhati',
                'extra_request_waist',
                'pocket_type',
                'pocket_size',
                'extra_request_pocket',
            ]);

            $measurementData['cover_pati'] = $request->has('cover_pati') ? 'Cover Pati' : null;

            $customer->measurement()->updateOrCreate(
                ['customer_id' => $customer->id],
                $measurementData
            );
        });

        return redirect()
            ->route('customers.show', $customer->id)
            ->with('success', 'Customer information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        DB::transaction(function () use ($customer) {

            // Delete ONLY if it's not default image
            if (
                $customer->profile_image &&
                $customer->profile_image !== Customer::DEFAULT_PROFILE_IMAGE &&
                Storage::disk('public')->exists($customer->profile_image)
            ) {
                Storage::disk('public')->delete($customer->profile_image);
            }

            if ($customer->measurement) {
                $customer->measurement()->delete();
            }

            $customer->delete();
        });

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully');
    }

    // Customer search resource
    public function search(Request $request): View
    {
        $customers = Customer::search($request->search)
            ->latest()
            ->limit(20)
            ->get();

        return view('customers.partials.customer-table-body', compact('customers'));
    }

    public function measurementInvoice($id)
    {
        $customer = Customer::with('measurement')->findOrFail($id);

        $pdf = Pdf::loadView('invoices.measurement', compact('customer'))
            ->setPaper([0, 0, 226.77, 1000]); // 80mm width

        return $pdf->download('invoice-' . $id . '.pdf');
    }
}
