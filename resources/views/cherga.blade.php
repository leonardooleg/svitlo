@extends('layouts.master')
@section('title')
    Графік відключень електроенергії
@endsection
@section('content')

@section('page-title')
  <x-breadcrumb pagetitle="Графік відключень" title="Черга - {{$cherga_id}} " />
@endsection
                        {!! $cssStyles !!}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header d-md-flex gap-3 text-center">
                                        <div class="flex-grow-1">

                                                    <h4 class="title main_header_h4">Перейти до графіку за чергою для Полтави</h4>
                                                    <div class="row cherga_block">
                                                        <a href="/grafik/1" class="cherga_el">
                                                            1 черга                        </a>
                                                        <a href="/grafik/2" class="cherga_el">
                                                            2 черга                        </a>
                                                        <a href="/grafik/3" class="cherga_el">
                                                            3 черга                        </a>
                                                        <a href="/grafik/4" class="cherga_el">
                                                            4 черга                        </a>
                                                        <a href="/grafik/5" class="cherga_el">
                                                            5 черга                        </a>
                                                        <a href="/grafik/6" class="cherga_el">
                                                            6 черга                        </a>
                                                    </div>

                                        </div>
                                        <div class="flex-shrink-0 mt-3 mt-md-0">
                                            <div class="nav nav-pills code-menu bg-light p-1 rounded" role="tablist">
                                           </div>
                                        </div>
                                    </div><!-- end card header -->
                                    <div class="card-body tab-content">
                                        <div class="tab-pane show active" id="inputExamplePreview" role="tabpanel" aria-labelledby="inputExamplePreview-tab" tabindex="0">
                                            <div class="row">

                                                <div class="col-md-12">

                                                    <!--таймер-->
                                                    {!! $timer !!}




                                                    <!--годинник-->
                                                    <div class="clocks mt-5">
                                                        <div class="clock_wrap">
                                                            <h4 class="clock1" style="">З 00:00 до 12 дня</h4>
                                                            <div class="clock clock1" style="">
                                                                <img class="clock-img" src="/build/images/clock/clock-1.png" alt="">
                                                                {!! $clock_1_h !!}
                                                                {!! $clock_1_m !!}
                                                                <div id="clock-chart__container">
                                                                    <div id="clock-chart"></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="clock_wrap">
                                                            <h4 class="clock2">З 12 дня до півночі</h4>
                                                            <div class="clock clock2">
                                                                <img class="clock-img" src="/build/images/clock/clock-2_new.png" alt="">
                                                                {!! $clock_2_h !!}
                                                                {!! $clock_2_m !!}
                                                                <div id="clock-chart__container">
                                                                    <div id="clock-chart2"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <!--таблиці-->
                                                    <div class="clock_info  mt-5">
                                                        <h5>Позначення до графіка</h5>
                                                        <p>Годинник вище йде у режимі реального часу. На ньому відповідним фоном зафарбовані певні ділянки, що означає:</p>
                                                        <div class="clock_info_wrap">
                                                            <div class="clock_info_el">
                                                                <div class="clock_info_green"></div>
                                                                - електроенергія присутня
                                                            </div>
                                                            <div class="clock_info_el">
                                                                <div class="clock_info_red"></div>
                                                                - електроенергія відсутня
                                                            </div>
                                                            <div class="clock_info_el">
                                                                <div class="clock_info_yellow"></div>
                                                                - можливе відключення за потреби
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {!! $htmlContent !!}



                                            </div>
                                                <div class="col-md-3">
                                            <!--end row-->
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

                                <script type="text/javascript">

                                    var now = new Date();
                                    var currentHour = now.getHours();
                                    var currentMinute = now.getMinutes();

                                    if (currentHour < 12 || (currentHour === 12 && currentMinute === 0)) {
                                        var clockElements = document.querySelectorAll('.clock2');
                                        for (var i = 0; i < clockElements.length; i++) {
                                            clockElements[i].style.opacity = '0.5';
                                        }
                                        const deg = 6;
                                        const hr1 = document.querySelector('#hr1');
                                        const mn1 = document.querySelector('#mn1');

                                        setInterval(() => {
                                            let day = new Date();
                                            let hh = day.getHours() * 30;
                                            let mm = day.getMinutes() * deg;

                                            hr1.style.transform = `rotateZ(${(hh) + (mm/12)}deg)`;
                                            mn1.style.transform = `rotateZ(${mm}deg)`;
                                        }, 1000);

                                    } else {
                                        var clockElements = document.querySelectorAll('.clock1');
                                        for (var i = 0; i < clockElements.length; i++) {
                                            clockElements[i].style.opacity = '0.5';
                                        }


                                        const deg = 6;
                                        const hr2 = document.querySelector('#hr2');
                                        const mn2 = document.querySelector('#mn2');

                                        setInterval(() => {
                                            let day = new Date();
                                            let hh = day.getHours() * 30;
                                            let mm = day.getMinutes() * deg;

                                            hr2.style.transform = `rotateZ(${(hh) + (mm/12)}deg)`;
                                            mn2.style.transform = `rotateZ(${mm}deg)`;
                                        }, 1000);
                                    }






                                </script>




