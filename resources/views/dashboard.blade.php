@extends('layouts.master')
@section('title')
    Analytics
@endsection
@section('css')
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')

    @section('page-title')
        <h3 class="page-title text-capitalize fw-medium fs-3xl"><span>Вітаю</span> <b>{{ @Auth::user()->name }}</b> 👋</h3>
        <p class="mb-0 page-sub-title">Ми зібрали статистику за вашим будинком.</p>
        {{-- <x-breadcrumb pagetitle="Dashonic" title="Sales Analytics" /> --}}
    @endsection

    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header d-flex align-items-center flex-wrap gap-3">
                    <h5 class="card-title mb-0 flex-grow-1">Графік наявності ствітла</h5>
                    <div class="flex-shrink-0">
                        <input type="text" class="form-control form-control-sm" data-provider="flatpickr"
                               data-date-format="d M, Y" data-default-date="14 Jun 2022 to 16 Jun 2022" data-range-date="true">
                    </div>
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div id="pageviews_overview" data-colors='["--tb-primary", "--tb-light"]' class="apex-charts ms-n3"
                         dir="ltr"></div>
                    <div class="row mt-3 g-3">
                        <div class="col-md-4 col-sm-6">
                            <div class="d-flex gap-2 align-items-center border-end-sm">
                                <div class="avatar-sm flex-shrink-0">
                                    <div class="avatar-title rounded bg-light bg-opacity-50 text-secondary fs-2xl">
                                        <i class="bi bi-megaphone"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fs-lg"><span class="counter-value" data-target="7490"></span> <span
                                            class="fs-xs text-success ms-1"><i class="ph ph-trend-up align-middle me-1"></i>
                                        11.78%</span></h5>
                                    <p class="text-muted mb-0">Social Media</p>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-md-4 col-sm-6">
                            <div class="d-flex gap-2 align-items-center border-end-sm">
                                <div class="avatar-sm flex-shrink-0">
                                    <div class="avatar-title rounded bg-light bg-opacity-50 text-info fs-2xl">
                                        <i class="bi bi-globe"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fs-lg"><span class="counter-value" data-target="6583"></span> <span
                                            class="fs-xs text-success ms-1"><i class="ph ph-trend-up align-middle me-1"></i>
                                        07.25%</span></h5>
                                    <p class="text-muted mb-0">Website</p>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-md-4 col-sm-6">
                            <div class="d-flex gap-2 align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <div class="avatar-title rounded bg-light bg-opacity-50 text-body fs-2xl">
                                        <i class="bi bi-clock-history"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fs-lg"><span class="counter-value" data-target="14652"></span> <span
                                            class="fs-xs text-danger ms-1"><i
                                                class="ph ph-trend-down align-middle me-1"></i> 02.31%</span></h5>
                                    <p class="text-muted mb-0">Avg. Session Duration</p>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xl-3 col-lg-6">
            <div class="card card-height-100">
                <div class="card-header d-flex">
                    <h5 class="card-title mb-0 flex-grow-1">Weekly Visitors</h5>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted fs-lg"><i class="bi bi-three-dots-vertical"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#!">Current Years</a>
                                <a class="dropdown-item" href="#!">Last Years</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="weekly_visitors" data-colors='["--tb-info", "--tb-primary"]' class="apex-charts"
                         dir="ltr"></div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xl-4 col-lg-6">
            <div class="card card-height-100">
                <div class="card-header d-flex">
                    <h5 class="card-title mb-0 flex-grow-1">Audience Sessions by Country</h5>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted fs-lg"><i class="bi bi-three-dots-vertical"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#!">Current Years</a>
                                <a class="dropdown-item" href="#!">Last Years</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="session_country" data-colors='["--tb-primary", "--tb-card-bg"]' class="apex-charts ms-n3"
                         dir="ltr"></div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xl-4">
            <div class="card card-height-100">
                <div class="card-header d-flex">
                    <h5 class="card-title mb-0 flex-grow-1">Traffic Channel</h5>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted fs-lg"><i class="bi bi-three-dots-vertical"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#!">Current Years</a>
                                <a class="dropdown-item" href="#!">Last Years</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="simple_bubble" data-colors='["--tb-primary", "--tb-info"]' class="apex-charts ms-n3"
                         dir="ltr"></div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xl-4 col-lg-6">
            <div class="card card-height-100">
                <div class="card-header d-flex">
                    <h5 class="card-title mb-0 flex-grow-1">Sales Funnel</h5>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted fs-lg"><i class="bi bi-three-dots-vertical"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#!">This Years</a>
                                <a class="dropdown-item" href="#!">Last Years</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="sales_funnel"
                         data-colors='["--tb-primary", "--tb-success", "--tb-warning", "--tb-danger", "--tb-info"]'
                         class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xl-4 col-lg-6">
            <div class="card card-height-100">
                <div class="card-header d-flex">
                    <h5 class="card-title mb-0 flex-grow-1">Top Country</h5>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted fs-lg"><i class="bi bi-three-dots-vertical"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#!">This Years</a>
                                <a class="dropdown-item" href="#!">Last Years</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="p-3 text-center bg-light bg-opacity-50 mb-4 rounded">
                        <h4 class="mb-0">$<span class="counter-value" data-target="314.57">0</span>M <span
                                class="text-muted fw-normal fs-sm"><span class="text-success fw-medium"><i
                                        class="bi bi-arrow-up"></i> +23.57%</span> Last Month</span></h4>
                    </div>
                    <ul class="list-unstyled vstack gap-2 mb-0">
                        <li class="d-flex align-items-center gap-2">
                            <img src="https://img.themesbrand.com/judia/flags/us.svg" alt="" height="16"
                                 class="rounded-circle object-fit-cover">
                            <h6 class="flex-grow-1 mb-0">United States</h6>
                            <p class="text-muted mb-0">39.41%</p>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <img src="https://img.themesbrand.com/judia/flags/de.svg" alt="" height="16"
                                 class="rounded-circle object-fit-cover">
                            <h6 class="flex-grow-1 mb-0">Germany</h6>
                            <p class="text-muted mb-0">16.84%</p>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <img src="https://img.themesbrand.com/judia/flags/fr.svg" alt="" height="16"
                                 class="rounded-circle object-fit-cover">
                            <h6 class="flex-grow-1 mb-0">France</h6>
                            <p class="text-muted mb-0">12.54%</p>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <img src="https://img.themesbrand.com/judia/flags/ru.svg" alt="" height="16"
                                 class="rounded-circle object-fit-cover">
                            <h6 class="flex-grow-1 mb-0">Russia</h6>
                            <p class="text-muted mb-0">11.13%</p>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <img src="https://img.themesbrand.com/judia/flags/br.svg" alt="" height="16"
                                 class="rounded-circle object-fit-cover">
                            <h6 class="flex-grow-1 mb-0">Brazil</h6>
                            <p class="text-muted mb-0">9.17%</p>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <img src="https://img.themesbrand.com/judia/flags/se.svg" alt="" height="16"
                                 class="rounded-circle object-fit-cover">
                            <h6 class="flex-grow-1 mb-0">Sweden</h6>
                            <p class="text-muted mb-0">1.25%</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xl-5 col-lg-6">
            <div class="card card-height-100">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Sales Report</h5>
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-subtle-info btn-sm"><i
                                class="bi bi-file-earmark-text me-1 align-baseline"></i> Generate Reports</button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="sales_Report" data-colors='["--tb-primary", "--tb-danger"]' class="apex-charts ms-n3"
                         dir="ltr"></div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xl-3 col-lg-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title mb-2">Your team Performance this week</h5>
                    <div id="team_performance" data-colors='["--tb-primary"]' class="apex-charts" dir="ltr"></div>
                    <p class="text-muted mt-4">Your team performance is <b>8%</b> better than this week</p>
                    <button class="btn btn-info">View Details</button>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

@endsection
@section('scripts')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>

    <!-- dashboard-analytics init js -->
    <script src="{{ URL::asset('build/js/pages/dashboard-analytics.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
