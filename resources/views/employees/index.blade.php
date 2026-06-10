<x-dashboard-imports title="Employees">
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
            <h3 class="mb-2 font-weight-bold article-title">Employees</h3>
            <a class="btn-sm btn-inverse-warning custom-btn" href="{{ route('employees.create') }}">
              <i class="fa fa-plus"></i> Add New Employee
            </a>
          </div>
          <div class="col-sm-12 mb-3">
            <x-breadcrumb :items="[
                ['title' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'fa-solid fa-chart-line'],
                ['title' => 'Employees', 'url' => '', 'icon' => 'fa-solid fa-address-book'],
            ]" />
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between small-screen">
              <h4 class="card-title">Employees Information</h4>
            </div>
            <div class="table-responsive">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Machine No.</th>
                    <th>Joining Date</th>
                    <th class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody id="employeeTableBody">
                  @forelse($employees as $employee)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employee->name . ' ' . $employee->caste }}</td>
                    <td>{{ $employee->role }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->machine_number }}</td>
                    <td>{{ date('d-m-Y', strtotime($employee->joining_date)) }}</td>
                    <td class="d-flex justify-content-end">
                      <a class="btn-sm btn-light cancel-btn table-link mr-2" href="{{ route('employees.edit', $employee->id) }}">
                        <i class="fa-solid fa-pencil"></i> Edit
                      </a>
                      <a class="btn-sm btn-inverse-danger delete-btn table-link" data-toggle="modal" data-target="#deleteEmployee{{ $employee->id }}">
                        <i class="fa-solid fa-trash-can"></i> Delete
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