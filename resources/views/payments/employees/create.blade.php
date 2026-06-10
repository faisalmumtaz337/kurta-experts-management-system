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
          <div class="col-sm-12">
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
                ['title' => 'Employee Payments', 'url' => route('employee-payments.index'), 'icon' => 'fa-solid fa-user-group'],
                ['title' => 'Employee Payments', 'url' => '', 'icon' => 'fa-solid fa-plus']
            ]" />
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between small-screen">
              <h4 class="card-title">Make Payment</h4>
            </div>
            <form class="forms-sample" action="{{ route('employee-payments.store') }}" method="POST">
              @csrf
              <div id="balanceBox"></div>
              <div class="row">

                {{-- Employee --}}

                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Employee</label>

                    <select class="form-control role" id="employeeSelect" name="employee_id">
                      <option value="">-- Select Employee --</option>
                      @foreach ($employees as $employee)
                          <option value="{{ $employee->id }}"
                              {{ isset($selectedEmployee) && $selectedEmployee->id == $employee->id ? 'selected' : '' }}>
                              {{ $employee->name . ' ' . $employee->caste }}
                          </option>
                      @endforeach
                    </select>
                  </div>
                </div>

                {{-- Amount --}}

                <div class="col-sm-12">
                  <div class="form-group">
                    <x-text-input type="number" name="amount" label="Amount" step="0.01" placeholder="Amount" />
                  </div>
                </div>

                {{-- Payment Type --}}

                <div class="col-sm-6">
                  <div class="form-group">
                      <label for="payment_type">Payment Type</label>

                      <select class="form-control role" id="payment_type" name="payment_type">
                          <option value="">-- Select Payment Type --</option>
                          <option value="advance">Advance</option>
                          <option value="settlement">Settlement</option>
                          <option value="bonus">Bonus</option>
                          <option value="deduction">Deduction</option>
                      </select>
                  </div>
                </div>

                {{-- Payment Method --}}

                <div class="col-sm-6">
                  <div class="form-group">
                      <label for="payment_method">Payment Method</label>

                      <select class="form-control role" id="payment_method" name="payment_method">
                          <option value="">-- Select Payment Method --</option>
                          <option value="cash">Cash</option>
                          <option value="bank_transfer">Bank Transfer</option>
                          <option value="jazzcash">JazzCash</option>
                          <option value="easypaisa">EasyPaisa</option>
                      </select>
                  </div>
                </div>

                {{-- Payment Date --}}

                <div class="col-sm-12">
                  <div class="form-group">
                    <x-text-input type="date" name="payment_date" label="Payment Date" value="{{ now()->format('Y-m-d') }}" />
                  </div>
                </div>

                <div class="col-sm-12">
                    <label>Notes</label>

                    <div class="form-group">
                      <x-text-input name="notes" placeholder="Extra Notes" class="form-control" />
                    </div>
                </div>

                <div class="col-sm-12 d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary mr-2 custom-btn">
                    <i class="fa-solid fa-save"></i> Save Payment
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
document.addEventListener('DOMContentLoaded', function () {

    // Laravel data (must be passed from controller with with(['works','payments']))
    const employees = @json($employees ?? []);

    const select = document.getElementById('employeeSelect');

    if (!select) {
        console.error("employeeSelect not found");
        return;
    }

    console.log("Employees loaded:", employees);

    function calculateBalance(emp) {
        let earned = (emp?.works ?? []).reduce((t, w) => t + Number(w.amount || 0), 0);
        let paid   = (emp?.payments ?? []).reduce((t, p) => t + Number(p.amount || 0), 0);

        return earned - paid;
    }

    function updateBalance() {

        let id = select.value;

        let emp = employees.find(e => Number(e.id) === Number(id));

        if (!emp) {
            console.warn("Employee not found for ID:", id);
            return;
        }

        let balance = calculateBalance(emp);

        console.log("Balance:", balance);

        // Optional UI update
        let box = document.getElementById('balanceBox');
        if (box) {
            box.innerHTML = `
                <div class="alert alert-info mt-2">
                    <b>Balance:</b> ${balance.toFixed(1)}
                </div>
            `;
        }

        // fallback alert (optional)
        // alert("Balance: " + balance);
    }

    // Normal change event
    select.addEventListener('change', updateBalance);

    // If edit page already has selected value
    if (select.value) {
        updateBalance();
    }

});
</script>
</x-dashboard-imports>