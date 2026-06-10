<x-dashboard-imports title="Users">
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
          <div class="col-sm-12 d-flex justify-content-between">
            <h3 class="mb-2 font-weight-bold article-title">Users</h3>
            <a class="btn-sm btn-inverse-warning custom-btn" href="{{ route('users.create') }}">
              <i class="fa-solid fa-plus"></i> Add New User
            </a>
          </div>
          <div class="col-sm-12 mb-3">
            <x-breadcrumb :items="[
                ['title' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'fa-solid fa-chart-line'],
                ['title' => 'Users', 'url' => '', 'icon' => 'fa-solid fa-user-group']
            ]" />
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Users Information</h4>
            <div class="table-responsive">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Contact #</th>
                    <th>User Type</th>
                    <th class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                      <img src="{{ asset('storage/' . $user->profile_image) }}" alt="image"/>
                      <span class="pl-2">{{ $user->name . ' ' . $user->caste }}</span>
                    </td>
                    <td>{{ $user->contact }}</td>
                    <td>
                      <span class="badge badge-warning">{{ $user->user_type }}</span>
                    </td>
                      <td class="d-flex justify-content-end">
                      <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                          @csrf 
                          @method('DELETE')                          
                          <button type="submit" class="btn-sm btn-light"><i class="fa fa-trash-can"></i> Remove</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
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