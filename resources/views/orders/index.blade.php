<x-dashboard-imports title="Orders">
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
            <h3 class="mb-2 font-weight-bold article-title">Orders</h3>
            <a class="btn-sm btn-inverse-warning custom-btn" href="{{ route('orders.create') }}">
              <i class="fa-solid fa-book"></i> Booking New Order
            </a>
          </div>
          <div class="col-sm-12 mb-3">
            <x-breadcrumb :items="[
                ['title' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'fa-solid fa-chart-line'],
                ['title' => 'Orders', 'url' => '', 'icon' => 'fa-solid fa-paper-plane'],
            ]" />
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between small-screen">
              <h4 class="card-title">Orders Information</h4>
              <div class="form-group">
                <div class="input-icon">
                  <i class="fa fa-search"></i>
                  <input name="search" id="orderSearch" placeholder="order #, customer and status" class="form-control form-control-sm search-input input-small-screen" />
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Quantity</th>
                    <th>Booking Date</th>
                    <th>Delivery Date</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody id="orderTableBody">
                  @include('orders.partials.order-table-body', ['orders' => $orders])
                </tbody>
              </table>
              {{ $orders->links('vendor.kurta-experts-pagination.custom') }}
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