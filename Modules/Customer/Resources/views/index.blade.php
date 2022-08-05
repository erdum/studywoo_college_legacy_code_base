<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Customer Dashboard">
  <meta name="author" content="{{ SystemConfig::get("app-name") }}">
  <title>Customer dashboard | {{ SystemConfig::get("app-name") }}</title>


  <!-- Bootstrap core CSS-->
  <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Main styles -->
  <link href="{{ asset('frontend/css/admin.css') }}" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="{{ asset('frontend/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Your custom styles -->


  @stack('style')

</head>

<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
  @include('customer::layouts.partials.navbar')
  <!-- /Navigation-->
  <div class="content-wrapper">

    @yield('content')
    <!-- /.container-wrapper-->
    @include('customer::layouts.partials.footer')
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-secondary" type="button" href="{{ route('logout') }}">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('frontend/js/admin.js') }}"></script>
    @stack('script')
</body>
</html>
