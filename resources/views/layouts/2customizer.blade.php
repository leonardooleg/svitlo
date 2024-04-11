<!--start back-to-top-->
<button class="btn btn-dark btn-icon" id="back-to-top">
    <i class="bi bi-caret-up fs-3xl"></i>
</button>
<!--end back-to-top-->

<!--preloader-->
<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<div class="customizer-setting d-none d-md-block">
    <div class="btn btn-info" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
        <i class="ph ph-gear-six me-1 align-middle"></i> Customizer
    </div>
</div>

<!-- Theme Settings -->
<div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-settings-offcanvas">
    <div class="d-flex align-items-center bg-primary bg-gradient p-3 offcanvas-header">
        <div class="me-2">
            <h5 class="mb-1 text-white">Judia Builder</h5>
            <p class="text-white text-opacity-75 mb-0">Choose your themes & layouts etc.</p>
        </div>

        <button type="button" class="btn-close btn-close-white ms-auto" id="customizerclose-btn" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div data-simplebar class="h-100">
            <div class="p-4">



                <h6 class="fs-md mb-1">Color Scheme</h6>
                <p class="text-muted fs-sm">Choose Light or Dark Scheme.</p>

                <div class="colorscheme-cardradio">
                    <div class="row g-3">
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-mode-light" value="light">
                                <label class="form-check-label p-3 bg-transparent text-center" for="layout-mode-light">
                                    Light Mode
                                </label>
                            </div>
                            <h5 class="fs-sm text-center fw-medium mt-2">Light</h5>
                        </div>

                        <div class="col-4">
                            <div class="form-check card-radio dark">
                                <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-mode-dark" value="dark">
                                <label class="form-check-label p-3 bg-dark text-white text-opacity-75 text-center" for="layout-mode-dark">
                                    Dark Mode
                                </label>
                            </div>
                            <h5 class="fs-sm text-center fw-medium mt-2">Dark</h5>
                        </div>

                        <div class="col-4">
                            <div class="form-check card-radio brand">
                                <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-mode-brand" value="brand">
                                <label class="form-check-label p-3 bg-primary text-white text-opacity-75 text-center" for="layout-mode-brand">
                                    Brand Mode
                                </label>
                            </div>
                            <h5 class="fs-sm text-center fw-medium mt-2">Brand</h5>
                        </div>
                    </div>
                </div>



                <div id="layout-width">
                    <h6 class="mt-4 fs-md mb-1">Layout Width</h6>
                    <p class="text-muted fs-sm">Choose Fluid or Boxed layout.</p>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-layout-width" id="layout-width-fluid" value="fluid">
                                <label class="form-check-label p-0 avatar-md w-100" for="layout-width-fluid">
                                    <span class="d-flex h-100 flex-column gap-1">
                                        <span class="bg-light d-flex p-1 gap-1 align-items-center">
                                            <span class="d-block p-1 bg-primary-subtle rounded me-1"></span>
                                            <span class="d-block p-1 pb-0 px-2 bg-primary-subtle ms-auto"></span>
                                            <span class="d-block p-1 pb-0 px-2 bg-primary-subtle"></span>
                                        </span>
                                        <span class="bg-light d-block p-1 mt-auto"></span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-sm text-center fw-medium mt-2">Fluid</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-layout-width" id="layout-width-boxed" value="boxed">
                                <label class="form-check-label p-0 avatar-md w-100 px-2" for="layout-width-boxed">
                                    <span class="d-flex h-100 flex-column gap-1">
                                        <span class="bg-light d-flex p-1 gap-1 align-items-center">
                                            <span class="d-block p-1 bg-primary-subtle rounded me-1"></span>
                                            <span class="d-block p-1 pb-0 px-2 bg-primary-subtle ms-auto"></span>
                                            <span class="d-block p-1 pb-0 px-2 bg-primary-subtle"></span>
                                        </span>
                                        <span class="bg-light d-block p-1 mt-auto"></span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-sm text-center fw-medium mt-2">Boxed</h5>
                        </div>
                    </div>
                </div>

                <div id="layout-position">
                    <h6 class="mt-4 fs-md mb-1">Layout Position</h6>
                    <p class="text-muted fs-sm">Choose Fixed or Scrollable Layout Position.</p>

                    <div class="btn-group radio" role="group">
                        <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-fixed" value="scrollable">
                        <label class="btn btn-light w-sm" for="layout-position-fixed">Fixed</label>

                        <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-scrollable" value="scrollable">
                        <label class="btn btn-light w-sm ms-0" for="layout-position-scrollable">Scrollable</label>
                    </div>
                </div>

                <div id="sidebar-size" style="display: block;">
                    <h6 class="mt-4 mb-1 fs-md">Sidebar Size</h6>
                    <p class="text-muted">Choose a size of Sidebar.</p>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-default" value="lg">
                                <label class="form-check-label p-0 avatar-md w-100" for="sidebar-size-default">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-sm text-center mt-2">Default</h5>
                        </div>

                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-compact" value="md">
                                <label class="form-check-label p-0 avatar-md w-100" for="sidebar-size-compact">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-sm text-center mt-2">Compact</h5>
                        </div>

                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-small-hover" value="sm-hover">
                                <label class="form-check-label p-0 avatar-md w-100" for="sidebar-size-small-hover">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1">
                                                <span class="d-block p-1 bg-primary-subtle mb-2"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-sm text-center mt-2">Small Hover View</h5>
                        </div>
                    </div>
                </div>

                <div id="sidebar-color" style="display: block;">
                    <h6 class="mt-4 mb-1 fs-md">Sidebar Color</h6>
                    <p class="text-muted">Choose a color of Sidebar.</p>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient.show">
                                <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-light" value="light">
                                <label class="form-check-label p-0 avatar-md w-100" for="sidebar-color-light">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-white border-end d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-sm text-center mt-2">Light</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient.show">
                                <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-dark" value="dark">
                                <label class="form-check-label p-0 avatar-md w-100" for="sidebar-color-dark">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-primary d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-white bg-opacity-10 rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-sm text-center mt-2">Dark</h5>
                        </div>
                    </div>
                    <!-- end row -->
                </div>

                <h6 class="mt-4 fs-md mb-1">Topbar Color</h6>
                <p class="text-muted fs-sm">Choose Light, Dark or Brand Topbar Color.</p>

                <div class="row">
                    <div class="col-4">
                        <div class="form-check card-radio">
                            <input class="form-check-input" type="radio" name="data-topbar" id="topbar-color-light" value="light">
                            <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-light">
                                <span class="d-flex h-100 flex-column gap-1">
                                    <span class="bg-light d-flex p-1 gap-1 align-items-center">
                                        <span class="d-block p-1 bg-primary-subtle rounded me-1"></span>
                                        <span class="d-block p-1 pb-0 px-2 bg-primary-subtle ms-auto"></span>
                                        <span class="d-block p-1 pb-0 px-2 bg-primary-subtle"></span>
                                    </span>
                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-sm text-center fw-medium mt-2">Light</h5>
                    </div>
                    <div class="col-4">
                        <div class="form-check card-radio">
                            <input class="form-check-input" type="radio" name="data-topbar" id="topbar-color-dark" value="dark">
                            <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-dark">
                                <span class="d-flex h-100 flex-column gap-1">
                                    <span class="bg-dark d-flex p-1 gap-1 align-items-center">
                                        <span class="d-block p-1 bg-white bg-opacity-25 rounded me-1"></span>
                                        <span class="d-block p-1 pb-0 px-2 bg-white bg-opacity-25 ms-auto"></span>
                                        <span class="d-block p-1 pb-0 px-2 bg-white bg-opacity-25"></span>
                                    </span>
                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-sm text-center fw-medium mt-2">Dark</h5>
                    </div>
                    <div class="col-4">
                        <div class="form-check card-radio">
                            <input class="form-check-input" type="radio" name="data-topbar" id="topbar-color-brand" value="brand">
                            <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-brand">
                                <span class="d-flex h-100 flex-column gap-1">
                                    <span class="bg-primary d-flex p-1 gap-1 align-items-center">
                                        <span class="d-block p-1 bg-white bg-opacity-25 rounded me-1"></span>
                                        <span class="d-block p-1 pb-0 px-2 bg-white bg-opacity-25 ms-auto"></span>
                                        <span class="d-block p-1 pb-0 px-2 bg-white bg-opacity-25"></span>
                                    </span>
                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-sm text-center fw-medium mt-2">Brand</h5>
                    </div>
                </div>



                <div id="preloader-menu">
                    <h6 class="mt-4 fw-semibold fs-base">Preloader</h6>
                    <p class="text-muted fs-sm">Choose a preloader.</p>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-preloader" id="preloader-view-custom" value="enable">
                                <label class="form-check-label p-0 avatar-md w-100" for="preloader-view-custom">
                                    <span class="d-flex h-100 flex-column gap-1">
                                        <span class="bg-light d-flex p-1 gap-1 align-items-center">
                                            <span class="d-block p-1 bg-primary-subtle rounded me-1"></span>
                                            <span class="d-block p-1 pb-0 px-2 bg-primary-subtle ms-auto"></span>
                                            <span class="d-block p-1 pb-0 px-2 bg-primary-subtle"></span>
                                        </span>
                                        <span class="bg-light d-block p-1 mt-auto"></span>
                                    </span>
                                    <span class="d-flex align-items-center justify-content-center">
                                        <span class="spinner-border text-primary avatar-xxs m-auto" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </span>
                                    </span>
                                    <!-- </div> -->
                                </label>
                            </div>
                            <h5 class="fs-sm text-center fw-medium mt-2">Enable</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-preloader" id="preloader-view-none" value="disable">
                                <label class="form-check-label p-0 avatar-md w-100" for="preloader-view-none">
                                    <span class="d-flex h-100 flex-column gap-1">
                                        <span class="bg-light d-flex p-1 gap-1 align-items-center">
                                            <span class="d-block p-1 bg-primary-subtle rounded me-1"></span>
                                            <span class="d-block p-1 pb-0 px-2 bg-primary-subtle ms-auto"></span>
                                            <span class="d-block p-1 pb-0 px-2 bg-primary-subtle"></span>
                                        </span>
                                        <span class="bg-light d-block p-1 mt-auto"></span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-sm text-center fw-medium mt-2">Disable</h5>
                        </div>
                    </div>

                </div><!-- end preloader-menu -->
            </div>
        </div>

    </div>
    <div class="offcanvas-footer border-top p-3 text-center">
        <div class="row">

                <button type="button" class="btn btn-light w-100" id="reset-layout">Reset</button>

        </div>
    </div>
</div>
