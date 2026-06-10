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
          <div class="col-sm-12">
            <h3 class="mb-2 font-weight-bold article-title">Orders</h3>
          </div>
          <div class="col-sm-12 mb-3">
            <x-breadcrumb :items="[
                ['title' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'fa-solid fa-chart-line'],
                ['title' => 'Orders', 'url' => route('orders.index'), 'icon' => 'fa-solid fa-paper-plane'],
                ['title' => 'Order Details', 'url' => '', 'icon' => 'fa-solid fa-circle-info'],
            ]" />
          </div>
          <div class="col-sm-12 d-flex justify-content-end mb-3">
            <div class="d-flex justify_content_end">
              <a class="btn-sm btn-inverse-warning custom-btn" href="{{ route('order-invoice', $order->id) }}">
                <i class="fa-solid fa-print"></i> Print Invoice
              </a>
              <a class="btn-sm btn-inverse-light cancel-btn table-link mx-3" href="{{ route('orders.edit', $order->id) }}">
                <i class="fa fa-pencil"></i> Edit
              </a>
              <a class="btn-sm btn-inverse-danger delete-btn table-link" data-toggle="modal" data-target="#deleteCustomer{{ $order->id }}">
                <i class="fa-solid fa-trash-can"></i> Delete
              </a>

              <div class="modal fade" id="deleteCustomer{{ $order->id }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5>Confirm Delete</h5>
                      <button class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                      Are you sure you want to delete this order?
                    </div>

                    <div class="modal-footer">
                      <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
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
                <h4 class="card-title">Order Information</h4>
                <div class="col-sm-12 d-flex justify-content-end mb-2">
                  <span>Order #: <strong class="pl-2">{{ $order->order_number }}</strong></span>
                </div>
                <div class="col-sm-12 d-flex justify-content-end">
                  <span>Order Status: <strong class="text-{{ 
                    $order->status === 'Pending' ? 'warning' : 
                    ($order->status === 'Cutting' ? 'primary' : 
                    ($order->status === 'Stitching' ? 'secondary' : 
                    ($order->status === 'Packing' ? 'info' : 
                    ($order->status === 'Delivered' ? 'success' : ''))))
                  }} pl-2">{{ $order->status }}</strong></span>
                </div>
                <div class="row">
                  <div class="col-md-12 mb-4">
                    <x-text-input type="text" label="Full Name" value="{{ $order->customer->name . ' ' .$order->customer->caste }}" disabled />
                  </div>
                  <div class="col-md-6 mb-4">
                    <x-text-input type="text" label="Booking Date" value="{{ date('d-m-Y', strtotime($order->order_date)) }}" disabled />
                  </div>
                  <div class="col-md-6 mb-4">
                    <x-text-input type="text" label="Delivery Date" value="{{ $order->delivery_date ? date('d-m-Y', strtotime($order->delivery_date)) : '-' }}" disabled />
                  </div>
                  <div class="col-md-4 mb-4">
                    <x-text-input type="text" label="Total Amount" value="{{ number_format($order->total_amount, 1) }}" disabled />
                  </div>
                  <div class="col-md-4 mb-4">
                    <x-text-input type="text" label="Paid Amount" value="{{ number_format($order->paid_amount, 1) }}" disabled />
                  </div>
                  <div class="col-md-4 mb-4">
                    <x-text-input type="text" label="Remaining Amount" value="{{ number_format($order->remaining_amount, 1) }}" disabled />
                  </div>
                  <div class="col-md-6 mb-4">
                    <x-text-input type="text" label="Suit Quantity" value="{{ $order->suit_quantity }}" disabled />
                  </div>
                  <div class="col-md-6 mb-4">
                    <x-text-input type="text" label="Suit Delivery Type" value="{{ 
                      $order->suit_quantity == 1 ? 'Urgent' : 'Normal'
                      }}" disabled />
                  </div>
                  <div class="col-md-12 mb-4">
                    <x-text-input 
                      type="text" 
                      label="Assigned Employee" 
                      value="{{ $employee ? $employee->name . ' ' . $employee->caste : 'Not Assigned' }}" 
                      disabled />
                  </div>
                  @if($order->notes)
                  <div class="col-md-12 mb-4">
                    <x-text-input type="text" label="Note" value="{{ $order->notes }}" disabled />
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