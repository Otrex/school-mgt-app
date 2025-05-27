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
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ asset('vendor/animate.css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/iziToast/iziToast.min.css') }}" rel="stylesheet">

        {{-- Alpine Js Library --}}
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.3/dist/cdn.min.js"></script>

        <!-- Template Main CSS File -->
        <link href="{{ asset('css/style1.css') }}" rel="stylesheet">

        @livewireStyles
    </head>
    <body>
        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top">
            <div class="container d-flex align-items-center">
                <a href="{{ route('index') }}" class="logo mr-5px"><img src="{{ asset('img/logo.png') }}" alt="" class="img-fluid"></a>
                <h1 class="logo me-auto"><a href="{{ route('index') }}">Blip School</a></h1>

                <nav id="navbar" class="navbar order-last order-lg-0">
                    <ul>
                        <li><a href="{{ route('courses') }}">Programs</a></li>
                        <li><a href="{{ route('blogs') }}">Blog</a></li>
                        <li class="dropdown">
                            <a href="javascript:void(0);">
                                <span>Communities</span>
                                <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul>
                                <li><a href="{{ route('communities.about') }}">About</a></li>
                                @guest('community')
                                <li><a href="{{ route('communities.register') }}">Register</a></li>
                                @endguest
                                @auth('community')
                                <li><a href="{{ route('community.member.dashboard') }}">Dashboard</a></li>
                                @endauth
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0);"><span>Club Membership</span>
                                <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul>
                                <li><a href="{{ route('club.about') }}">About</a></li>
                                @guest
                                @if (is_portal_on())
                                <li><a href="{{ route('student.register') }}">Register</a></li>
                                @endif
                                @endguest
                                @auth
                                <li><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                                @endauth
                            </ul>
                        </li>
                        @auth('community')
                        <li>
                            <div>
                                <div  class="nav-link nav-profile d-flex align-items-center pe-0" href="#" >
                                    {{-- @livewire('components.communnity-member-avatar', ['type' => null]) --}}
                                    <a href="{{ route('community.member.dashboard') }}" class="btn user-info d-none d-md-inline-block fw-bold px-3 py-1">
                                        {{ auth('community')->user()->getFullNameAttribute() }}
                                    </a>
                                </div>
                            </div>
                        </li>
                        @endauth
                        @if(is_guests())
                        <li><a href="{{ route('student.login') }}">Login</a></li>
                        @endif
                        {{-- Logout --}}
                        {{-- @if(!is_guests())
                            @livewire('auth.user-logout', ['type' => 'user'])
                        @endif --}}
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->
                <a href="{{ route('donation') }}" class="get-started-btn">Donate</a>
            </div>
        </header><!-- End Header -->

        @yield('content')

        <!-- ======= Footer ======= -->
        <footer id="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-4 col-md-6 footer-contact">
                            <h4>Blip School</h4>
                            <p>
                                Onugbogu Filling Station, <br>
                                KM 1 Aguluezechukwu-Ogboji Road,<br>
                                Near Aguata Local Government, <br>
                                Aguluezechukwu, Anambra State<br><br>
                                <strong>Email:</strong> blip@telageconcepts.com<br>
                            </p>
                        </div>

                        <div class="col-lg-4 col-md-6 footer-links">
                            <h4>Useful Links</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('index') }}">Home</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('club.about') }}">About Club Membership</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('communities.about') }}">About Community Membership</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('privacy.policy') }}">Privacy policy</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-4 col-md-6 footer-newsletter">
                            <h4>Join Our Newsletter</h4>
                            <p>Receive latest information by subscribing to our weekly newsletter.</p>
                            <form action="" method="post">
                                <input type="email" name="email"><input type="submit" value="Subscribe">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container d-md-flex py-4">

                <div class="me-md-auto text-center text-md-start">
                    <div class="copyright">
                        &copy; Copyright <strong><span>Blip School</span></strong>. All Rights Reserved
                    </div>
                    <div class="credits">
                        Designed with
                        <span style="vertical-align: middle;" class="bi bi-heart-fill text-danger"></span>
                        by Telage Concepts in Aguata
                    </div>
                </div>
                <div class="social-links text-center text-md-right pt-3 pt-md-0">
                    <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                    <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                    <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>
            </div>
        </footer><!-- End Footer -->

        <div id="preloader" class="preloader-logo"><img src="{{ asset('img/logo.png') }}" width="30"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        @livewireScripts

        <!-- Vendor JS Files -->
        <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js') }}" type="text/javascript"></script>
        <script src="{{ asset('vendor/aos/aos.js') }}" type="text/javascript"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('vendor/iziToast/iziToast.min.js') }}" type="text/javascript"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('js/main1.js') }}"></script>

        @stack('scripts')
    </body>
</html>