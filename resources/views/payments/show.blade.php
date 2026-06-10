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
          <div class="col-sm-12">
            <h3 class="mb-2 font-weight-bold article-title">Payments</h3>
          </div>
          <div class="col-sm-12 mb-3">
            <x-breadcrumb :items="[
                ['title' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'fa-solid fa-chart-line'],
                ['title' => 'Payments', 'url' => route('payments.index'), 'icon' => 'fa-solid fa-coins'],
                ['title' => 'Details', 'url' => '', 'icon' => 'fa fa-info-circle'],
            ]" />
          </div>
          <div class="col-sm-12 d-flex justify-content-end mb-3">
            <div class="d-flex justify_content_end">
              <a class="btn-sm btn-inverse-light cancel-btn table-link mx-3" href="{{ route('payments.edit', $payment->id) }}">
                <i class="fa fa-pencil"></i> Edit
              </a>
              <a class="btn-sm btn-inverse-danger delete-btn table-link" data-toggle="modal" data-target="#deleteCustomer{{ $payment->id }}">
                <i class="fa-solid fa-trash-can"></i> Delete
              </a>

              <div class="modal fade" id="deleteCustomer{{ $payment->id }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5>Confirm Delete</h5>
                      <button class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                      Are you sure you want to delete this record?
                    </div>

                    <div class="modal-footer">
                      <form action="{{ route('payments.destroy', $payment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-lighter cancel-btn" data-dismiss="modal"><i class="fa fa-circle-xmark"></i> Cancel</button>
                        <button type="submit" class="btn btn-inverse-warning custom-btn"><i class="fa-solid fa-trash-can"></i> Delete</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Payment Information</h4>
                <div class="col-sm-12 d-flex justify-content-end mb-2">
                  <span>Order #: <strong class="pl-2">{{ $payment->order->order_number }}</strong></span>
                </div>
                <div class="col-sm-12 d-flex justify-content-end mb-2">
                  <span>Payment Method: <strong class="text-{{ 
                    $payment->payment_method === 'cash' ? 'warning' : ''
                  }} pl-2">{{ ucfirst($payment->payment_method) }}</strong></span>
                </div>
                <div class="col-sm-12 d-flex justify-content-end mb-2">
                  <span>Payment Type: <strong class="text-{{ 
                    $payment->payment_type === 'pending' ? 'warning' : 
                    ($payment->payment_type === 'advance' ? 'secondary' : 
                    ($payment->payment_type === 'final' ? 'success' : ''))
                  }} pl-2">{{ ucfirst($payment->payment_type) }}</strong></span>
                </div>
                <div class="row">
                  <div class="col-md-12 mb-2">
                    <x-text-input type="text" label="Customer" value="{{ $payment->customer->name . ' ' .$payment->customer->caste }}" disabled />
                  </div>
                  <div class="col-md-12 mb-2">
                    <x-text-input type="text" label="Payment Date" value="{{ $payment->payment_date }}" disabled />
                  </div>
                  <div class="col-md-4 mb-2">
                    <x-text-input type="text" label="Total Amount" value="{{ $payment->order->total_amount }}" disabled />
                  </div>
                  <div class="col-md-4 mb-2">
                    <x-text-input type="text" label="Paid Amount" value="{{ $payment->amount }}" disabled />
                  </div>
                  <div class="col-md-4 mb-2">
                    <x-text-input type="text" label="Remaining Amount" value="{{ $payment->order->total_amount - $payment->amount }}" disabled />
                  </div>
                  <div class="col-md-6 mb-2">
                    <x-text-input type="text" label="Payment Method" value="{{ ucfirst($payment->payment_method) }}" disabled />
                  </div>
                  <div class="col-md-6 mb-2">
                    <x-text-input type="text" label="Payment Type" value="{{ 
                      ucfirst($payment->payment_type)
                      }}" disabled />
                  </div>
                  @if($payment->notes)
                  <div class="col-md-12 mb-2">
                    <x-text-input type="text" label="Note" value="{{ $payment->notes }}" disabled />
                  </div>
                  @endif
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