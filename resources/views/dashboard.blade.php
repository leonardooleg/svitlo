@extends('layouts.master')
@section('title')
    Аналітика
@endsection
@section('css')
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('/build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css">
    <style>

        /*графік*/
        .line {
            display: flex;
            position: relative;
            height: 200px;
            /*background-color: #152036;*/
            border: #4b4f5e solid 1px;
            overflow: hidden; /* Щоб текст годин не виходив за межі лінії */
        }

        .line-hr {
            display: flex;
            position: relative;
            height: 40px;
            /*background-color: #fff;*/
            overflow: hidden; /* Щоб текст годин не виходив за межі лінії */
            margin-left: -20px;
        }

        .interval {
            flex-grow: 0;
            flex-shrink: 0;
            position: relative;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hour-label {
            /*color: black;*/
            flex-grow: 0;
            flex-shrink: 0;
            width: 4.08%; /* Ширина однієї години відносно всієї ширини лінії (100% / 24 години) */
            text-align: center;
            padding-top: 10px; /* Зазначте відступ від верху для вигляду */
        }
        @media (max-width: 1190px){
            .line-hr {
                display: none!important;

            }
        }
        @media (max-width: 1190px){
            .line-hr-mobile {
                font-size: 11px;
            }
            .breadcomb-ctn h2 {
                font-size: 14px;
            }
            .breadcomb-ctn p {
                font-size: 12px;
            }
            .breadcomb-icon{
                display: none;
            }
        }
        @media (max-width: 1190px){
            .hour-label {
                padding-top: 1px; /* Зазначте відступ від верху для вигляду */
            }
            .line-hr-mobile {
                display: flex!important;
                position: relative;
                height: 20px;
                background-color: #fff;
                overflow: hidden; /* Щоб текст годин не виходив за межі лінії */
                margin-left: -20px;
            }
        }

        .interval-label {
            text-align: center;
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            color: #fff;
            position: absolute;
            top: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: hidden;
        }
        .interval {
            width: 7.2222222222222%;
            background-color: green;
            position: relative;
            cursor: pointer;
        }

        .interval-label {
            text-align: center;
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            color: #fff;
            position: absolute;
            top: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .background-on-hover {
            background-color: #1b2a47 !important;
        }


        .interval-hover {
            opacity: 0.5;

        }



        /* Add styles for the custom popover arrow */
        .custom-popover-arrow {
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 10px solid white; /* Change border-bottom to border-top */
            position: absolute;
            bottom: -10px; /* Adjust to position the arrow at the bottom */
            left: 50%;
            transform: translateX(-50%);
        }

        /* Add styles for the inner popover container */
        .custom-popover-inner {
            position: relative;
        }

        /* Add styles for the custom popover title */
        .custom-popover-title {
            background-color: white;
            color: black;
            margin: 10px;
            padding: 10px;
        }

        /* Add styles for the custom popover content */

        .product-status-wrap h4 {
            font-size: 20px;
            color: #fff;
            margin-bottom: 20px;
        }
        .product-status-wrap table {
            width: 100%;
        }
        .product-status-wrap table th {
            padding: 20px 5px;
            vertical-align: top;
            border-top: 1px solid #152036;
        }
        .product-status-wrap table th {
            vertical-align: bottom;
            border-bottom: 2px solid #152036;
            /*color:#fff;*/
        }
        .product-status-wrap th, .product-status-wrap td {
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }
        .product-status-wrap table td {
            padding: 9px 7px;
            border-top: 1px solid #152036;
            /*color:#fff;*/
            font-size:14px;
        }
        .product-status-wrap img {
            width: 60px;
        }
        .custom-pagination ul.pagination li a{
            color: #fff;
            background-color: #152036;
            border: 1px solid #152036;
        }
        .custom-pagination ul.pagination{
            margin-bottom: 0px;
        }
        .product-status-wrap .pd-setting {
            border: none;
            color: #fff;
            padding: 5px 15px;
            font-size: 15px;
            background: #24caa1;
            border-radius: 3px;
        }
        .product-status-wrap .ps-setting {
            border: none;
            color: #fff;
            padding: 5px 15px;
            font-size: 15px;
            background: #2eb7f3;
            border-radius: 3px;
        }
        .product-status-wrap .ds-setting {
            border: none;
            color: #fff;
            padding: 5px 15px;
            font-size: 15px;
            background: #eb4b4b;
            border-radius: 3px;
        }


        /*календар*/
          span.flatpickr-day.now {
              border: #5340ee solid 1px;
          }
    </style>
@endsection
@section('content')

    @section('page-title')
        <h3 class="page-title text-capitalize fw-medium fs-3xl"><span>Вітаю</span> <b>{{ @Auth::user()->name }}</b> 👋</h3>
        <p class="mb-0 page-sub-title">Ми зібрали статистику за будинком: {{ $name }}.</p>
        {{-- <x-breadcrumb pagetitle="Dashonic" title="Sales Analytics" /> --}}
    @endsection

    @if (Route::currentRouteName() === 'welcome')
        @guest()
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center flex-wrap gap-3">
                            <h5 class="card-title mb-0 flex-grow-1">Про мету сайта</h5>

                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <p class="mb-0">Метою сайту є моніторинг наявності світла вдома чи підприємства та зберігання даних для подальшого аналізу використовуючи ваш IP адрес чи запустивши простий скрипт для моніторингу.</p>
                            <p class="mb-0">Сайт максимально спрощено для зручності користування сервісом з мінімальними навичками. </p>
                            <p class="mb-0">В розділі <a href="/faqs" class="text-decoration-underline">"Довідка"</a> ви знайдете, як користуватися сервісом зручним для вас методом. </p>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>
        @endguest
    @endif
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex align-items-center flex-wrap gap-3">
                    <h5 class="card-title mb-0 flex-grow-1">Графік наявності світла @if (Route::currentRouteName() === 'welcome') <span style="font-size: small">(Демонстративні дані) </span>@endif</h5>
                    <div class="flex-shrink-0">
                        <input class="form-control form-control-sm flatpickr flatpickr-input" data-aria-date-format="d.m.Y"  data-alt-format="d.m.Y" data-date-format="d.m.Y" @if (Route::currentRouteName() === 'welcome') data-min-date="<?=date('d.m.Y')?>"  @endif data-max-date="<?=date('d.m.Y')?>"  data-provider="flatpickr" type="text" value="<?php if(isset($date_select)){ echo $date_select; }else{ echo    date('d.m.Y'); }?>" readonly="readonly">
                    </div>
                </div>
                <!--end card-header-->
                <div class="card-body">


                        <div class=" mg-b-30 res-mg-t-30">



                            <div class="line">
                                <?php

                                if (isset($lists)){

                                    $lineHeight = 200;
                                $day_minutes = 0;
                                $all_day_minutes = 0;
                                $count_disabled = 0;
                                $count_enabled = 0;
                                foreach ($lists as $index => $time) {
                                    $ping=(int)$time[0];
                                    $time_interval = $time[1];
                                    // Отримайте дані інтервалу з поточного пінгу
                                    $intervalArray=explode('-',$index);
                                    $intervalEnd = $intervalArray[1];
                                    $intervalStart = $intervalArray[0];
                                    $totalMinutes = (strtotime($intervalEnd) - strtotime($intervalStart)) / 60;
                                    $all_day_minutes+=$totalMinutes;
                                    if ($ping === 0){
                                        $day_minutes+=$totalMinutes;
                                        $count_disabled++;
                                    }else{$count_enabled++;}
                                    $widthPercent = ($totalMinutes / 1440) * 100;
                                    $backgroundColor = $ping === 1 ? "rgb(87, 63, 247)" : "red";
                                    ?>
                                <div class="interval" style="width: <?= $widthPercent ?>%; background-color: <?= $backgroundColor ?>;"
                                     data-ping-content="<?= htmlspecialchars($intervalStart) ?> - <?= htmlspecialchars($intervalEnd) ?> <br> <?= htmlspecialchars($time_interval) ?>"
                                     >

                                </div>
                                <?php }} ?>
                            </div>

                            <div class="line-hr">
                                <?php
                                // Додайте блоки годин
                                for ($i = 0; $i < 24; $i++) {
                                    ?>
                                <div class="hour-label"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>:00</div>
                                <?php } ?>
                            </div>
                            <div class="line-hr-mobile"  style="display: none">
                                <?php
                                for ($i = 0; $i < 24; $i++) {
                                    $background_color = ($i % 2 == 0) ? '#1b2a47' : ''; // Set background color for every other hour
                                    $text_color = ($i % 2 == 0) ? 'white' : ''; // Set text color for every other hour
                                    ?>
                                <div class="hour-label" style="background-color: <?= $background_color ?>; color: <?= $text_color ?>;"><?= $i ?></div>
                                <?php } ?>

                            </div>
                        </div>



                    <div class="row mt-3 g-3">
                        <div class="col-md-4 col-sm-6">
                            <div class="d-flex gap-2 align-items-center border-end-sm">
                                <div class="avatar-sm flex-shrink-0">
                                    <div class="avatar-title rounded bg-light bg-opacity-50 text-secondary fs-2xl">
                                        <i class="bi bi-megaphone"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                        <?php

                                            if (!is_numeric($day_minutes)) {
                                                throw new Exception('Invalid input: minutes must be a number');
                                            }

                                            // Convert minutes to hours and minutes
                                            $hours = floor($day_minutes / 60);
                                            $remainingMinutes = $day_minutes % 60;

                                            // Format the output
                                            if ($hours === 0) {
                                                $minutes = $remainingMinutes . "0."; // If no hours, just show minutes
                                            } else {
                                                $minutes =  $hours . "." . $remainingMinutes . ""; // Otherwise, show hours and minutes
                                            }

                                        ?>


                                    <h5 class="fs-lg"><span class="counter-value" data-target="<?=$minutes?>"></span> <span
                                            class="fs-xs text-success ms-1"><i class="ph ph-trend-up align-middle me-1"></i>
                                        <?=number_format(($day_minutes / $all_day_minutes) * 100, 2) ?>%</span></h5>
                                    <p class="text-muted mb-0">Сьогодні не було світла (год.)</p>
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
                                    <h5 class="fs-lg"><span class="counter-value" data-target="<?=$count_disabled?>"></span> <span
                                            class="fs-xs text-success ms-1"><i
                                                class="ph ph-trend-down align-middle me-1"></i>
                                         <?php if($pingCountZero > 0){ echo($count_disabled / $pingCountZero) * 100;}else{echo 0;}?>%</span></h5>
                                    <p class="text-muted mb-0">Кількість відключень</p>
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
                                    <h5 class="fs-lg"><span class="counter-value" data-target="<?=$allPingCountZero?>"></span> <span
                                            class="fs-xs text-danger ms-1"> </span></h5>
                                    <p class="text-muted mb-0">Всього відключень</p>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4">
            <div class="card card-height-100">
                <div class="card-header d-flex">
                    <h5 class="card-title mb-0 flex-grow-1">Топ міст по відстеженню</h5>
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
                        <h4 class="mb-0"><span class="counter-value" data-target="{{ $pingStats['pingCountCurrent'] + 152 }}">0</span> відключень <span
                                class="text-muted fw-normal fs-sm"><span class="@if($pingStats['trend'] == 'plus') text-success @elseif($pingStats['trend'] == 'minus') text-danger @endif  fw-medium"><i
                                        class="bi @if($pingStats['trend'] == 'plus')bi-arrow-up @elseif($pingStats['trend'] == 'minus') bi-arrow-down @endif "></i> {{ $pingStats['percentageDifference'] ?? 0 }}%</span> В попередньому місяці</span></h4>
                    </div>
                    <ul class="list-unstyled vstack gap-2 mb-0">
                        @foreach($groupedCities as $city => $city_data)
                            <li class="d-flex align-items-center gap-2">
                                @if($city_data['country'] == 'Україна')
                                <img src="https://img.themesbrand.com/judia/flags/ua.svg" alt="" height="16"  class="rounded-circle object-fit-cover">
                                @else
                                    <img src="https://img.themesbrand.com/judia/flags/eu.svg" alt="" height="16"  class="rounded-circle object-fit-cover">
                                @endif
                                    <h6 class="flex-grow-1 mb-0">{{ $city }}</h6>
                                <p class="text-muted mb-0">{{ $city_data['percentage'] }}%</p>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xl-8 col-lg-8">
            <div class="card card-height-100 product-status-wrap" >
                <div class="card-header d-flex">
                    <h5 class="card-title mb-0 flex-grow-1">Часові інтервали</h5>
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <th>Інтервал</th>
                            <th>Час</th>
                            <th>Статус</th>
                        </tr>
                        <?php
                        if (isset($lists)) {
                            $t = 0;
                            foreach ($lists as $one_data => $status) {
                                echo ' <tr>';
                                echo '<td>' . $one_data . '</td>';
                                echo '<td>' . $status[1] . '</td>';
                                if ($status[0] == "0") echo ' <td> <button class="ds-setting">Відсутнє</button>  </td>';
                                else if ($status[0] == "1") echo ' <td> <button class="pd-setting">Є світло</button>  </td>';
                                echo ' </tr>';

                                $t++;
                            }
                        }else{
                            echo ' <tr>';
                            echo '<td>Так далеко ми не можемо заглянути</td>';
                            echo '<td>Не визначено</td>';
                            echo ' </tr>';
                        }
                        ?>


                    </table>
                </div>
            </div>
        </div>

        <!--end col-->
    </div>
    <!--end row-->

@endsection
@section('scripts')
    <script>
        var tds = document.querySelectorAll('.product-status-wrap tr');
        var intervals = document.querySelectorAll('.interval');

            var resetBorders = function () {
                intervals.forEach(function (interval) {
                    interval.classList.remove('border-on-hover');
                    interval.classList.remove('background-on-hover');
                    interval.classList.remove('interval-hover');
                });
            };
            tds.forEach(function (tr, index) {
                tr.addEventListener('mouseover', function () {
                    resetBorders();

                    intervals.forEach(function (interval) {
                            interval.classList.add('interval-hover');
                            intervals[index - 1].classList.add('border-on-hover');
                            intervals[index - 1].classList.remove('interval-hover');

                    });
                });

                tr.addEventListener('mouseout', function () {
                    resetBorders();
                });
            });
            // Add this event listener to remove interval-hover class when mouse leaves product-status-wrap
            document.querySelector('.product-status-wrap').addEventListener('mouseout', function () {
                resetBorders();
            });






    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var intervals = document.querySelectorAll('.interval');

            intervals.forEach(function (interval) {
                interval.addEventListener('mouseover', function () {
                    showPopover(this);
                });

                interval.addEventListener('mouseout', function () {
                    hidePopover(this);
                });
            });

            function showPopover(element) {
                var content = element.getAttribute('data-ping-content');


                // Create a popover container
                var popoverContainer = document.createElement('div');
                popoverContainer.classList.add('custom-popover');
                popoverContainer.innerHTML = '<div class="custom-popover-arrow"></div>' +
                    '<div class="custom-popover-inner">' +
                    '<div class="custom-popover-content" style="text-align: center">' + content + '</div>' +
                    '</div>';

                // Append the popover container to the body
                document.body.appendChild(popoverContainer);

                // Position the popover next to the element
                var rect = element.getBoundingClientRect();
                popoverContainer.style.position = 'absolute';
                popoverContainer.style.top = -20 + rect.top + 'px';
                popoverContainer.style.left = (rect.left + rect.width / 2 - popoverContainer.offsetWidth / 2) - 10 + 'px';
                popoverContainer.style.backgroundColor = 'white';
                popoverContainer.style.color = 'black';
                popoverContainer.style.padding = '10px';
                // Set a class on the element to indicate the popover is visible
                element.classList.add('popover-visible');
            }

            function hidePopover(element) {
                // Remove the popover container from the body
                var popoverContainer = document.querySelector('.custom-popover');
                if (popoverContainer) {
                    document.body.removeChild(popoverContainer);
                }

                // Remove the class indicating the popover is visible
                element.classList.remove('popover-visible');
            }
        });
    </script>
    <!-- apexcharts -->

    <script src="{{ URL::asset('/build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/build/js/uk.js') }}"></script>

    <script>
        // Initialize flatpickr with Ukrainian localization
        flatpickr.localize(flatpickr.l10ns.uk);

        // Set ariaDateFormat for flatpickr calendar
        flatpickr(".flatpickr-calendar", {
            ariaDateFormat: "d.m.Y",
        });

        const inputField = document.querySelector('.form-control.form-control-sm.flatpickr.flatpickr-input');

        inputField.addEventListener('change', function() {
            const newValue = this.value;
            const currentURL = window.location.href;
            let updatedURL;

            // Перевірка наявності дати в URL
            const urlParts = currentURL.split('/');
            const hasDate = urlParts.length > 6 && !isNaN(parseInt(urlParts[urlParts.length - 1]));

            if (hasDate) {
                // URL містить дату, оновити лише останню частину
                updatedURL = urlParts.slice(0, -1).join('/') + '/' + newValue;
            } else {
                // URL не містить дати, додати дату до кінця
                updatedURL = currentURL + '/' + newValue;
            }

            window.location.href = updatedURL;
        });






    </script>
    <script src="{{ URL::asset('/build/libs/list.js/list.min.js') }}"></script>

    <!-- dashboard-analytics init js -->
    <script src="{{ URL::asset('/build/js/pages/dashboard-analytics.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('/build/js/app.js') }}"></script>



@endsection
