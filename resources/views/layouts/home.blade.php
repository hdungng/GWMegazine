<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ url('public/home/css/font-awesome.css') }}" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('public/home/css/styles.css') }}" />
    <script src="{{ url('public/home/js/darkmode.js') }}"></script>

    <title>GWMegazine Home</title>
    @yield('head.css')
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top border-bottom navbar-sticky" id="navbar">

        <div class="container-fluid px-5">
            <a class="navbar-brand" href="{{ route('home.main-page') }}">
                <img id="brand" src="{{ url('public/home/images/angular-logo.png') }}" alt=""
                    width="100" />
                <img id="brand-sm" src="{{ url('public/home/images/angular-logo-sm.png') }}" alt=""
                    width="30" />
            </a>
            <a href="#sidenav" class="mobile-header" aria-controls="sidenav" role="button" data-bs-toggle="offcanvas">
                <i class="fa-solid fa-bars fa-xl"></i>
            </a>

            <ul class="navbar-nav ms-auto hstack gap-3">
                <li class="nav-item">
                    <i class="fa-regular fa-circle-half-stroke fa-xl" id="darkModeSwitch" style="color: #4963C1;"></i>
                </li>

                @if (Auth::check())
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                <img src="{{ url(Auth::user()->avatar) }}" alt="user-image" width="32"
                                    class="rounded-circle">
                                <span class="mx-2 fullname d-sm-inline d-none fs-5">{{ Auth::user()->fullname }}</span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            @if (auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                    <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                                    <span>Admin View</span>
                                </a>
                            @else
                                <a href="{{ route('home.user-profile', Auth::user()->id) }}" class="dropdown-item">
                                    <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                                    <span>My Account</span>
                                </a>
                            @endif

                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                                class="dropdown-item">
                                <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}"
                            class="nav-link btn btn-primary text-light px-5 fw-medium py-3 mx-4">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2">
                <div class="position-fixed">
                    <nav id="sidebar-default">
                        @include('layouts.home-sidebar')
                    </nav>
                </div>
            </div>

            @yield('body.content')
        </div>
    </div>


    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidenav" aria-labelledby="sidenavLabel">
        <div class="offcanvas-body">
            <nav id="sidebar-mobile">
                @include('layouts.home-sidebar')
            </nav>
        </div>
    </div>

    </div>

    <script src="{{ url('public/home/js/jquery.min.js') }}"></script>
    <script src="{{ url('public/home/js/popper.js') }}"></script>
    <script src="{{ url('public/home/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/home/js/main.js') }}"></script>

    @yield('body.javascript')
</body>

</html>
