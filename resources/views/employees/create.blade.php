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
          </div>
          <div class="col-sm-12 mb-3">
          <div class="col-sm-12 mb-3">
            <x-breadcrumb :items="[
                ['title' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'fa-solid fa-chart-line'],
                ['title' => 'Employees', 'url' => route('employees.index'), 'icon' => 'fa-solid fa-address-book'],
                ['title' => 'Add New Employee', 'url' => '', 'icon' => 'fa fa-plus'],
            ]" />
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between small-screen">
              <h4 class="card-title">Add New Employee</h4>
            </div>
            <form class="forms-sample" action="{{ route('employees.store') }}" method="POST">
              @csrf
              <div class="row">

                {{-- Name --}}

                <div class="col-sm-6 mt-3">
                  <div class="form-group">
                    <x-text-input name="name" label="Name" placeholder="Name" />
                  </div>
                </div>

                {{-- Caste --}}

                <div class="col-sm-6 mt-3">
                  <div class="form-group">
                    <x-text-input name="caste" label="Caste" placeholder="Caste" />
                  </div>
                </div>

                {{-- Role --}}

                <div class="col-sm-6">
                  <div class="form-group">
                      <label for="status">Role</label>

                      <select class="form-control role" id="role" name="role">
                          <option value="">-- Choose Role --</option>
                          <option value="Tailor">Tailor</option>
                          <option value="Cutting Master">Cutting Master</option>
                          <option value="Helper">Helper</option>
                      </select>
                  </div>
                </div>

                {{-- Employee Payments --}}

                <div class="col-sm-6">
                  <div class="form-group">
                    <x-text-input type="number" name="employee_payments" label="Employee Payments" placeholder="Employee Payments" />
                  </div>
                </div>

                {{-- Phone --}}

                <div class="col-sm-6">
                  <div class="form-group">
                    <x-text-input type="number" name="phone" label="Phone" placeholder="Phone" />
                  </div>
                </div>

                {{-- Joining Date --}}

                <div class="col-sm-6">
                  <div class="form-group">
                    <x-text-input type="date" name="joining_date" label="Joining Date" />
                  </div>
                </div>

                {{-- Machine Number --}}
                <input type="hidden" name="machine_number" />

                <div class="col-sm-12 d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary mr-2 custom-btn">
                    <i class="fa-solid fa-book"></i> Add Employee
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
</x-dashboard-imports>