@extends('layouts.master')
@section('title')
    Загальна Аналітика
@endsection
@section('css')
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('/build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css">
    <style>

        /*графік*/
        .line {
            display: flex;
            position: relative;
            height: 100px;
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
                font-size: 8px;
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
               /* margin-left: -20px;*/
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
    <?php
    foreach ($all_times as $one_address => $time) {
        $times_addresses[]='"'.$one_address.'"';
        $times_online[]=$time['online'];
        $times_offline[]=$time['offline'];
    }
    // Конвертація значень в хвилини
    $onlineMinutes = [];
    $offlineMinutes = [];

    foreach ($times_online as $value) {
        $hours = floor($value);
        $minutes = $value - $hours;
        $totalMinutes = $hours * 60 + $minutes;
        $onlineMinutes[] = $totalMinutes;
    }

    foreach ($times_offline as $value) {
        $hours = floor($value);
        $minutes = $value - $hours;
        $totalMinutes = $hours * 60 + $minutes;
        $offlineMinutes[] = $totalMinutes;
    }

// Розрахунок загального часу
    $totalTime = array_sum($onlineMinutes) + array_sum($offlineMinutes);

// Розрахунок відносного значення
    $totalOnlineTime = round((array_sum($onlineMinutes) / $totalTime) * 100,1);
    $totalOfflineTime = round((array_sum($offlineMinutes) / $totalTime) * 100,1);
    ?>
    <div class="row">
        <div class="col-xl-8 col-lg-6">

            <div class="card" style="min-height: 415px;">
                <div class="card-header d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Загальні відключення по об'єктах</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <h5>{{$totalOnlineTime}}%</h5>
                            <p class="text-muted fs-sm mb-0"><i class="bi bi-circle-fill fs-3xs align-middle me-1 text-info"></i> Всі були Онлайн</p>
                        </div>
                        <div class="col-lg-6">
                            <h5>{{$totalOfflineTime}}%</h5>
                            <p class="text-muted fs-sm mb-0"><i class="bi bi-circle-fill fs-3xs align-middle me-1 text-gray"></i> Всі були Без світла</p>
                        </div>
                    </div>
                    <div id="real_time_sales"  data-colors='["--tb-info", "--tb-primary"]' class="apex-charts ms-n3" dir="ltr"></div>
                </div>
            </div>
    </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card" style="min-height: 415px;">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title mb-0 flex-grow-1">В кого більше відключень</h4>

                </div>
                <div class="card-body">
                    <div id="sales_funnel" data-colors='["--tb-primary", "--tb-success", "--tb-warning", "--tb-danger", "--tb-info"]' class="apex-charts" dir="ltr"></div>

                </div>
            </div>
        </div>
    </div>


    @foreach($all_stats as $one_stat)


    <div class="row">
        <div class="col-xl-12">

            <div class="card id-address" id="{{$one_stat['address_id']}}">
                <div class="card-header d-flex align-items-center flex-wrap gap-3">
                    <h5 class="card-title mb-0 flex-grow-1">Графік наявності світла за об'єктом "{{$one_stat['name']}}"</h5>
                    <div class="flex-shrink-0">
                        <input class="form-control form-control-sm flatpickr flatpickr-input" data-aria-date-format="d.m.Y"  data-alt-format="d.m.Y" data-date-format="d.m.Y"  data-max-date="<?=date('d.m.Y')?>"  data-provider="flatpickr" type="text" value="<?php if(isset($one_stat['date_select'])){ echo $one_stat['date_select']; }else{ echo    date('d.m.Y'); }?>" readonly="readonly">
                    </div>
                </div>
                <!--end card-header-->
                <div class="card-body">


                        <div class=" mg-b-30 res-mg-t-30">


                            <div class="line">
                                <?php

                                if (isset($one_stat['lists'])){
                                    $lineHeight = 200;
                                $day_minutes = 0;
                                $all_day_minutes = 0;
                                $count_disabled = 0;
                                $count_enabled = 0;
                                foreach ($one_stat['lists'] as $index => $time) {

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



                    <div class="row  g-3 pt-2">
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
                                         <?php if($one_stat['pingCountZero'] > 0){ echo($count_disabled / $one_stat['pingCountZero']) * 100;}else{echo 0;}?>%</span></h5>
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
                                    <h5 class="fs-lg"><span class="counter-value" data-target="<?= $one_stat['allPingCountZero']?>"></span> <span
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
        <!--end col-->
    </div>
    <!--end row-->
@endforeach
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
        const productStatusWraps = document.querySelectorAll('.product-status-wrap');
        for (const productStatusWrap of productStatusWraps) {
            productStatusWrap.addEventListener('mouseout', function() {
                resetBorders();
            });
        }







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
                console.log(content);

                // Create a popover container
                var popoverContainer = document.createElement('div');
                popoverContainer.classList.add('custom-popover');
                popoverContainer.innerHTML = '<div class="custom-popover-arrow"></div>' +
                    '<div class="custom-popover-inner">' +
                    '<div class="custom-popover-content" style="text-align: center">' + content + '</div>' +
                    '</div>';


                const lineElement = element.closest('.card'); // Знайде найближчий батьківський елемент з класом "line"


                // Append the popover container to the body
                lineElement.appendChild(popoverContainer);

                // Position the popover next to the element
                var rect = element.getBoundingClientRect();
                popoverContainer.style.position = 'absolute';
                popoverContainer.style.top = 20 + 'px';
                popoverContainer.style.left = (rect.left + rect.width / 2 - popoverContainer.offsetWidth / 2) -20 + 'px';
                popoverContainer.style.backgroundColor = 'white';
                popoverContainer.style.color = 'black';
                popoverContainer.style.padding = '10px';
                // Set a class on the element to indicate the popover is visible
                element.classList.add('popover-visible');
            }

            function hidePopover(element) {
                const lineElement = element.closest('.card'); // Знайде найближчий батьківський елемент з класом "line"

                // Remove the popover container from the body
                var popoverContainer = document.querySelector('.custom-popover');
                if (popoverContainer) {
                    lineElement.removeChild(popoverContainer);
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

        const inputFields = document.querySelectorAll('.form-control.form-control-sm.flatpickr.flatpickr-input');

        for (const inputField of inputFields) {
            inputField.addEventListener('change', function() {
                const addressElement = this.closest('.id-address');
                const parentID = addressElement.id;
                const newValue = parentID + '/' + this.value;
                const currentURL = window.location.href;
                let updatedURL;

                // Перевірка наявності дати в URL
                const urlParts = currentURL.split('/');

                if (urlParts.length === 6) {
                    // URL містить дату, оновити лише останню частину
                    updatedURL = urlParts.slice(0, -2).join('/') + '/' + newValue;
                } else {
                    // URL не містить дати, додати дату до кінця
                    updatedURL = currentURL + '/' + newValue ;
                }


                window.location.href = updatedURL;
            });
        }


        //скрол до вибраного блоку


        setTimeout(() => {
            const url = window.location.href;
            const parts = url.split('/');
            const blockId = parseInt(parts[parts.length - 2]);
            const block = document.getElementById(blockId);
            if (block) {
                block.scrollIntoView({
                    behavior: "smooth"
                });
            }
        }, 500); // Затримка на 500 мілісекунд




    </script>

    <script src="{{ URL::asset('/build/libs/list.js/list.min.js') }}"></script>

    <!-- dashboard-analytics init js -->
    <script src="{{ URL::asset('/build/js/pages/dashboard-analytics.init.js') }}"></script>
    <!-- Dashboard init -->
    <script src="{{ URL::asset('/build/js/pages/dashboard-ecommerce.init.js') }}"></script>

    <script>
        // Real time sales Chart
        var realTimeSalesColors = "#727cf5, #0acf97";
        realTimeSalesColors = getChartColorsArray("real_time_sales");
        if (realTimeSalesColors) {
            var options = {
                chart: {
                    height: 275,
                    type: 'bar',
                    stacked: true,
                    toolbar: {
                        show: false,
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '45%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 1,
                    colors: ['transparent']
                },
                legend: {
                    show: false,
                },
                series: [{
                    name: 'В мережі',
                    data: [<?php echo implode(', ', $times_online)?>]


                }, {
                    name: 'Офлайн',
                    data: [<?php echo implode(', ', $times_offline)?>],
                    color: "red"
                }],
                colors: realTimeSalesColors,
                xaxis: {
                    categories: [<?php echo implode(', ', $times_addresses)?>],
                },
                yaxis: {
                    show: true,
                },
                grid: {
                    show: true,
                    padding: {
                        right: 0,
                    },
                    borderColor: '#000',
                    xaxis: {
                        lines: {
                            show: true
                        }
                    },
                    yaxis: {
                        lines: {
                            show: false
                        }
                    },
                },
            }

            if (realTimeSalesChart != "")
                realTimeSalesChart.destroy();
            realTimeSalesChart = new ApexCharts(document.querySelector("#real_time_sales"), options);
            realTimeSalesChart.render();
        }





        // sales_funnel Charts
        var salesFunnelColors = "";
        salesFunnelColors = getChartColorsArray("sales_funnel");
        if (salesFunnelColors) {
            var options = {
                series: [<?php echo implode(', ', $times_offline)?>],
                chart: {
                    height: 325,
                    type: 'donut',
                },
                labels: [<?php echo implode(', ', $times_addresses)?>],
                legend: {
                    position: 'bottom'
                },
                dataLabels: {
                    dropShadow: {
                        enabled: false,
                    }
                },
                colors: salesFunnelColors
            };

            if (salesFunnelChart != "")
                salesFunnelChart.destroy();
            salesFunnelChart = new ApexCharts(document.querySelector("#sales_funnel"), options);
            salesFunnelChart.render();
        }

    </script>
    <!-- App js -->
    <script src="{{ URL::asset('/build/js/app.js') }}"></script>



@endsection
