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
                ['title' => 'Update Order', 'url' => '', 'icon' => 'fa-solid fa-pencil']
            ]" />
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h4 class="card-title">Update Booked Order</h4>
            </div>
            <div x-data="{ status: '{{ $order->status }}' }">
              <form class="forms-sample" action="{{ route('orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
  
                <div class="row">
  
                  {{-- Delivery Date --}}
  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <x-text-input type="date" name="delivery_date" label="Delivery Date" placeholder="Delivery Date" value="{{ $order->delivery_date }}" />
                    </div>
                  </div>  
  
                  {{-- Suit Quantity --}}
  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <x-text-input type="number" name="suit_quantity" label="Suit Quantity" placeholder="Suit Quantity" value="{{ $order->suit_quantity }}" />
                    </div>
                  </div>
  
                  {{-- Note --}}
  
                  <div class="col-sm-12">
                    <div class="form-group">
                      <x-text-input name="notes" label="Note" placeholder="Note" value="{{ $order->notes }}" />
                    </div>
                  </div>
  
                  {{-- Status --}}

                  <div class="col-sm-12 row">

                    <div class="col-sm-12 mb-3">
                      <span>Status</span>
                    </div>

                    <div class="col-sm-12 form-group row">

                      {{-- Pending --}}
                      <div class="col-sm">
                        <div class="form-check">
                          <label for="pending" class="form-check-label">
                            <input type="radio"
                                  class="form-check-input"
                                  name="status"
                                  id="pending"
                                  value="Pending"
                                  x-model="status"
                                  {{ $order->status === 'Pending' ? 'checked' : '' }}>
                            Pending
                            <i class="input-helper"></i>
                          </label>
                        </div>
                      </div>

                      {{-- Cutting --}}
                      <div class="col-sm">
                        <div class="form-check">
                          <label for="cutting" class="form-check-label">
                            <input type="radio"
                                  class="form-check-input"
                                  name="status"
                                  id="cutting"
                                  value="Cutting"
                                  x-model="status"
                                  {{ $order->status === 'Cutting' ? 'checked' : '' }}>
                            Cutting
                            <i class="input-helper"></i>
                          </label>
                        </div>
                      </div>

                      {{-- Stitching --}}
                      <div class="col-sm">
                        <div class="form-check">
                          <label for="stitching" class="form-check-label">
                            <input type="radio"
                                  class="form-check-input"
                                  name="status"
                                  id="stitching"
                                  value="Stitching"
                                  x-model="status"
                                  {{ $order->status === 'Stitching' ? 'checked' : '' }}>
                            Stitching
                            <i class="input-helper"></i>
                          </label>
                        </div>
                      </div>

                      {{-- Packing --}}
                      <div class="col-sm">
                        <div class="form-check">
                          <label for="packing" class="form-check-label">
                            <input type="radio"
                                  class="form-check-input"
                                  name="status"
                                  id="packing"
                                  value="Packing"
                                  x-model="status"
                                  {{ $order->status === 'Packing' ? 'checked' : '' }}>
                            Packing
                            <i class="input-helper"></i>
                          </label>
                        </div>
                      </div>

                    </div>
                  </div>

                  {{-- Employee Assign (Show only if Status is NOT Pending) --}}

                  <div class="col-sm-12 mb-3"
                      x-show="status !== 'Pending'"
                      x-transition>
                      <div class="form-group mt-2">
                        <label>Select Employee</label>

                        <select name="employee_id" class="form-control employee">
                          <option value="">-- Select Employee --</option>

                          @foreach($employees as $emp)
                            <option value="{{ $emp->id }}"
                              {{ (old('employee_id', $employee->id ?? '') == $emp->id) ? 'selected' : '' }}>
                              {{ $emp->name . ' ' . $emp->caste . ' (' . $emp->role . ')' }}
                            </option>
                          @endforeach

                        </select>
                      </div>
                      <div class="form-group">
                        <x-text-input name="rate" label="Rate" placeholder="Rate per suit" />
                      </div>
                      <div class="form-group">
                        <x-text-input name="emp_qty" label="Quantity" placeholder="Suit assign quantity" />
                      </div>
                  </div>
  
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
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <x-footer />
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
</x-dashboard-imports>