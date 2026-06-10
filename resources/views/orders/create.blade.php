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
                ['title' => 'Booking New Order', 'url' => '', 'icon' => 'fa-solid fa-book']
            ]" />
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between small-screen">
              <h4 class="card-title">Place New Order</h4>
              <div class="form-group">
                <div class="input-icon">
                  <i class="fa fa-search"></i>
                  <input name="search" id="orderCustomerSearch" placeholder="Customer Search" class="form-control form-control-sm search-input input-small-screen" />
                </div>
              </div>
            </div>
            <form class="forms-sample" action="{{ route('orders.store') }}" method="POST">
              @csrf
              <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Select</th>
                      <th>Full Name</th>
                      <th>Customer Number</th>
                    </tr>
                  </thead>
                  <tbody id="orderCustomerTableBody">
                    @include('orders.partials.customer-table-body', ['customers' => $customers])
                  </tbody>
                </table>
                {{ $customers->links('vendor.kurta-experts-pagination.custom') }}
              </div>
              <div class="row">

                {{-- Total Amount --}}

                <div class="col-sm-6 mt-3">
                  <div class="form-group">
                    <x-text-input type="number" name="total_amount" label="Total Amount" placeholder="Total Amount" />
                  </div>
                </div>

                {{-- Paid Amount --}}

                <div class="col-sm-6 mt-3">
                  <div class="form-group">
                    <x-text-input type="number" name="paid_amount" label="Paid Amount" placeholder="Paid Amount" />
                  </div>
                </div>

                {{-- Delivery Date --}}

                <div class="col-sm-6">
                  <div class="form-group">
                    <x-text-input 
                      type="date" 
                      name="delivery_date" 
                      label="Delivery Date" 
                      placeholder="Delivery Date" 
                      value="{{ date('Y-m-d') }}"
                    />
                  </div>
                </div>

                {{-- Suit Quantity --}}

                <div class="col-sm-6">
                  <div class="form-group">
                    <x-text-input type="number" name="suit_quantity" label="Suit Quantity" placeholder="Suit Quantity" />
                  </div>
                </div>

                {{-- Note --}}

                <div class="col-sm-12">
                  <div class="form-group">
                    <x-text-input name="notes" label="Note" placeholder="Note" />
                  </div>
                </div>

                <div class="col-sm-12 row">
                  <div class="col-sm-12 mb-3">
                    <span>Suit Delivery Type</span>
                  </div>
                  <div class="col-sm-12 form-group row">

                    <div class="col-sm-3">
                      <div class="form-check">
                        <label for="normal" class="form-check-label">
                          <input type="radio" class="form-check-input" name="is_urgent" id="normal" value="0" checked>
                          Normal
                        <i class="input-helper"></i></label>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-check">
                        <label for="urgent" class="form-check-label">
                          <input type="radio" class="form-check-input" name="is_urgent" id="urgent" value="1">
                          Urgent
                        <i class="input-helper"></i></label>
                      </div>
                    </div>

                  </div>
                </div>

                <input type="hidden" name="customer_id" id="selectedCustomerId" />

                <div class="col-sm-12 d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary mr-2 custom-btn">
                    <i class="fa-solid fa-book"></i> Book
                  </button>
                </div>
              </div>
            </form>
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
  <script>
    document.addEventListener('change', function (e) {

        if (e.target.classList.contains('customer-checkbox')) {

            const customerId = e.target.value;

            document.getElementById('selectedCustomerId').value = customerId;
        }
    });
  </script>
</x-dashboard-imports>