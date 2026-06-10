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
          </div>
          <div class="col-sm-12 mb-3">
            <x-breadcrumb :items="[
                ['title' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'fa-solid fa-chart-line'],
                ['title' => 'Orders', 'url' => route('orders.index'), 'icon' => 'fa-solid fa-paper-plane'],
                ['title' => 'Ready for Delivery', 'url' => '', 'icon' => 'fa-brands fa-black-tie'],
            ]" />
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between small-screen">
              <h4 class="card-title">Ready of Delivery Orders Information</h4>
            </div>
            <div class="table-responsive">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Quantity</th>
                    <th>Booking Date</th>
                    <th>Delivery Date</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($orders as $order)
                  <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>
                      <span class="pl-2">{{ $order->customer->name . ' ' . $order->customer->caste }}</span>
                    </td>
                    <td>{{ $order->suit_quantity }}</td>
                    <td>{{ date('d-m-Y', strtotime($order->order_date)) }}</td>
                    <td>{{ date('d-m-Y', strtotime($order->delivery_date)) ?? '-' }}</td>
                    <td>
                      <x-badge type="{{ 
                          $order->status === 'Packing' ? 'warning' : ''
                      }}">
                      Ready
                    </x-badge>
                    </td>
                    <td class="d-flex justify-content-end">
                      <a class="btn-sm btn-light cancel-btn table-link" href="{{ route('orders.show', $order->id) }}">
                        <i class="fa-solid fa-circle-info"></i> Details
                      </a>
                    </td>
                  </tr>
                  @empty 
                  <tr>
                    <td colspan="9" class="text-center text-muted">
                      No Orders Found
                    </td>
                  </tr>
                  @endforelse
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