@extends('layouts.master')
@section('title')
    Profile
@endsection
@section('css')
    <!-- Sweet Alert css-->
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')

    @section('page-title')
        <x-breadcrumb pagetitle="Pages" title="Profile"/>
    @endsection

    <div class="card">
        <div class="card-body rounded-top py-2">

        </div>
        <div class="card-body">
            <div class="mt-n5">
                <div class="mt-n2 row g-3 g-sm-0 align-items-end gap-3">

                    <div class="col-sm-auto">
                        <div class="position-relative d-inline-block">
                            <img
                                src="@if (Auth::user()->avatar != '') {{ URL::asset('images/' . Auth::user()->avatar) }}@else{{ URL::asset('build/images/users/user-dummy-img.jpg') }} @endif"
                                alt=""
                                class="avatar-xl rounded p-1 bg-body-secondary">
                            <span class="position-absolute profile-dot bg-success rounded-circle"><span
                                    class="visually-hidden">unread messages</span></span>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="mt-4">
                            <h5>{{ Auth::user()->name  }} <i
                                    class="bi bi-patch-check-fill align-baseline text-info ms-1"></i></h5>
                            <p class="text-muted mb-3">{{ Auth::user()->email  }}</p>
                        </div>
                    </div>
                    <div class="col-sm-auto mb-3">
                        <div class="hstack gap-2">
                            <button class="btn btn-subtle-success">Hire Now</button>
                            <button type="button" class="btn btn-outline-secondary custom-toggle active"
                                    data-bs-toggle="button" aria-pressed="false">
                                <span class="icon-on"><i class="ri-add-line align-bottom me-1"></i> Follow</span>
                                <span class="icon-off"><i class="ri-user-unfollow-line align-bottom me-1"></i>
                                Unfollow</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <div class="card" id="adresses-index">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="bg-light p-3 rounded">
                        <div class="nav flex-md-column nav-pills text-center gap-2" id="v-pills-tab" role="tablist"
                             aria-orientation="vertical">

                            <a class="nav-link active" id="myWallets-tab" data-bs-toggle="pill" href="#myWallets"
                               role="tab"
                               aria-controls="myWallets" aria-selected="true" tabindex="-1">Мої будинки</a>
                            <a class="nav-link" id="settings-tab" data-bs-toggle="pill" href="#settings" role="tab"
                               aria-controls="settings" aria-selected="false" tabindex="-1">Налаштування</a>
                            <a class="nav-link" id="changePassword-tab" data-bs-toggle="pill" href="#changePassword"
                               role="tab" aria-controls="changePassword" aria-selected=""
                               tabindex="-1">Змінити пароль</a>
                        </div>
                    </div>
                </div><!-- end col -->
                <div class="col-md-9">
                    <div class="tab-content mt-4 mt-md-0" id="v-pills-tabContent">

                        <div class="tab-pane fade show active" id="myWallets" role="tabpanel"
                             aria-labelledby="myWallets-tab">


                            <div class="d-flex align-items-center gap-2 flex-wrap mb-3">
                                <h6 class="card-title flex-grow-1 mb-0">Список відстеження</h6>
                                <div class="flex-shrink-0">
                                    <button class="btn btn-subtle-danger d-none" id="remove-actions" onClick="deleteMultiple()"><i
                                            class="ri-delete-bin-2-line"></i></button>
                                    <button class="btn btn-primary add-btn" data-bs-toggle="modal" data-bs-target="#addModal"><i
                                            class="bi bi-plus align-baseline"></i> Додати будинок</button>
                                </div>
                            </div>
                            <div id="transactionsList">
                                <div class="table-responsive table-card">
                                    <table
                                        class="table table-custom align-middle table-borderless table-custom-effect table-nowrap mb-0">
                                        <thead class="table-light">
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="option"
                                                           id="checkAll">
                                                    <label class="form-check-label" for="checkAll"></label>
                                                </div>
                                            </th>
                                            <th class="sort cursor-pointer" data-sort="name">Будинок</th>
                                            <th class="sort cursor-pointer" data-sort="company_name">Статус</th>
                                            <th class="sort cursor-pointer" data-sort="membership">Остання активність</th>
                                            <th class="sort cursor-pointer" data-sort="membership">Доступ</th>
                                            <th>Дія</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @if (isset($addresses))
                                            @foreach ($addresses as $address)
                                                <tr id="parentDiv" data-address-id="{{ $address['address']['id'] }}"
                                                @if ($address['address']['ip_address'])
                                                        data-address-ip="{{ $address['address']['ip_address'] }}"
                                                @elseif($address['address']['url_address'])
                                                        data-address-url="{{ $address['address']['url_address'] }}"
                                                @endif
                                                >
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="chk_child">
                                                            <label class="form-check-label"></label>
                                                        </div>
                                                    </td>
                                                    <td class="id" style="display:none;">
                                                        <a href="apps-customers-overview" class="fw-medium link-primary">#TB01</a></td>
                                                    <td class="name">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <a href="#showModal" class="text-reset" data-bs-toggle="modal">
                                                                <h6 class="mb-0 flex-grow-1 text-reset contactname"> {{ $address['address']['name'] }}</h6>
                                                            </a>
                                                        </div>
                                                    </td>

                                                    <td class="membership">
                                                        @if ($address['ping']['ping'] === 1)
                                                            <span class="badge bg-warning">Онлайн</span>
                                                        @else
                                                            <span class="badge bg-danger">Офлайн </span>
                                                        @endif
                                                    <td class="date">
                                                        @if ($address['minutesAgo'] >= 1)
                                                            {{ $address['minutesAgo'] }} хв. назад
                                                        @else
                                                            не має даних
                                                        @endif
                                                    </td>
                                                    <td class="membership address_public">
                                                            @if ($address['address']['public'] === 1)
                                                                <span class="badge bg-success address_public_status">Публічна</span>
                                                                <span class="address_link d-none" >{{$address['address']['link']}}</span>
                                                            @else
                                                                <span class="badge bg-info address_public_status">Приватна </span>
                                                            @endif

                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="btn btn-icon btn-subtle-secondary btn-sm dropdown-btn"
                                                               href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                               aria-expanded="false">
                                                                ...
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">

                                                                <a class="dropdown-item edit-item-btn" href="#editModal"
                                                                   data-bs-toggle="modal">Змінити</a>
                                                                <a class="dropdown-item remove-item-btn" href="#deleteRecordModal"
                                                                   data-bs-toggle="modal">Видалити</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        </tbody>
                                    </table>
                                </div>



                            </div>
                        </div>

                        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                            <h6 class="card-title mb-3">Налаштування профілю</h6>
                            <div class="text-center">

                                <div class="mt-3">
                                    <h5>{{ Auth::user()->name  }} <i
                                            class="bi bi-patch-check-fill align-baseline text-info ms-1"></i></h5>
                                    <p class="text-muted">Власник будинків</p>
                                </div>
                            </div>
                            <form action="{{ route('profile.update') }}" method="post">
                                {{@csrf_field()}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="firstnameInput" class="form-label">Нікнейм</label>
                                            <input type="text" class="form-control" name="name" id="firstnameInput"
                                                   placeholder="Введіть нікнейм" value="{{ Auth::user()->name  }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Email адреса</label>
                                            <input type="email"  name="email" class="form-control" id="emailInput"
                                                   placeholder="Введіть свій email" value="{{ Auth::user()->email  }}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="cityInput" class="form-label">Місто</label>
                                            <input type="text"  name="city" class="form-control" id="cityInput" placeholder="Ваше місто"
                                                   value="{{ Auth::user()->city  }}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="countryInput" class="form-label">Країна</label>
                                            <input type="text"  name="country" class="form-control" id="countryInput"
                                                   placeholder="Ваша країна" value="{{ Auth::user()->country ?? 'Україна' }}">
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <!--end col-->

                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Оновити</button>
                                            <button type="button" class="btn btn-subtle-danger">Відміна</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <div class="tab-pane fade" id="changePassword" role="tabpanel"
                             aria-labelledby="changePassword-tab">
                            <h6 class="card-title mb-3">Змінити пароль</h6>
                            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                @csrf
                                @method('put')
                                <div class="row g-2 justify-content-lg-between align-items-center">
                                    <div class="col-lg-4">
                                        <div class="auth-pass-inputgroup">
                                            <label for="oldpasswordInput" class="form-label">Старий пароль*</label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control password-input"
                                                       id="oldpasswordInput" name="current_password" placeholder="Введіть старий пароль">
                                                <button
                                                    class="btn btn-link position-absolute top-0 end-0 text-decoration-none text-muted password-addon"
                                                    type="button"><i class="ri-eye-fill align-middle"></i></button>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="auth-pass-inputgroup">
                                            <label for="password-input" class="form-label">Новий пароль*</label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control password-input"
                                                       id="password-input" onpaste="return false"
                                                       placeholder="Введіть новий пароль"  name="password"
                                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="auth-pass-inputgroup">
                                            <label for="confirm-password-input" class="form-label">Підтвердіть пароль*</label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control password-input"
                                                       onpaste="return false" id="confirm-password-input"
                                                       placeholder="Підтвердіть пароль" name="password_confirmation"
                                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a
                                           class="link-primary text-decoration-underline"></a>
                                        <div class="">

                                            <button type="submit" class="btn btn-success">Змінити пароль</button>
                                        </div>
                                    </div>

                                    <!--end col-->

                                    <div class="col-lg-12">
                                        <div class="card bg-light shadow-none passwd-bg" id="password-contain">
                                            <div class="card-body">
                                                <div class="mb-4">
                                                    <h5 class="fs-sm">Password must contain:</h5>
                                                </div>
                                                <div class="">
                                                    <p id="pass-length" class="invalid fs-xs mb-2">Minimum <b>8
                                                            characters</b></p>
                                                    <p id="pass-lower" class="invalid fs-xs mb-2">At <b>lowercase</b>
                                                        letter (a-z)</p>
                                                    <p id="pass-upper" class="invalid fs-xs mb-2">At least
                                                        <b>uppercase</b> letter (A-Z)</p>
                                                    <p id="pass-number" class="invalid fs-xs mb-0">A least <b>number</b>
                                                        (0-9)</p>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--end row-->
                            </form>


                        </div>
                    </div>
                </div><!--  end col -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header bg-soft-info p-3">
                    <h5 class="modal-title" id="exampleModalLabel2"></h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                </div>
                <form class="tablelist-form" novalidate autocomplete="off">
                    <div class="modal-body">
                        <div id="alert-error-msg" class="d-none alert alert-danger py-2"></div>

                        <div class="row g-3">
                            <div class="col-lg-12">
                                <div>
                                    <label for="customername-field2" class="form-label">Назва</label>
                                    <input type="text" id="customername-field2" name="name" class="form-control"
                                           placeholder="Введіть назву" required />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="type-field2" class="form-label">Виберіть тип</label>
                                    <select class="form-control" name="type-field2" id="typeField2" required>
                                        <option type="text" value="ip">Моя IP адреса</option>
                                        <option type="text" value="url">Отримати url для запитів</option>
                                    </select>
                                    <div id="typedHelpBlock" class="form-text">
                                        Вкажіть свою <a href="/faqs#info-ip">IP адресу</a>
                                        або отримайте посилання для ваших запитів зручним для вас <a href="/faqs#info-myUrl">способом</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="ip_address2" class="form-label">Ваш IP адрес</label>
                                    <input type="text" id="ip_address2" name="ip_address" class="form-control"
                                           placeholder="Введіть IP адрес"  />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="url_address2" class="form-label">Ваш URL для надсилання запитів</label>
                                    <input type="text" id="url_address2" name="url_address" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="membership-field2" class="form-label">Доступ</label>
                                    <select class="form-control" name="membership-field2" id="membership-field2" required >
                                    <option type="number" value="0">Приватна</option>
                                    <option type="number" value="1">Публічна</option>


                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div style="display: none">
                                    <label for="link_id-field2" class="form-label">Публічне посилання</label>
                                    <input type="text" id="link_id-field2" name="link" class="form-control"
                                           placeholder="ваш лінк"  />
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Закрити</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Додати</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal-dialog -->
    </div>
    <!--end add modal-->

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header bg-soft-info p-3">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                </div>
                <form class="tablelist-form" novalidate autocomplete="off">
                    <div class="modal-body">
                        <div id="alert-error-msg" class="d-none alert alert-danger py-2"></div>
                        <input type="hidden" id="id-field" name="id">
                        <div class="row g-3">
                            <div class="col-lg-12">

                                <div>
                                    <label for="customername-field" class="form-label">Назва</label>
                                    <input type="text" id="customername-field" name="name" class="form-control"
                                           placeholder="Введіть назву" required />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="type-field" class="form-label">Виберіть тип</label>
                                    <select class="form-control" name="type-field" id="typeField" required>
                                        <option type="text" value="ip">Моя IP адреса</option>
                                        <option type="text" value="url">Отримати url для запитів</option>
                                    </select>
                                    <div id="typedHelpBlock" class="form-text">
                                        Вкажіть свою <a href="/faqs#info-ip">IP адресу</a>
                                        або отримайте посилання для ваших запитів зручним для вас <a href="/faqs#info-myUrl">способом</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="ip_address" class="form-label">Ваш IP адрес</label>
                                    <input type="text" id="ip_address" name="ip_address" class="form-control"
                                           placeholder="Введіть IP адрес" required />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="url_address" class="form-label">Ваш URL для надсилання запитів</label>
                                    <input type="text" id="url_address" name="url_address" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="membership-field" class="form-label">Доступ</label>
                                    <select class="form-control" name="membership-field" id="membership-field"
                                            required />
                                    <option type="number" value="1">Публічна</option>
                                    <option type="number" value="0">Приватна</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="email_id-field" class="form-label">Публічне посилання</label>
                                    <input type="text" id="link_id-field" name="link" class="form-control"
                                           placeholder="ваш лінк"  />
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light close-modal" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="update_address">Оновити</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal-dialog -->
    </div>
    <!--end add modal-->

    <!-- deleteRecordModal -->
    <div id="deleteRecordModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close close-modal" id="deleteRecord-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body p-md-5">
                    <div class="text-center">
                        <div class="text-danger">
                            <i class="bi bi-trash display-5"></i>
                        </div>
                        <div class="mt-4">
                            <h4 class="mb-2">Ви впевнені ?</h4>
                            <p class="text-muted mx-3 mb-0">Ви точно хочете видалити цей запис?
                            </p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 pt-2 mb-2">
                        <button type="button" class="btn w-sm btn-light btn-hover"
                                data-bs-dismiss="modal">Закрити</button>
                        <button type="button" class="btn w-sm btn-danger btn-hover" id="delete-record">Так, Видалити!</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /deleteRecordModal -->


@endsection
@section('scripts')
    <!-- sweetalert2 js -->
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!--list js-->

    <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <!-- password-create init -->
    <script src="{{ URL::asset('build/js/pages/passowrd-create.init.js') }}"></script>

    <!-- customer -->
    <script src="{{ URL::asset('build/js/pages/addresses-list.init.js') }}"></script>

    <!--profile init js-->
    {{--<script src="{{ URL::asset('build/js/pages/profile.init.js') }}"></script>--}}

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn')) {
                var ariaExpanded = e.target.getAttribute('aria-expanded');
                var tableResponsive = document.querySelector('.table-responsive');

                if (ariaExpanded === 'true') {
                    tableResponsive.style.overflowX = 'visible';
                } else {
                    tableResponsive.style.overflowX = 'auto';
                }
            } else {
                var tableResponsive = document.querySelector('.table-responsive');
                tableResponsive.style.overflowX = 'auto';
            }
        });
    </script>
@endsection
