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
                ['title' => 'Update Payment', 'url' => '', 'icon' => 'fa fa-pencil'],
            ]" />
          </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Update Payment Information</h4>
                <form action="{{ route('payments.update', $payment->id) }}" method="POST">
                  @csrf 
                  @method('PUT')
                  <div class="row">

                    {{-- Customer --}}

                    <div class="col-md-12 mb-2">
                      <x-text-input type="text" label="Customer" value="{{ $payment->customer->name . ' ' .$payment->customer->caste }}" disabled />
                    </div>

                    {{-- Payment Date --}}

                    <div class="col-md-12 mb-2">
                      <x-text-input type="date" name="payment_date" label="Payment Date" value="{{ $payment->payment_date }}" />
                    </div>

                    {{-- Payment Details --}}

                    <div class="col-md-12 table-responsive mb-2">
                      <table class="table table-borded text-nowrap">
                        <thead>
                          <tr>
                            <th>Total Amount</th>
                            <th>Paid Amount</th>
                            <th>Remaining Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{ $payment->order->total_amount }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->order->total_amount - $payment->amount }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    {{-- New Payment --}}

                    <div class="col-md-12 mb-2">
                      <x-text-input type="number" name="new_payment" label="New Payment" placeholder="New Payment" />
                    </div>

                    {{-- Payment Method --}}

                    <div class="col-sm-12 mb-2">
                        <div class="form-group">
                          <label>Payment Method</label>

                          <select name="payment_method" class="form-control employee">
                            <option value="">-- Select Payment Method --</option>

                              <option value="cash" {{ $payment->payment_method === 'cash' ? 'selected' : '' }}>Cash</option>
                              <option value="bank_transfer" {{ $payment->payment_method === 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                              <option value="jazzcash" {{ $payment->payment_method === 'jazzcash' ? 'selected' : '' }}>Jazz Cash</option>
                              <option value="easypaisa" {{ $payment->payment_method === 'easypaisa' ? 'selected' : '' }}>Easy Paisa</option>

                          </select>
                        </div>
                    </div>

                    {{-- Notes --}}

                    @if($payment->notes)
                    <div class="col-md-12 mb-2">
                      <x-text-input type="text" name="notes" label="Note" value="{{ $payment->notes }}" />
                    </div>
                    @endif

                    <div class="col-sm-12 d-flex justify-content-end">
                      <button type="submit" class="btn btn-primary mr-2 custom-btn">
                        <i class="fa-solid fa-pencil"></i> Update
                      </button>
                    </div>

                  </div>
                </form>
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