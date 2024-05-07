<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="horizontal" data-layout-width="boxed"
      data-sidebar="light"
      @if (@Auth::user()->theme === 'brand')
          data-topbar="brand"
      @else
          data-topbar="dark"
      @endif data-preloader="disable" data-card-layout="borderless"
      data-bs-theme="{{ @Auth::user()->theme }}" data-topbar-image="pattern-1" data-sidebar-size="lg">

<head>
    <meta charset="utf-8"/>
    <title> @yield('title') | Світло - Моніторинг наявності світла вдома</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="{{ @Auth::user()->name }}"  name="user" >
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('/build/images/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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

                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            @yield('page-title')
                        </div>
                        <!--end col-->
                        <div class="col-md-auto ms-auto">
                            @include('layouts.customizer')
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>

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
