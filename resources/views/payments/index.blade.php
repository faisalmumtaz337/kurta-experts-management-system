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
            <h3 class="mb-2 font-weight-bold article-title">Payments</h3>
          </div>
          <div class="col-sm-12 mb-3">
            <x-breadcrumb :items="[
              ['title' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'fa-solid fa-chart-line'],
              ['title' => 'Payments', 'url' => '', 'icon' => 'fa-solid fa-coins'],
            ]" />
          </div>
          <div class="col-sm-12 d-flex justify-content-end">
            <a class="btn-sm btn-inverse-warning custom-btn mb-3" href="{{ route('employee-payments.index') }}">
              <i class="fa-solid fa-user-group"></i> Employees Payment
            </a>
          </div>
        </div>
        <div class="row">

          {{-- Total Received --}}

          <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-wrap justify-content-start">
                  <i class="fa-solid fa-wallet mr-3 dash-icons"></i>
                  <div class="d-flex flex-column align-items-stretch">
                    <h4 class="card-title dash-card-title mb-1">Total Received</h4>
                    <span class="counter col-number-1"
                          data-count="{{ $totalReceived ?? 0 }}"
                          data-separator="true">0</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- Pending Dues --}}

          <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
            <a href="{{ route('pending-dues') }}" class="dash-link">
              <div class="card card-border">
                <div class="card-body">
                  <div class="d-flex flex-wrap justify-content-start">
                    <i class="fa-solid fa-clock mr-3 dash-icons"></i>
                    <div class="d-flex flex-column align-items-stretch">
                      <h4 class="card-title dash-card-title mb-1">Pending Dues</h4>
                      <span class="counter col-number-1"
                            data-count="{{ $pendingDues ?? 0 }}"
                            data-separator="true">0</span>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

          {{-- Today Received --}}

          <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-wrap justify-content-start">
                  <i class="fa-solid fa-coins mr-3 dash-icons"></i>
                  <div class="d-flex flex-column align-items-stretch">
                    <h4 class="card-title dash-card-title mb-1">Today Received</h4>
                    <span class="counter col-number-1"
                      data-count="{{ $todayReceived ?? 0 }}"
                      data-separator="true">0</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between small-screen">
                  <h4 class="card-title">Payment Records</h4>
                  <div class="form-group">
                    <div class="input-icon">
                      <i class="fa fa-search"></i>
                      <input name="search" id="paymentSearch" placeholder="Payment Search" class="form-control form-control-sm search-input input-small-screen" />
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Invoice #</th>
                        <th>Customer</th>
                        <th>Received Amount</th>
                        <th>Total Amount</th>
                        <th>Method</th>
                        <th>Type</th>
                        <th>Payment Date</th>
                        <th class="text-right">Actions</th>
                      </tr>
                    </thead>
                    <tbody id="paymentTableBody">
                      @include('payments.partials.payment-table-body', ['payments' => $payments])
                    </tbody>
                  </table>
                  <div id="paginationWrapper">
                      {{ $payments->links('vendor.kurta-experts-pagination.custom') }}
                  </div>
                </div>
              </div>
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