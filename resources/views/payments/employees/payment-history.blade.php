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
              ['title' => 'Employee Payments History', 'url' => '', 'icon' => 'fa-solid fa-clock'],
            ]" />
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between small-screen">
              <h4 class="card-title">Employee Payments History</h4>
              <div class="form-group">
                <div class="input-icon">
                  <i class="fa fa-search"></i>
                  <input name="search" id="employeePaymentSearch" placeholder="Employee Search" class="form-control form-control-sm search-input input-small-screen" />
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Employee</th>
                    <th>Paid Amount</th>
                    <th>Payment Date</th>
                    <th class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody id="employeePaymentTableBody">
                  @include('payments.employees.partials.employee-payments-table-body', ['payments' => $payments])
                </tbody>
              </table>
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