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
            <h3 class="mb-3 font-weight-bold article-title">Payments | <span class="lead welcome">Pending Dues</span></h3>
          </div>
          <div class="col-sm-12 mb-3">
            <x-breadcrumb :items="[
              ['title' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'fa-solid fa-chart-line'],
              ['title' => 'Payments', 'url' => route('payments.index'), 'icon' => 'fa-solid fa-coins'],
              ['title' => 'Pending Dues', 'url' => '', 'icon' => 'fa-solid fa-clock'],
            ]" />
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between small-screen">
              <h4 class="card-title">Pending Dues Orders Information</h4>
            </div>
            <div class="table-responsive">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Order #</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Pending Dues</th>
                    <th class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($pendingOrders as $order)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->customer->name . ' ' . $order->customer->caste }}</td>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ number_format($order->total_amount, 1) }}</td>
                    <td>{{ number_format($order->paid_amount ?? 0, 1) }}</td>
                    <td>{{ number_format($order->total_amount - ($order->paid_amount ?? 0), 1) }}</td>
                    <td class="d-flex justify-content-end">
                      @php
                          $latestPaymentId = $order->payments->sortByDesc('id')->first()?->id;
                      @endphp

                      <a class="btn-sm btn-light cancel-btn table-link"
                        href="{{ $latestPaymentId ? route('payments.edit', $latestPaymentId) : '#' }}">
                          <i class="fa-solid fa-circle-info"></i> Edit
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
              {{ $pendingOrders->links('vendor.kurta-experts-pagination.custom') }}
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