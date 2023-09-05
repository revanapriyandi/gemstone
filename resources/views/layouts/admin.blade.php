<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="#">
    <link rel="icon" type="image/png" href="#">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    @include('layouts.partials._meta')

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link href="{{ asset('assets/admin/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/nucleo-svg.css') }}" rel="stylesheet" />

    <script src="{{ asset('assets/admin/kit.fontawesome.com.js') }}" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/admin/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/b-2.4.1/b-colvis-2.4.1/b-html5-2.4.1/b-print-2.4.1/r-2.5.0/sp-2.2.0/sl-1.7.0/datatables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    @vite(['resources/css/admin.css'])
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/admin-248a476f.css') }}"> --}}
    @stack('styles')
</head>

<body class="g-sidenav-show   bg-gray-100">

    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    @include('layouts.partials.admin._sidebar')
    <main class="main-content position-relative border-radius-lg ">

        @include('layouts.partials.admin._navbar')

        <div class="container-fluid py-4">
            @yield('content')

            @stack('modal')

            @include('layouts.partials.admin._footer')
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('assets/admin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="{{ asset('assets/admin/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/dragula/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/jkanban/jkanban.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/b-2.4.1/b-colvis-2.4.1/b-html5-2.4.1/b-print-2.4.1/sp-2.2.0/sl-1.7.0/datatables.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
    <script src="{{ asset('assets/admin/js/plugins/choices.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@flasher/flasher@1.2.4/dist/flasher.min.js"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        var session = "{{ Session::get('success') }}";
        if (session) {
            flasher.success(session, 'Success!')
        }
    </script>
    <script src="{{ asset('assets/admin/js/argon-dashboard.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts.js') }}"></script>
    @stack('scripts')
    <script>
        new SimpleBar(document.getElementsByClassName('table-responsive')[0])
    </script>
</body>

</html>
