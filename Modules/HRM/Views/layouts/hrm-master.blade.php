<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">

<head>
    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="HRM - Human Resource Management System">
    <meta name="Author" content="HRM Team">
    <meta name="keywords" content="hrm, human resource, management, employees, payroll, attendance">
    
    <!-- TITLE -->
    <title>@yield('title', 'HRM Dashboard') - HRM System</title>

    <!-- FAVICON -->
    <link rel="icon" href="{{asset('build/assets/images/brand-logos/favicon.ico')}}" type="image/x-icon">

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{asset('build/assets/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- ICONS CSS -->
    <link href="{{asset('build/assets/icon-fonts/icons.css')}}" rel="stylesheet">
    
    <!-- APP SCSS -->
    @vite(['resources/sass/app.scss'])

    @include('layouts.components.styles')

    <!-- MAIN JS -->
    <script src="{{asset('build/assets/main.js')}}"></script>

    @yield('styles')

</head>

<body>
    <!-- SWITCHER -->
    @include('layouts.components.switcher')
    <!-- END SWITCHER -->

    <!-- LOADER -->
    <div id="loader">
        <img src="{{asset('build/assets/images/media/loader.svg')}}" alt="">
    </div>
    <!-- END LOADER -->

    <!-- PAGE -->
    <div class="page">
        <!-- HEADER -->
        @include('layouts.components.header')
        <!-- END HEADER -->

        <!-- HRM SIDEBAR -->
        <aside class="app-sidebar sticky" id="sidebar">
            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header">
                <a href="{{url('index')}}" class="header-logo">
                    <img src="{{asset('build/assets/images/brand-logos/desktop-logo.png')}}" alt="logo" class="desktop-logo">
                    <img src="{{asset('build/assets/images/brand-logos/toggle-logo.png')}}" alt="logo" class="toggle-logo">
                    <img src="{{asset('build/assets/images/brand-logos/desktop-dark.png')}}" alt="logo" class="desktop-dark">
                    <img src="{{asset('build/assets/images/brand-logos/toggle-dark.png')}}" alt="logo" class="toggle-dark">
                    <img src="{{asset('build/assets/images/brand-logos/desktop-white.png')}}" alt="logo" class="desktop-white">
                    <img src="{{asset('build/assets/images/brand-logos/toggle-white.png')}}" alt="logo" class="toggle-white">
                </a>
            </div>
            <!-- End::main-sidebar-header -->

            <!-- Start::main-sidebar -->
            <div class="main-sidebar" id="sidebar-scroll">
                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills flex-column sub-open">
                    <div class="slide-left" id="slide-left">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
                    </div>
                    <ul class="main-menu">
                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">HRM System</span></li>
                        <!-- End::slide__category -->

                        <!-- Admin Dashboard Link -->
                        <li class="slide">
                            <a href="{{ route('admin.dashboard') }}" class="side-menu__item">
                                <i class="bx bx-arrow-back side-menu__icon"></i>
                                <span class="side-menu__label">Admin Dashboard</span>
                            </a>
                        </li>

                        <!-- HRM Dashboard -->
                        <li class="slide">
                            <a href="{{ route('hrm.dashboard') }}" class="side-menu__item {{ request()->routeIs('hrm.dashboard') ? 'active' : '' }}">
                                <i class="bx bx-home side-menu__icon"></i>
                                <span class="side-menu__label">HRM Dashboard</span>
                            </a>
                        </li>

                        <!-- Create User -->
                        <li class="slide">
                            <a href="{{ route('hrm.users.create') }}" class="side-menu__item">
                                <i class="bx bx-user-plus side-menu__icon"></i>
                                <span class="side-menu__label">Create User</span>
                            </a>
                        </li>

                        <!-- HRM Modules -->
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="bx bx-grid-alt side-menu__icon"></i>
                                <span class="side-menu__label">HRM Modules</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0);">HRM Modules</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('hrm.employees') }}" class="side-menu__item">Employees</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('hrm.departments') }}" class="side-menu__item">Departments</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('hrm.attendance') }}" class="side-menu__item">Attendance</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('hrm.payroll') }}" class="side-menu__item">Payroll</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
                </nav>
                <!-- End::nav -->
            </div>
            <!-- End::main-sidebar -->
        </aside>
        <!-- END HRM SIDEBAR -->

        <!-- MAIN-CONTENT -->
        <div class="main-content app-content">
            @yield('content')
        </div> 
        <!-- END MAIN-CONTENT -->

        <!-- SEARCH-MODAL -->
        @include('layouts.components.search-modal')
        <!-- END SEARCH-MODAL -->

        <!-- FOOTER -->
        @include('layouts.components.footer')
        <!-- END FOOTER -->
    </div>
    <!-- END PAGE-->

    <!-- SCRIPTS -->
    @include('layouts.components.scripts')
    @yield('scripts')
    <!-- STICKY JS -->
    <script src="{{asset('build/assets/sticky.js')}}"></script>
</body>
</html>
