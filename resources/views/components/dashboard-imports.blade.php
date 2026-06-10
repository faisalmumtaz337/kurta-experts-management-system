<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Dashboard' }} | Kurta Experts</title>

    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('/vendors/typicons.font/font/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->

    <link rel="stylesheet" href="{{ asset('/css/custom-dashboard.css') }}">
    <link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- VITE (MAIN FIX) -->
    @vite(['resources/js/app.js'])
  </head>

  <body>
    <div class="container-scroller">

      {{ $slot }}

    </div>

    <!-- base:js -->
    <script src="{{ asset('/vendors/js/vendor.bundle.base.js') }}"></script>

    <!-- inject:js -->
    <script src="{{ asset('/js/off-canvas.js') }}"></script>
    <script src="{{ asset('/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('/js/template.js') }}"></script>
    <script src="{{ asset('/js/settings.js') }}"></script>
    <script src="{{ asset('/js/todolist.js') }}"></script>

    <!-- plugin js -->
    <script src="{{ asset('vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>

    <!-- custom js -->
    <script src="{{ asset('/js/dashboard.js') }}"></script>
    <script src="{{ asset('/js/input-disable-check.js') }}"></script>
    <script src="{{ asset('/js/custom.js') }}"></script>

  </body>
</html>