<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="au theme template">
  <meta name="author" content="Hau Nguyen">
  <meta name="keywords" content="au theme template">
  <meta name="referrer" content="same-origin">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Title Page-->
  @yield('title')
  <!-- Fontfaces CSS-->
  <link href="{{asset('admin_template/css/font-face.css')}}" rel="stylesheet" media="all">
  <link href="{{asset('admin_template/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
  <link href="{{asset('admin_template/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
  <link href="{{asset('admin_template/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    {{-- Font awesome crack --}}
    <link rel="stylesheet" href="{{asset('admin/font-awesome/css/all.min.css')}}">
  <!-- Bootstrap CSS-->
  <link href="{{asset('admin_template/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

  <!-- Vendor CSS-->
  <link href="{{asset('admin_template/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
  <link href="{{asset('admin_template/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
  <link href="{{asset('admin_template/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
  <link href="{{asset('admin_template/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
  <link href="{{asset('admin_template/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
  <link href="{{asset('admin_template/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
  <link href="{{asset('admin_template/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">
  <link href="{{asset('admin_template/css/mycss.css')}}" rel="stylesheet" media="all">

  {{-- My css --}}
  <link href="{{asset('admin/css/mycss.css')}}" rel="stylesheet" media="all">

  <!-- CK Editor -->
  {{-- @yield('css') --}}
  <!-- Main CSS-->
  <link href="{{asset('admin_template/css/theme.css')}}" rel="stylesheet" media="all">


</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        @include('admin.partials.sidebar');
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            @include('admin.partials.header');
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            @yield('content')
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
        
    </div>

    <!-- Script -->
    <!-- Jquery JS-->
    <script src="{{asset('admin_template/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('admin_template/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('admin_template/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>

    <!-- admin_template/vendor JS       -->
    <script src="{{asset('admin_template/vendor/slick/slick.min.js')}}"></script>
    <script src="{{asset('admin_template/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('admin_template/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('admin_template/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"> </script>
    <script src="{{asset('admin_template/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('admin_template/vendor/counter-up/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('admin_template/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('admin_template/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin_template/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('admin_template/vendor/select2/select2.min.js')}}"></script>
    <!-- Main JS-->
    <script src="{{asset('admin_template/js/main.js')}}"></script>
    
    
    <!-- CK Editor -->
    @yield('js')
    

</body>

</html>
<!-- end document-->
