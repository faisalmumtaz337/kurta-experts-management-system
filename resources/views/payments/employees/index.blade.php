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
            <h3 class="mb-3 font-weight-bold article-title">Payments | <span class="lead welcome">Employee Payments</span></h3>
          </div>
          <div class="col-sm-12 mb-3">
            <x-breadcrumb :items="[
              ['title' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'fa-solid fa-chart-line'],
              ['title' => 'Payments', 'url' => route('payments.index'), 'icon' => 'fa-solid fa-coins'],
              ['title' => 'Employee Payments', 'url' => '', 'icon' => 'fa-solid fa-user-group'],
            ]" />
          </div>
          <div class="col-sm-12 mb-3">
            <div class="d-flex justify-content-end">
              <a class="btn-sm btn-inverse-warning custom-btn mr-2" href="{{ route('employee-payments.payment-history') }}">
                <i class="fa fa-clock"></i> Payment History
              </a>
              <a class="btn-sm btn-inverse-warning custom-btn" href="{{ route('employee-works.index') }}">
                <i class="fa fa-save"></i> Employee Work
              </a>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between small-screen">
              <h4 class="card-title">Employee Payments Summary</h4>
            </div>
            <div class="table-responsive">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Employee</th>
                    <th>Earn</th>
                    <th>Paid</th>
                    <th>Balance</th>
                    <th class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($employees as $employee)

                  @php
                    $earned = $employee->works_sum_amount ?? 0;
                    $paid   = $employee->payments_sum_amount ?? 0;
                    $balance = $earned - $paid;
                  @endphp

                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employee->name . ' ' . $employee->caste }}</td>
                    <td>{{ number_format($earned, 1) }}</td>
                    <td>{{ number_format($paid, 1) }}</td>
                    <td>{{ number_format($balance, 1) }}</td>
                    <td class="d-flex justify-content-end">
                      <a class="btn-sm btn-inverse-warning pay" href="{{ route('employee-payments.create', ['employee_id' => $employee->id]) }}">
                        <i class="fa-solid fa-coins mr-1"></i> Pay
                      </a>
                    </td>
                  </tr>
                  <div class="modal fade" id="deleteEmployee{{ $employee->id }}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5>Confirm Delete</h5>
                          <button class="close" data-dismiss="modal">&times;</button>
                        </div>
    
                        <div class="modal-body">
                          Are you sure you want to delete this employee?
                        </div>
    
                        <div class="modal-footer">
                          <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
    
                            <button type="button" class="btn btn-lighter cancel-btn" data-dismiss="modal"><i class="fa fa-circle-xmark"></i> Cancel</button>
                            <button type="submit" class="btn btn-inverse-warning custom-btn"><i class="fa-solid fa-trash-can"></i> Delete</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  @empty 
                  <tr>
                    <td colspan="7" class="text-center text-muted">
                      No Employee Found
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
              {{ $employees->links('vendor.kurta-experts-pagination.custom') }}
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