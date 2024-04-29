<?php

use App\Models\Ping;

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::call(function () {

    $ip_address = \App\Models\Address::whereNotNull('ip_address')->get();
    foreach ($ip_address as $one_address) {
        //get ping
        $maxAttempts = 3;  // Максимальна кількість спроб ping
        $timeout = 180;      // Таймаут очікування (мс)
        $sleepTime = 20;     // Час затримки між спробами (мс)

        $latency = 0;
        $host = $one_address['ip_address'];
        $ttl = 128;

        // Створити об'єкт ping один раз
        $ping = new \JJG\Ping($host, $ttl, $timeout);

        for ($attempt = 1; $attempt <= $maxAttempts && !$latency; $attempt++) {
            try {
                $latency = $ping->ping();  // Вказати таймаут при виклику ping
            } catch (\Exception $e) {
                echo 'Помилка ping (' . $attempt . ' спроба): ' . $e->getMessage() . '<br>';
            }

            if (!$latency && $attempt < $maxAttempts) {
                sleep($sleepTime / 1000); // Затримка в секундах
            }
        }

        $message = $latency !== 0
            ? $one_address['ip_address'] . ' - Затримка: ' . $latency . ' ms (' . date('Y-m-d H:i:s') . ')'
            : $one_address['ip_address'] . ' - Не відповідає (' . date('Y-m-d H:i:s') . ')';

        // Зберігання даних (замінити на prepared statement)
        if ($latency >=1) {
            $latency = 1;
        }else{
            $latency = 0;
        }
        $pings = Ping::where('address_id', $one_address['id']);
        $now_time = time();
        if ($pings->count() > 0) {
            $last_ping = $pings->latest('last_activity')->first();
            if ($last_ping->ping != $latency) {
                // Створити новий запис Ping
                Ping::create([
                    'address_id' => $one_address['id'],
                    'ping' => $latency,
                    'last_activity' => $now_time,
                    'time_check' => $now_time,
                ]);
            }else{
                // оновити запис Ping
                $last_ping->update([
                    'time_check' => $now_time
                ]);
            }
        } else {
            // Створити новий запис Ping, оскільки не знайдено попередніх записів
            Ping::create([
                'address_id' => $one_address['id'],
                'ping' => $latency,
                'last_activity' => $now_time,
                'time_check' => $now_time,
            ]);
        }


    }

    $url_address = \App\Models\Address::whereNotNull('url_address')->get();
    foreach ($url_address as $url_address) {

        ///////////////////////
        $url_pings = Ping::where('address_id', $url_address['id']);
        $now_time = time();
        if ($url_pings->count() > 0) {
            $last_ping = $url_pings->latest('time_check')->first();
            $now_date= (int)strtotime("-7 minutes");
            $status_date=(int)$last_ping->time_check;
            if($now_date<$status_date){

                    $last_ping->update([
                        'time_check' => $now_time
                    ]);

                print 'Дім '.$url_address['name'].'  - Оновлюється';
            }else{
                if ($last_ping->ping == 1) {
                    Ping::create([
                        'address_id' => $url_address['id'],
                        'ping' => 0,
                        'last_activity' => $now_time,
                        'time_check' => $now_time,
                    ]);
                    print 'Дім '.$url_address['name'].'  - Застарів.';
                }else{
                    $last_ping->update([
                        'time_check' => $now_time
                    ]);
                }
            }
        }
    }



})->everyMinute();
//})->everyThreeMinutes();



