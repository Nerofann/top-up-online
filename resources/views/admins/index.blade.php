<!DOCTYPE html>
<html lang="en" data-menu="vertical" data-nav-size="nav-default">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCommerce Dashboard | Digiboard</title>
    
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" id="primaryColor" href="{{ asset('assets/css/blue-color.css') }}">
    <link rel="stylesheet" id="rtlStyle" href="#">
</head>
<body class="body-padding body-p-top dark-theme">
    <!-- preloader start -->
    <x-anon.loader></x-anon.loader>
    <!-- preloader end -->

    <!-- Alert Toast start -->
    <x-alerts.basic :message="Session::all()"></x-alerts.basic>
    <!-- Alert Toast end -->
    
    
    <!-- header start -->
    @include('admins.layouts.header')
    <!-- header end -->

    <!-- profile right sidebar start -->
    @include('admins.layouts.profile-right-sidebar')
    <!-- profile right sidebar end -->

    <!-- right sidebar start -->
    @include('admins.layouts.right-sidebar')
    <!-- right sidebar end -->

    <!-- main sidebar start -->
    @include('admins.layouts.sidebar')
    <!-- main sidebar end -->

    <!-- main content start -->
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>eCommerce Dashboard</h2>
            <div class="input-group dashboard-filter">
                <input type="text" class="form-control" name="basic" id="dashboardFilter" readonly>
                <label for="dashboardFilter" class="input-group-text"><i class="fa-light fa-calendar-days"></i></label>
            </div>
        </div>
       
        @yield('content')
        
        <!-- footer start -->
        <div class="footer">
            <p>Copyright© <script>document.write(new Date().getFullYear())</script> All Rights Reserved By <span class="text-primary">Digiboard</span></p>
        </div>
        <!-- footer end -->
    </div>
    <!-- main content end -->
    
    <script src="{{ url('assets/vendor/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ url('assets/vendor/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ url('assets/vendor/js/apexcharts.js') }}"></script>
    <script src="{{ url('assets/vendor/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/vendor/js/moment.min.js') }}"></script>
    <script src="{{ url('assets/vendor/js/daterangepicker.js') }}"></script>
    <script src="{{ url('assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/dashboard.js') }}"></script>
    <script src="{{ url('assets/js/main.js') }}"></script>
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