@endsection
@section('scripts')

        <!-- prismjs plugin -->
        <script src="{{ URL::asset('/build/libs/prismjs/prism.js') }}"></script>
<!-- App js -->
<script src="{{ URL::asset('/build/js/app.js') }}"></script>
@endsection
                                <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                                <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>






                                    <script type="text/javascript">
                                    (function ($) {
                                        "use strict";

                                        $.fn.downCount = function (options, callback) {
                                            var settings = $.extend({
                                                date: null
                                            }, options);

                                            // Throw error if date is not set
                                            if (!settings.date) {
                                                $.error('Date is not defined.');
                                            }

                                            // Throw error if date is set incorrectly
                                            if (!Date.parse(settings.date)) {
                                                $.error('Incorrect date format, it should look like this, 12/24/2012 12:00:00.');
                                            }

                                            // Save container
                                            var container = this;

                                            /**
                                             * Main downCount function that calculates everything
                                             */
                                            function countdown() {
                                                var target_date = new Date(settings.date), // set target date
                                                    current_date = new Date(); // get current date in local time zone

                                                // difference of dates
                                                var difference = target_date - current_date;

                                                // if difference is negative than it's past the target date
                                                if (difference < 0) {
                                                    // stop timer
                                                    clearInterval(interval);

                                                    if (callback && typeof callback === 'function') callback();

                                                    return;
                                                }

                                                // basic math variables
                                                var _second = 1000,
                                                    _minute = _second * 60,
                                                    _hour = _minute * 60,
                                                    _day = _hour * 24;

                                                // calculate dates
                                                var days = Math.floor(difference / _day),
                                                    hours = Math.floor((difference % _day) / _hour),
                                                    minutes = Math.floor((difference % _hour) / _minute),
                                                    seconds = Math.floor((difference % _minute) / _second);

                                                // fix dates so that it will show two digits
                                                days = (String(days).length >= 2) ? days : '0' + days;
                                                hours = (String(hours).length >= 2) ? hours : '0' + hours;
                                                minutes = (String(minutes).length >= 2) ? minutes : '0' + minutes;
                                                seconds = (String(seconds).length >= 2) ? seconds : '0' + seconds;

                                                // based on the date change the reference wording
                                                var ref_days = (days === '01') ? 'day' : 'days',
                                                    ref_hours = (hours === '01') ? 'годин' : 'годин',
                                                    ref_minutes = (minutes === '01') ? 'хвилин' : 'хвилин',
                                                    ref_seconds = (seconds === '01') ? 'секунд' : 'секунд';

                                                // set to DOM
                                                container.find('.days').text(days);
                                                container.find('.hours').text(hours);
                                                container.find('.minutes').text(minutes);
                                                container.find('.seconds').text(seconds);

                                                container.find('.days_ref').text(ref_days);
                                                container.find('.hours_ref').text(ref_hours);
                                                container.find('.minutes_ref').text(ref_minutes);
                                                container.find('.seconds_ref').text(ref_seconds);
                                            };

                                            // start
                                            var interval = setInterval(countdown, 1000);
                                        };

                                    })(jQuery);




                                </script>
{!! $jsScript !!}

