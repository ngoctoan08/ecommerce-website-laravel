    <!-- <base href="https://toannd.space"> -->
    {{-- <base href="http://localhost/laforce/"> --}}
    <!-- <base href="https://toanngocdoan.000webhostapp.com/"> -->
    <!-- <base href="http://php0522e-1.itpsoft.com.vn/"> -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon shortcut" href="{{asset('web/image/logo/icon-shortcut-logo.png')}}">
    @yield('title')

    <!-- library -->

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    
    

    <!-- css -->
    <link rel="stylesheet" href="{{asset('admin/font-awesome/css/all.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('web/css/bootstrap.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('shared/bootstrap-5.0.2-dist/css/bootstrap.min.css')}}">
    <!-- toastr -->
    <link rel="stylesheet" href="{{asset('client/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/responsive.css')}}">
    

    <!-- Rate ting -->
    <link rel="stylesheet" href="{{asset('web/css/star-rating-svg.css')}}">
