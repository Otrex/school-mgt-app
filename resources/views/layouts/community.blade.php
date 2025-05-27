<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        {{ seo()->render() }}
        @if (!is_staging())
        <meta content="Telage Concepts, Technology Education, Tech Ecosystem, Nigeria Tech, Africa Tech, Ed-Tech" name="keywords">
        @endif

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/iziToast/iziToast.min.css') }}" rel="stylesheet">

        {{-- Alpine Js Library --}}
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.3/dist/cdn.min.js"></script>

        <link href="{{ asset('css/croppie.css') }}" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        @livewireStyles

    </head>
    <body>
        <!-- ======= Header ======= -->

        <header id="header" class="header fixed-top d-flex align-items-center">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ route('index') }}" class="logo d-flex align-items-center">
                    <img src="{{ asset('img/logo.png') }}" alt="">
                    <span class="d-none d-lg-block">Community Member</span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div><!-- End Logo -->

            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">
                    <li class="nav-item px-3">

                        @php
                            $member = auth('community')->user();
                        @endphp

                        <livewire:components.become-patron-button />

                    </li>
                    <li class="nav-item dropdown">
                    <!--<div class="d-flex align-items-center m-3 rounded px-3 py-2 bg-info">
                        <div class="font-weight-bold text-light"> 435tgr </div>
                    </div> -->
                        <!-- <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span class="badge bg-primary badge-number">4</span>
                        </a> -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                            <li class="dropdown-header">
                                You have 4 new notifications
                                <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-exclamation-circle text-warning"></i>
                                <div>
                                    <h4>Lorem Ipsum</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>30 min. ago</p>
                                </div>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-x-circle text-danger"></i>
                                <div>
                                    <h4>Atque rerum nesciunt</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>1 hr. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-check-circle text-success"></i>
                                <div>
                                    <h4>Sit rerum fuga</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>2 hrs. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-info-circle text-primary"></i>
                                <div>
                                    <h4>Dicta reprehenderit</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-footer">
                                <a href="#">Show all notifications</a>
                            </li>
                        </ul><!-- End Notification Dropdown Items -->
                    </li><!-- End Notification Nav -->



                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            @livewire('components.communnity-member-avatar', ['type' => '-nav'])
                            <span class="d-none d-md-block dropdown-toggle ps-2">
                                {{ strtoupper(auth('community')->user()->first_name[0]) }}. {{ ucwords(auth('community')->user()->last_name) }}
                            </span>
                        </a><!-- End Profile Iamge Icon -->
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6>{{ ucwords(auth('community')->user()->fullname) }}</h6>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('community.member.profile') }}">
                                    <i class="bi bi-person"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                @livewire('auth.community-member-logout')
                            </li>
                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->
                </ul>
            </nav><!-- End Icons Navigation -->

        </header><!-- End Header -->

        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('community.member.dashboard') ? '' : 'collapsed' }}" href="{{ route('community.member.dashboard') }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('community.member.results') ? '' : 'collapsed' }}" href="{{ route('community.member.results') }}">
                    <i class="bi bi-bar-chart"></i>
                    <span>Results</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('community.member.certificate') ? '' : 'collapsed' }}" href="{{ route('community.member.certificate') }}">
                    <i class="bi bi-receipt"></i>
                    <span>Certificate</span>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('community.member.voucher') ? '' : 'collapsed' }}" href="{{ route('community.member.voucher') }}">
                    <i class="bi bi-credit-card-2-front"></i>
                    <span>Voucher Service</span>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('community.member.profile') ? '' : 'collapsed' }}" href="{{ route('community.member.profile') }}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('community.member.centers') ? '' : 'collapsed' }}" href="{{ route('community.member.centers') }}">
                        <i class="bi bi-pc-display"></i>
                    <span>Community Centers</span>
                    </a>
                </li>

                <li class="nav-item {{ $member->patron ? '': 'x-hide' }}" id="x-nav-patron">
                    <a class="nav-link {{ request()->routeIs('community.member.patron') ? '' : 'collapsed' }}" href="{{ route('community.member.patron') }}">
                        <i class="bi bi-bank2"></i>
                    <span>Patron</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('community.member.referrals') ? '' : 'collapsed' }}" href="{{ route('community.member.referrals') }}">
                    <i class="ri-user-star-line"></i>
                    <span>Referrals</span>
                    </a>
                </li>
            </ul>
        </aside><!-- End Sidebar-->

        @yield('content')

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        @livewireScripts

        <!-- Vendor JS Files -->
        <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
        <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
        <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
        <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
        <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ asset('vendor/iziToast/iziToast.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/croppie.js') }}"></script>
        <script src="{{ asset('js/cropper.js') }}"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('js/main.js') }}"></script>
    </body>

</html>