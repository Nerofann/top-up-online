<!DOCTYPE html>
<html lang="en" data-menu="vertical" data-nav-size="nav-default">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? env('APP_NAME') }} | {{ $heading ?? env('APP_NAME') }}</title>
    
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" id="primaryColor" href="{{ asset('assets/css/blue-color.css') }}">
    <link rel="stylesheet" id="rtlStyle" href="#">
    <script src="{{ asset('assets/vendor/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="body-padding body-p-top dark-theme">
    <!-- preloader start -->
    <x-anon.loader></x-anon.loader>
    <!-- preloader end -->

    <!-- Alert Toast start -->
    <div class="dashboard">
        <x-alerts.basic :message="Session::all()"></x-alerts.basic>
    </div>
    <!-- Alert Toast end -->
    
    
    <!-- header start -->
    @include('layouts.header')
    <!-- header end -->

    <!-- profile right sidebar start -->
    @include('layouts.profile-right-sidebar')
    <!-- profile right sidebar end -->

    <!-- right sidebar start -->
    @include('layouts.right-sidebar')
    <!-- right sidebar end -->

    <!-- main sidebar start -->
    <x-Sidebar />
    <!-- main sidebar end -->

    <!-- main content start -->
    <div class="main-content">
        {{-- <div class="dashboard-breadcrumb mb-25">
            <h2>{{ $heading }}</h2>
            <div class="input-group dashboard-filter">
                <input type="text" class="form-control" name="basic" id="dashboardFilter" readonly>
                <label for="dashboardFilter" class="input-group-text"><i class="fa-light fa-calendar-days"></i></label>
            </div>
        </div> --}}
       
        @yield('content')
        
        <!-- footer start -->
        <div class="footer">
            <p>Copyright© <script>document.write(new Date().getFullYear())</script> All Rights Reserved By <span class="text-primary">Digiboard</span></p>
        </div>
        <!-- footer end -->
    </div>
    <!-- main content end -->
    @yield('modal')

    <script src="{{ asset('assets/vendor/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- for demo purpose -->
    <script>
        var rtlReady = $('html').attr('dir', 'ltr');
        if (rtlReady !== undefined) {
            localStorage.setItem('layoutDirection', 'ltr');
        }
    </script>
    <!-- for demo purpose -->
</body>
</html>