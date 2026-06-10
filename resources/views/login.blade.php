<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login | Kurta Experts</title>
  <!-- base:css -->
  <link rel="stylesheet" href="{{ asset('/vendors/typicons.font/font/typicons.css') }}" />
  <link rel="stylesheet" href="{{ asset('/vendors/css/vendor.bundle.base.css') }}" />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('/css/vertical-layout-light/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('/css/custom-login.css') }}" />
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="d-flex justify-content-center band mb-2">
                <img class="logo" src="{{ asset('/images/logo.png') }}" alt="Logo" />
              </div>
              <div class="h1 d-flex justify-content-center logo-title mb-4 logo-subtext">Kurta Experts</div>
              <h5 class="font-weight-light d-flex justify-content-center text-white">Enter your credentials to login.</h5>
              <form action="{{ route('login.authenticate') }}" method="POST" class="pt-3">
                @csrf
                <div class="form-group">
                  <x-text-input type="number" name="contact" placeholder="Contact Number" class="form-control-lg login-input" />
                </div>
                <div class="form-group">
                  <x-text-input type="password" name="password" placeholder="Password" class="form-control-lg login-input" />
                </div>
                <div class="mt-3">
                  <input class="btn btn-block btn-login btn-lg font-weight-medium auth-form-btn bg-color" type="submit" value="LOGIN" />
                </div>
                <div class="my-2 d-flex justify-content-center align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-white" for="remember">
                      <input type="checkbox" id="remember" name="remember" class="form-check-input">
                      Keep me logged in
                    </label>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="{{ asset('/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{ asset('/js/off-canvas.js') }}"></script>
  <script src="{{ asset('/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('/js/template.js') }}"></script>
  <script src="{{ asset('/js/settings.js') }}"></script>
  <script src="{{ asset('/js/todolist.js') }}"></script>
  <!-- endinject -->
</body>

</html>
