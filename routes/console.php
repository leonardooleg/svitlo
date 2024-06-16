<?php

use App\Models\Ping;

use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;
use App\Helpers\NotificationHelper;






    $notificationHelper = new NotificationHelper();

    $ip_address = \App\Models\Address::whereNotNull('ip_address')->get();

    foreach ($ip_address as $one_address) {

        //get ping
        $maxAttempts = 3;  // Максимальна кількість спроб ping
        $timeout = 15;      // Таймаут очікування (мс)



        $host = $one_address['ip_address'];
        $ttl = 128;
        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            try {
                $latency = 0;
                if (PHP_OS_FAMILY === 'Windows') {
                    // Команда ping для Windows
                    $command = sprintf('ping -n 1 -i %d -w %d %s', $ttl, $timeout * 1000, escapeshellarg($host));
                } else {
                    // Команда ping для Unix-подібних систем
                    $command = sprintf('ping -c 1 -t %d -W %d %s', $ttl, $timeout, escapeshellarg($host));
                }

                // Виконуємо команду
                exec($command, $output, $resultCode);

                // Перевіряємо результат виконання
                if ($resultCode === 0) {
                    $latency = 1;
                    // Зупинити цикл, якщо отримано відповідь
                    break;
                } else {
                    $latency = 0;
                }

            } catch (\Exception $e) {
                echo 'Помилка ping (' . $attempt . ' спроба): ' . $e->getMessage() . "\n";
            }

            if (!$latency && $attempt < $maxAttempts) {
                sleep(15); // Затримка в секундах
            }
        }

        $message = $latency != 0
            ? date('Y-m-d H:i:s') . ' - ' . $one_address['name']." - ".$host . ' - Онлайн'
            : date('Y-m-d H:i:s') . ' - ' . $one_address['name']." - ".$host . ' - Не відповідає';

               // Зберігання даних (замінити на prepared statement)
        if ($latency == 1) {
            $latency = 1;
            $status = 'В мережі';
        }else{
            $latency = 0;
            $status = 'Офлайн';
        }


        $pings = Ping::where('address_id', $one_address['id']);
        $now_time = time();
        if ($pings->count() > 0) {
            $last_ping = $pings->latest('last_activity')->first();
            if ($last_ping->ping !== $latency) {
                file_put_contents('cron.log', "\n".$message."\n", FILE_APPEND);
                // Створити новий запис Ping
                Ping::create([
                    'address_id' => $one_address['id'],
                    'ping' => $latency,
                    'last_activity' => $now_time,
                    'last_status' => $now_time,
                ]);
                $notificationHelper->push_notification($one_address['user_id'], $one_address['name'], $status);
            }

        } else {
            // Створити новий запис Ping, оскільки не знайдено попередніх записів
            Ping::create([
                'address_id' => $one_address['id'],
                'ping' => $latency,
                'last_activity' => $now_time,
                'last_status' => $now_time,
            ]);
            $notificationHelper->push_notification($one_address['user_id'], $one_address['name'], 'В мережі');
        }

        // Виведення повідомлення
        //echo $message . "\n";
    }



    //для url запитів
    $last_ping = false;
    $url_addresses = \App\Models\Address::whereNotNull('url_address')->get();
    foreach ($url_addresses as $url_address) {

        ///////////////////////
        $url_pings = Ping::where('address_id', $url_address['id']);
        $status=false;
        $now_time = time();
        if ($url_pings->count() > 0) {
            $last_ping = $url_pings->latest('last_status')->first();
            $now_date= (int)strtotime("-7 minutes");
            $status_date=(int)$last_ping->last_status;
            if($now_date>$status_date){

                if ($last_ping->ping == 1) {
                    Ping::create([
                        'address_id' => $url_address['id'],
                        'ping' => 0,
                        'last_activity' => $now_time,
                        'last_status' => $now_time,
                    ]);
                    print  $url_address['name'].'  - Застарів.';
                    $notificationHelper->push_notification($url_address['user_id'], $url_address['name'], 'Офлайн');
                }

            }

        }
    }



