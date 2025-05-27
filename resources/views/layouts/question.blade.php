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
        @yield('content')

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