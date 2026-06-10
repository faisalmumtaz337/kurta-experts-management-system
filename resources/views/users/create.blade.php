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
            <h4 class="card-title">Add New Users Information</h4>
            <form class="forms-sample" enctype="multipart/form-data" action="{{ route('users.store') }}" method="POST">
              @csrf
              <div class="row">
                <div class="col-sm-6">

                  {{-- Name --}}

                  <div class="form-group">
                    <x-text-input name="name" label="Name" placeholder="Name" />
                  </div>
                </div>
                <div class="col-sm-6">

                  {{-- Caste --}}

                  <div class="form-group">
                    <x-text-input name="caste" label="Caste" placeholder="Caste" />
                  </div>
                </div>
              </div>

              {{-- Phone --}}

              <div class="form-group">
                <x-text-input type="number" name="contact" label="Phone" placeholder="Contact" />
              </div>

              {{-- Password --}}

              <div class="form-group">
                <x-text-input type="password" name="password" label="Password" placeholder="Password" />
              </div>
              
              {{-- Profile Image --}}
              
              <div class="form-group">
                <label>Profile Image</label>
                <input type="file" name="profile_image" class="file-upload-default">
                <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-light" type="button">Upload</button>
                  </span>
                </div>
              </div>

              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mr-2 custom-btn">Add</button>
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