<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="horizontal" data-layout-width="boxed" data-sidebar="light" data-topbar="dark" data-preloader="disable" data-card-layout="borderless" data-bs-theme="light" data-topbar-image="pattern-1" data-sidebar-size="lg">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | Judia - Laravel 10 Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico') }}">

    <!-- include head css -->
    @include('layouts.head-css')
</head>

@yield('body')

<!-- Begin page -->
<div id="layout-wrapper">
    <!-- topbar -->
    @include('layouts.topbar')

    <!-- pattern components -->
    @include('layouts.pattern')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- footer -->
        @include('layouts.footer')

    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- vendor-scripts -->
@include('layouts.vendor-scripts')

</body>

</html>
