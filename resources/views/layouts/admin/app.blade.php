<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('build/assets/img/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('build/assets/css/styles.min.css') }}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!-- Sidebar Start -->
    @include('layouts.admin.sidebar');
    <!--  Sidebar End -->

    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('layouts.admin.header');
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <main>
          @yield('content');
        </main>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  <script src="{{ asset('build/assets/libs/jquery/dist/jquery.min.js') }}"></script>

  <script src="{{ asset('build/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

  <script src="{{ asset('build/assets/js/sidebarmenu.js') }}"></script>

  <script src="{{ asset('build/assets/js/app.min.js') }}"></script>

  <script src="{{ asset('build/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>

  <script src="{{ asset('build/assets/libs/simplebar/dist/simplebar.js') }}"></script>
</body>

</html>