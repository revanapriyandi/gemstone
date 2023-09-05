<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta name="viewport"
        content="width=device-width, minimum-scale=1, maximum-scale=1, initial-scale=1, user-scalable=no" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    @include('layouts.partials._meta')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,400;1,700&amp;display=swap"
        rel="stylesheet">

    @stack('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    @vite(['resources/css/app.css'])
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-5c45ebf4.css') }}" /> --}}

</head>

<body>
    @php
        $boolean = request()->is('checkout*') ? false : true;
    @endphp
    @includeWhen($boolean, 'layouts.partials.app.topNav')

    <div id="main">
        <div id="ajaxArea">
            <main role="main">
                @yield('content')
            </main>
        </div>
        @stack('modal')

        @includeWhen($boolean, 'layouts.partials.app._bottomNavbar')
        @includeWhen($boolean, 'layouts.partials.app._footer')
        @includeWhen($boolean, 'layouts.partials.app._bottomNavbar')
    </div>
    <script src="{{ asset('assets/app/js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/app/js/vendor/splide.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.5/perfect-scrollbar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    @include('layouts.partials.app._scripts')
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('service-worker.js').then(function(err) {});
            });
        }

        const el = document.querySelector('img');
        const observer = lozad(el);
        observer.observe();
    </script>
    @stack('scripts')
</body>

</html>
