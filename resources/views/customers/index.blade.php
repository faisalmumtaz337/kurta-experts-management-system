<x-dashboard-imports title="Customers">
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
            <h3 class="mb-2 font-weight-bold article-title">Customers</h3>
            <a class="btn-sm btn-inverse-warning custom-btn" href="{{ route('customers.create') }}">
              <i class="fa-solid fa-plus"></i> Add New Customer
            </a>
          </div>
          <div class="col-sm-12 mb-3">
            <x-breadcrumb :items="[
                ['title' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'fa-solid fa-chart-line'],
                ['title' => 'Customers', 'url' => '', 'icon' => 'fa-solid fa-users'],
            ]" />
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between small-screen">
              <h4 class="card-title">Customers Information</h4>
              <div class="form-group">
                <div class="input-icon">
                  <i class="fa fa-search"></i>
                  <input name="search" id="customerSearch" placeholder="name, contact and customer #" class="form-control form-control-sm search-input input-small-screen" />
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Contact #</th>
                    <th>Customer #</th>
                    <th>Address</th>
                    <th class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody id="customerTableBody">
                  @include('customers.partials.customer-table-body', ['customers' => $customers])
                </tbody>
              </table>
              {{ $customers->links('vendor.kurta-experts-pagination.custom') }}
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