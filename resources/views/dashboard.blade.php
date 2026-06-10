<x-dashboard-imports>
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
          <div class="col-sm-6 mb-3">
            <h3 class="mb-0 font-weight-bold article-title">Dashboard | <span class="lead welcome">Welcome!</span></h3>
          </div>
        </div>
        <div class="row mt-3">

          {{-- Total Customers --}}

          <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
            <a href="{{ route('customers.index') }}" class="dash-link">
              <div class="card card-border">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="fa-solid fa-user-group mr-3 dash-icons"></i>
                    <div class="d-flex flex-column align-items-stretch">
                      <h4 class="card-title dash-card-title mb-1">Customers</h4>
                      <span class="counter col-number-1"
                            data-count="{{ $totalCustomers ?? 0 }}"
                            data-separator="true">0</span>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

          {{-- Total Orders --}}

          <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
            <a href="{{ route('orders.index') }}" class="dash-link">
              <div class="card card-border">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="fa-solid fa-shirt mr-3 dash-icons"></i>
                    <div class="d-flex flex-column align-items-stretch">
                      <h4 class="card-title dash-card-title mb-1">Total Orders</h4>
                      <span class="counter col-number-1"
                            data-count="{{ $totalOrders ?? 0 }}"
                            data-separator="true">0</span>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

          {{-- Ready to Delivery --}}

          <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
            <a href="{{ route('orders.ready') }}" class="dash-link">
              <div class="card card-border">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="fa-brands fa-black-tie mr-3 dash-icons"></i>
                    <div class="d-flex flex-column align-items-stretch">
                      <h4 class="card-title dash-card-title mb-1">Ready for Delivery</h4>
                      <span class="counter col-number-1"
                            data-count="{{ $readyOrders ?? 0 }}"
                            data-separator="true">0</span>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

          {{-- Orders BarChart --}}

          <div class="col-sm-12 col-md-12 mb-4">
            <div class="card chart-card">
              <div class="card-body">
                <h4>Monthly Orders (This Year)</h4>

                <div class="chart-wrapper">
                  <canvas id="monthlyBarChart"></canvas>
                </div>

              </div>
            </div>
          </div>

          {{-- Pending Orders --}}

          <div class="col-sm-6 col-md-6 col-lg-6 mb-4">
            <a href="{{ route('orders.pending') }}" class="dash-link">
              <div class="card card-border">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="fa-solid fa-clock mr-3 dash-icons"></i>
                    <div class="d-flex flex-column align-items-stretch">
                      <h4 class="card-title dash-card-title mb-1">Pending Orders</h4>
                      <span class="counter col-number-1"
                            data-count="{{ $pendingOrders ?? 0 }}"
                            data-separator="true">0</span>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

          {{-- Urgent Orders --}}

          <div class="col-sm-6 col-md-6 col-lg-6 mb-4">
            <a href="{{ route('orders.urgent') }}" class="dash-link">
              <div class="card card-border">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="fa-solid fa-scissors mr-3 dash-icons"></i>
                    <div class="d-flex flex-column align-items-stretch">
                      <h4 class="card-title dash-card-title mb-1">Urgent Orders</h4>
                      <span class="counter col-number-1"
                            data-count="{{ $urgentOrders ?? 0 }}"
                            data-separator="true">0</span>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

          {{-- Total Revenue --}}

          <div class="col-sm-12 col-md-12 mb-4">
            <a href="{{ route('payments.index') }}" class="dash-link">
              <div class="card card-border">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="fa-solid fa-coins mr-3 dash-icons"></i>
                    <div class="d-flex flex-column align-items-stretch">
                      <h4 class="card-title dash-card-title mb-1">Total Revenue</h4>
                      <span class="col-number-1 counter" data-count="{{ $totalRevenue ?? 0 }}" data-separator="true">0</span>
                    </div>
                  </div>
                </div>
              </div>
            </a>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function () {

      const canvas = document.getElementById('monthlyBarChart');

      if (!canvas) return;

      const ctx = canvas.getContext('2d');

      new Chart(ctx, {
          type: 'bar',
          data: {
              labels: [
                  "Jan","Feb","Mar","Apr","May","Jun",
                  "Jul","Aug","Sep","Oct","Nov","Dec"
              ],
              datasets: [{
                  label: "Orders",
                  data: @json($orderData ?? []),
                  backgroundColor: 'rgba(120, 64, 7, 0.8)',
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              resizeDelay: 0,
              animation: false,
              scales: {
                  x: {
                      grid: { display: false }
                  },
                  y: {
                      beginAtZero: true,
                      ticks: { precision: 0 }
                  }
              }
          }
      });

  });
</script>

</x-dashboard-imports>