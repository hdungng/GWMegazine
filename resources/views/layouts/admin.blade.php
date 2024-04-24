<!DOCTYPE html>
<html lang="en">

<head>

    <title>GWMegazine Admin</title>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('public/admin/images/favicon.icon') }}">

    <!-- Theme Config Js -->
    <script src="{{ url('public/admin/js/config.js') }}"></script>

    <!-- App css -->
    <link href="{{ url('public/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ url('public/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    @yield('head.css')
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">

        <div class="navbar-custom">
            <div class="topbar container-fluid">
                <div class="d-flex align-items-center gap-lg-2 gap-1">


                    <div class="logo-topbar">

                        <a href="{{ route('admin.dashboard') }}" class="logo-light">
                            <span class="logo-lg">
                                <img src="{{ url('public/admin/images/angular-logo.png') }}" alt="logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ url('public/admin/images/angular-logo-sm.png') }}" alt="small logo">
                            </span>
                        </a>


                        <a href="{{ route('admin.dashboard') }}" class="logo-dark">
                            <span class="logo-lg">
                                <img src="{{ url('public/admin/images/angular-logo.png') }}" alt="dark logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ url('public/admin/images/angular-logo-sm.png') }}" alt="small logo">
                            </span>
                        </a>
                    </div>


                    <button class="button-toggle-menu">
                        <i class="ri-menu-2-fill"></i>
                    </button>


                    <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>

                </div>

                <ul class="topbar-menu d-flex align-items-center gap-3">
                    <li class="d-sm-inline-block">
                        <div class="nav-link" id="light-dark-mode" data-bs-toggle="tooltip" data-bs-placement="left"
                            title="Theme Mode">
                            <i class="ri-moon-line fs-22"></i>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                <img src="{{ url(Auth::user()->avatar) }}" alt="user-image" width="32"
                                    class="rounded-circle">
                            </span>
                            <span class="d-lg-flex flex-column gap-1 d-none">
                                <h5 class="my-0">{{ Auth::user()->fullname }}</h5>
                                <h6 class="my-0 fw-normal">{{ Auth::user()->role->name }}</h6>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">

                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>


                            <a href="{{ route('admin.user-profile', Auth::user()->id) }}" class="dropdown-item">
                                <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                                <span>My Account</span>
                            </a>

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
                </ul>
            </div>
        </div>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">
            <!-- Brand Logo Light -->
            <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
                <span class="logo-lg">
                    <img src="{{ url('public/admin/images/angular-logo.png') }}" alt="logo" />
                </span>
                <span class="logo-sm">
                    <img src="{{ url('public/admin/images/angular-logo-sm.png') }}" alt="small logo" />
                </span>
            </a>

            <!-- Sidebar Hover Menu Toggle Button -->
            <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
                <i class="ri-checkbox-blank-circle-line align-middle"></i>
            </div>

            <!-- Full Sidebar Menu Close Button -->
            <div class="button-close-fullsidebar">
                <i class="ri-close-fill align-middle"></i>
            </div>

            <!-- Sidebar -left -->
            <div class="h-100" id="leftside-menu-container" data-simplebar>
                <!-- Leftbar User -->
                <div class="leftbar-user">
                    <a href="pages-profile.php">
                        <img src="{{ url('public/admin/images/users/avatar-1.jpg') }}" alt="user-image"
                            height="42" class="rounded-circle shadow-sm" />
                        <span class="leftbar-user-name mt-2">{{ Auth::user()->fullname }}</span>
                    </a>
                </div>

                <!--- Sidemenu -->
                <ul class="side-nav">
                    <li class="side-nav-title">Navigation</li>

                    @if (Auth::user()->role->name != 'Admin')
                        <li class="side-nav-item">
                            <a href="{{ route('admin.dashboard') }}" aria-expanded="false"
                                aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="ri-home-4-line"></i>
                                <span> Dashboards </span>
                            </a>
                        </li>

                        <li class="side-nav-title">Apps</li>


                        <li class="side-nav-item">
                            <a href="{{ route('admin.contributions.index') }}" class="side-nav-link">
                                <i class="ri-file-list-3-line"></i>
                                <span> Contributions </span>
                            </a>
                        </li>
                    @endif

                    <li class="side-nav-item">
                        <a href="{{ route('admin.users.index') }}" class="side-nav-link">
                            <i class="ri-user-3-fill"></i>
                            @if (in_array(Auth::user()->role->name, ['Admin', 'Manager']))
                                <span> Users </span>
                            @else
                                <span> Students </span>
                            @endif
                        </a>
                    </li>
                    @if (Auth::user()->role->name == 'Admin')
                        <li class="side-nav-item">
                            <a href="{{ route('admin.faculty.index') }}" class="side-nav-link">
                                <i class="ri-school-fill"></i>
                                <span> Faculty </span>
                            </a>
                        </li>


                        <li class="side-nav-title">System</li>

                        <li class="side-nav-item">
                            <a href="{{ route('admin.activity-logs.index') }}" class="side-nav-link">
                                <i class="ri-database-2-fill"></i>
                                <span> Activity Logs </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('admin.academic-year.index') }}" class="side-nav-link">
                                <i class="ri-calendar-event-fill"></i>
                                <span> Academic Year </span>
                            </a>
                        </li>
                    @elseif (Auth::user()->role->name == 'Manager')
                        <li class="side-nav-title">System</li>

                        <li class="side-nav-item">
                            <a href="{{ route('admin.activity-logs.index') }}" class="side-nav-link">
                                <i class="ri-database-2-fill"></i>
                                <span> Contribution Logs </span>
                            </a>
                        </li>
                    @endif
                </ul>
                <!--- End Sidemenu -->

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- ========== Left Sidebar End ========== -->


        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <!-- Start Content-->
            @yield('body.content')
            <!-- content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © GWMegazine
                        </div>
                    </div>
                </div>
            </footer>

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Vendor js -->
    <script src="{{ url('public/admin/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ url('public/admin/js/app.min.js') }}"></script>

    @yield('body.javascript')
</body>

</html>
