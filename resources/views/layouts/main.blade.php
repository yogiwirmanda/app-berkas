<!-- =========================================================
* Argon Dashboard PRO v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro
* Copyright 2019 Creative Tim (https://www.creative-tim.com)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Berkas</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('argon/assets/img/brand/favicon.png')}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('argon/assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('argon/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}"
        type="text/css">
    <link rel="stylesheet" href="{{asset('argon/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
        href="{{asset('argon/assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet"
        href="{{asset('argon/assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('argon/assets/vendor/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('argon/assets/vendor/selectize/css/selectize.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('argon/assets/vendor/selectize/css/selectize.css')}}">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('argon/assets/css/bootstrap/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('argon/assets/css/argon.css?v=1.1.1')}}" type="text/css">
</head>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header d-flex align-items-center">
                <a class="navbar-brand" href="../../pages/dashboards/dashboard.html">
                    App Berkas
                </a>
                <div class="ml-auto">
                    <!-- Sidenav toggler -->
                    <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin"
                        data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/home">
                                <i class="ni ni-single-copy-04 text-info"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        @if (Auth::id() != 2)
                        <li class="nav-item">
                            <a class="nav-link" href="/pasien/index">
                                <i class="ni ni-single-02 text-info"></i>
                                <span class="nav-link-text">Pasien</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/dokter/index">
                                <i class="ni ni-sound-wave text-info"></i>
                                <span class="nav-link-text">Dokter</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ruangan/index">
                                <i class="ni ni-sound-wave text-info"></i>
                                <span class="nav-link-text">Ruangan</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="/berkas/index">
                                <i class="ni ni-calendar-grid-58 text-info"></i>
                                <span class="nav-link-text">Berkas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-maps" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="navbar-maps">
                                <i class="ni ni-map-big text-info"></i>
                                <span class="nav-link-text">Laporan</span>
                            </a>
                            <div class="collapse" id="navbar-maps">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="/laporan/berkas" class="nav-link">Berkas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/24" class="nav-link">2x24</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/laporan/ruangan" class="nav-link">Ruangan</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Header -->
        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">App Berkas</h6>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            @yield('content')
        </div>
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{asset('argon/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/js-cookie/js.cookie.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
    <!-- Optional JS -->
    <script src="{{asset('argon/assets/vendor/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/chart.js/dist/Chart.extension.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/datatables.net-select/js/dataTables.select.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/selectize/js/standalone/selectize.min.js')}}"></script>
    <!-- Argon JS -->
    <script src="{{asset('argon/assets/js/argon.js?v=1.1.0')}}"></script>
    <!-- Demo JS - remove this in your project -->
    <script src="{{asset('argon/assets/js/demo.min.js')}}"></script>
    @yield('script-view')
</body>

</html>
