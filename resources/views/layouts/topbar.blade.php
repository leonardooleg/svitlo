<div class="menu-wrapper">
    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header" id="navbar-header">
                <div class="d-flex" id="header-logo">
                    <!-- LOGO -->
                    <div class="navbar-brand-box horizontal-logo">
                        @auth()
                            <a href="/dashboard" class="logo logo-dark">
                        @elseguest()
                             <a href="/" class="logo logo-dark">
                        @endauth
                            <span class="logo-sm">
                                <img src="/build/images/logo-sm.PNG" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="/build/images/svitlo.PNG" alt=""
                                     height="22">
                            </span>
                        </a>
                        @auth()
                            <a href="/dashboard" class="logo logo-light">
                        @elseguest()
                            <a href="/" class="logo logo-light">
                        @endauth
                            <span class="logo-sm">
                                <img src="/build/images/logo-sm.PNG" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="/build/images/svitlo.PNG" alt=""
                                     height="22">
                            </span>
                        </a>
                    </div>

                    <button type="button"
                            class="btn btn-sm px-3 header-item vertical-menu-btn topnav-hamburger shadow-none"
                            id="topnav-hamburger-icon">
                        <span class="hamburger-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>

                </div>
                <!-- ========== App Menu ========== -->
                <div class="app-menu navbar-menu mx-auto opacity-0">
                    <!-- LOGO -->
                    <div class="navbar-brand-box vertical-logo">
                        @auth()
                            <a href="/dashboard" class="logo logo-dark">
                        @elseguest()
                            <a href="/" class="logo logo-dark">
                        @endauth
                            <span class="logo-sm">
                                <img src="/build/images/logo-sm.PNG" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="/build/images/svitlo.PNG" alt="" height="22">
                            </span>
                        </a>
                        @auth()
                            <a href="/dashboard" class="logo logo-light">
                        @elseauth()
                            <a href="/" class="logo logo-light">
                        @endauth
                            <span class="logo-sm">
                                <img src="/build/images/logo-sm.PNG" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="/build/images/svitlo.PNG" alt="" height="22">
                            </span>
                        </a>
                    </div>
                    <div id="scrollbar">
                        <ul class="navbar-nav" id="navbar-nav">
                            <li class="menu-title"><span data-key="t-menu">Меню</span></li>
                            <li class="nav-item">
                                <a href="/" class="nav-link menu-link">
                                    <i class="ph-house"></i> <span>Головна</span>
                                </a>
                            </li>


                            <?php
                            $address_id = $address_id ?? 1;
                            ?>
                            @if(Auth::check())
                                <li class="nav-item">
                                    <a href="/dashboard" class="nav-link menu-link">
                                        <i class="ph-gauge"></i> <span>Панель відстеження</span>
                                    </a>
                                </li>
                                @foreach(\App\Models\Address::where('user_id', Auth::user()->id)->get() as $address)
                                    <li class="nav-item">
                                        <a class="nav-link menu-link @if($address->id == $address_id ) active @endif" href="{{ route('dashboard') }}/{{ $address->id }}">
                                            <i class="ph-map-pin"></i> <span>{{ $address->name }}</span>
                                        </a>
                                    </li>
                                @endforeach

                            @endif

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="/faqs"><i class="ph-info"></i> <span>Довідка</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="/forms"><i class="ph-keyboard-thin"></i> <span>Зворотній зв'язок </span></a>
                            </li>
                            @auth

                            @else
                                <ul class="navbar-nav">
                                    <li class="menu-title"><span data-key="t-menu">Кабінет</span></li>
                                    <li class="nav-item">
                                        <a href="{{ route('login') }}" class="nav-link menu-link">
                                            <i class="ph-login"></i> <span>Увійти</span>
                                        </a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a href="{{ route('register') }}" class="nav-link menu-link">
                                                <i class="ph-login"></i> <span>Реєстрація</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>

                            @endauth

                        </ul>
                    </div>
                </div>




                <div class="d-flex align-items-center opacity-0" id="header-items">


                    <div class="dropdown topbar-head-dropdown ms-1 header-item">
                        <button type="button" class="btn btn-icon btn-topbar rounded-circle mode-layout"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-sun align-middle fs-3xl"></i>
                        </button>
                        <div class="dropdown-menu p-2 dropdown-menu-end" id="light-dark-mode">
                            <a href="#!" class="dropdown-item" data-mode="light"><i
                                    class="bi bi-sun align-middle me-2"></i> Стандартна (світла тема)</a>
                            <a href="#!" class="dropdown-item" data-mode="dark"><i
                                    class="bi bi-moon align-middle me-2"></i> Темна</a>
                            <a href="#!" class="dropdown-item" data-mode="brand"><i
                                    class="bi bi-award align-middle me-2"></i> Блакитна</a>
                            <a href="#!" class="dropdown-item" data-mode="auto"><i
                                    class="bi bi-moon-stars align-middle me-2"></i> Автоматично (системна)</a>
                        </div>
                    </div>


                    @if(Auth::check())
                    <div class="dropdown topbar-head-dropdown ms-2 header-item">
                        <button type="button" class="btn btn-icon rounded-circle" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle img-fluid"
                                 src="@if (Auth::user()->avatar != '') {{ URL::asset('images/' . Auth::user()->avatar) }}@else{{ URL::asset('build/images/users/user-dummy-img.jpg') }} @endif"
                                 alt="Header Avatar">
                        </button>
                        <div class="dropdown-menu p-2 dropdown-menu-end">
                            <div class="d-flex gap-2 mb-3 topbar-profile">
                                <div class="position-relative">
                                    <img class="rounded-1"
                                         src="@if (Auth::user()->avatar != '') {{ URL::asset('images/' . Auth::user()->avatar) }}@else{{ URL::asset('build/images/users/multi-user.jpg') }} @endif"
                                         alt="Header Avatar">
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-success"><span
                                            class="visually-hidden">unread messages</span></span>
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-sm user-name">{{ @Auth::user()->name }}</h6>
                                    <p class="mb-0 fw-medium fs-xs"><a href="#!">{{ @Auth::user()->email }}</a>
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="dropdown-item"><i
                                    class="bi bi-person align-middle me-2"></i> Профіль</a>
                            <a href="pages-profile" class="dropdown-item"><i
                                    class="bi bi-person-gear align-middle me-2"></i> Налаштування профілю</a>
                            <a href="javascript:void(0)" class="dropdown-item" href="javascript:void();"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="bi bi-box-arrow-right align-middle me-2"></i>Вийти</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <div class="vertical-overlay"></div>

    <!-- removeNotificationModal -->
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="NotificationModalbtn-close"></button>
                </div>
                <div class="modal-body p-md-5">
                    <div class="text-center">
                        <div class="text-danger">
                            <i class="bi bi-trash display-4"></i>
                        </div>
                        <div class="mt-4 fs-base">
                            <h4 class="mb-1">Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete
                            It!
                        </button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- removeCartModal -->
    <div id="removeCartModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-cartmodal"></button>
                </div>
                <div class="modal-body p-md-5">
                    <div class="text-center">
                        <div class="text-danger">
                            <i class="bi bi-trash display-5"></i>
                        </div>
                        <div class="mt-4">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this product ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="remove-cartproduct">Yes, Delete
                            It!
                        </button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
