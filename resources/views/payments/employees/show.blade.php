<x-dashboard-imports title="Payments">
  <x-header />
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->
    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <x-side-navbar />
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col sm 12">
            <x-flash-message />
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 d-flex justify-content-between">
            <h3 class="mb-3 font-weight-bold article-title">Payments | <span class="lead welcome">Payments History</span></h3>
          </div>
          <div class="col-sm-12 mb-3">
            <x-breadcrumb :items="[
              ['title' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'fa-solid fa-chart-line'],
              ['title' => 'Payments', 'url' => route('payments.index'), 'icon' => 'fa-solid fa-coins'],
              ['title' => 'Details', 'url' => '', 'icon' => 'fa-solid fa-info-circle'],
            ]" />
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between small-screen">
              <h4 class="card-title">Employee Payments Details</h4>
            </div>
              <div class="row">

                {{-- Employee --}}

                <div class="col-sm-6">
                  <div class="form-group">
                    <x-text-input label="Employee" value="{{ $employee_payment->employee->name . ' ' . $employee_payment->employee->caste }}" disabled />
                  </div>
                </div>

                {{-- Paid Amount --}}

                <div class="col-sm-6">
                  <div class="form-group">
                    <x-text-input label="Paid Amount" value="{{ $employee_payment->amount }}" disabled />
                  </div>
                </div>

                {{-- Payment Type --}}

                <div class="col-sm-6">
                  <div class="form-group">
                    <x-text-input label="Payment Type" value="{{ ucfirst($employee_payment->payment_type) }}" disabled />
                  </div>
                </div>

                {{-- Payment Method --}}

                <div class="col-sm-6">
                  <div class="form-group">
                    <x-text-input label="Payment Method" value="{{ ucfirst($employee_payment->payment_method) }}" disabled />
                  </div>
                </div>

                {{-- Payment Date --}}

                <div class="col-sm-12">
                  <div class="form-group">
                    <x-text-input label="Payment Date" value="{{ date('d-m-Y', strtotime($employee_payment->payment_date)) }}" disabled />
                  </div>
                </div>

                {{-- Notes --}}

                @if($employee_payment->notes)
                <div class="col-sm-12">
                  <div class="form-group">
                    <x-text-input label="Notes" value="{{ $employee_payment->notes }}" disabled />
                  </div>
                </div>
                @endif
              </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <x-footer />
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
</x-dashboard-imports>