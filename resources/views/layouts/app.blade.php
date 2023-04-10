
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="au theme template">
        <meta name="author" content="Hau Nguyen">
        <meta name="keywords" content="au theme template">

        <!-- Title Page-->
        <title>Login</title>

        <!-- Fontfaces CSS-->
        <link href="{{asset('admin_template/css/font-face.css')}}" rel="stylesheet" media="all">
        <link href="{{asset('admin_template/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
        <link href="{{asset('admin_template/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
        <link href="{{asset('admin_template/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

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
        <link href="{{asset('admin/css/mycss.css')}}" rel="stylesheet" media="all">

        <!-- CK Editor -->
        {{-- @yield('css') --}}
        <!-- Main CSS-->
        <link href="{{asset('admin_template/css/theme.css')}}" rel="stylesheet" media="all">

    </head>
    <body>
        <div id="app">
            <nav style="    background-color: #3d414685;" class="navbar navbar-expand-md navbar-light shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{-- {{ config('app.name', 'Laravel') }} --}}
                        <img src="{{asset('web/image/logo/logo.png')}}" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a style="color: #fff" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a style="color: #fff" class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
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
