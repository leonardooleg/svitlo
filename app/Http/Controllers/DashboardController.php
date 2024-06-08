<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Ping;
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($user_url)
    {
        //ad first user id address
        $user = User::where('user_url', $user_url)->first();
        if($user){
            $public_address = (int)$user->public_address;
            if (isset($public_address) && $public_address ==1 || auth()->check() && auth()->user()->id == $user->id){
                $address = Address::where('user_id', $user->id)->first();
                if($address){
                    return redirect('/dashboard/'.$user->user_url.'/'.$address['id'],301);
                }
            }

        }
        return redirect('/',301);
    }

    public function dashboard_all($id_data_address = false, $data_select = null)
    {
        $all_addresses = Address::all();
        foreach ($all_addresses as $address){
            $all_stats[] = $this->show_other(false, $address['id'], $data_select, true);

        }

        // Приймає масив даних як параметр
        function countZeroAndOnePings($data) {
            // Ініціалізувати змінні для підрахунку
            $zeroMinutes = 0;
            $oneMinutes = 0;

            // Перебрати масив даних
            foreach ($data as $user) {
                foreach ($user['lists'] as $timeRange => $listEntry) {
                    $count = $listEntry[0];
                    $duration = $listEntry[1];

                    // Додати час до відповідного лічильника
                    if ($count === 0) {
                        $zeroMinutes += parseDurationToMinutes($duration);
                    } else {
                        $oneMinutes += parseDurationToMinutes($duration);
                    }
                }
                // Форматування часу в годинах і хвилинах
                $zeroHours = floor($zeroMinutes / 60);
                $zeroMinutes = $zeroMinutes % 60;
                $zeroFormattedTime = sprintf("%d.%02d", $zeroHours, $zeroMinutes);

                $oneHours = floor($oneMinutes / 60);
                $oneMinutes = $oneMinutes % 60;
                $oneFormattedTime = sprintf("%d.%02d", $oneHours, $oneMinutes);

                // Зберігати результати
                $all_times[$user["name"]] = [
                    "offline" => $zeroFormattedTime,
                    "online" => $oneFormattedTime
                ];

                // Скинути лічильники
                $zeroMinutes = 0;
                $oneMinutes = 0;
            }

            // Повернути результати
            return $all_times;
        }

// Конвертує тривалість в годинах і хвилинах до хвилин
        function parseDurationToMinutes($duration) {
            $parts = explode(' годин(-и) ', $duration);
            if (count($parts) >= 2) {
                $hours = (int) $parts[0];
                $minutes = (int) trim($parts[1]);
            }else{
                $hours = 0;
                $minutes = (int) trim($parts[0]);
            }

            return $hours * 60 + $minutes;
        }

// Приклад використання


            $all_times =countZeroAndOnePings($all_stats);



        return view('dashboard_all', ['all_stats'=> $all_stats,'all_times'=> $all_times]);

    }

    public function dashboard()
    {
        //ad first user id address

        if(auth()->check()){
            $public_address = (int)auth()->user()->public_address;
            if (isset($public_address) && $public_address ==1 || auth()->check() && auth()->user()->id == auth()->user()->id){
                $address = Address::where('user_id', auth()->user()->id)->first();
                if($address){
                    return redirect('/dashboard/'.auth()->user()->user_url.'/'.$address['id'],301);
                }
            }

        }
        return redirect('/',301);
    }

    /**
     * Display a listing of the resource.
     */
    public function link_address(string $link_address, string $date_select = null)
    {

        if ($link_address){
            if (strlen($link_address)==13){
                $address = Address::where('link', $link_address)->first();
                if ($address){
                    return $this->show(false, $address['id'], $date_select, true);
                }
            }
        }

        return redirect('/',301);
    }

    public function user_demo()
    {

        return $this->show(false,false,null,false, true);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show_other(string $user_url, int $address_id, string $date_select = null, bool $link = false, bool $demo = false)
    {
        $addresses=[];
        if ($link) {
            $address = Address::where('id', $address_id)->first();
            if ($address == null) {
                return redirect('/', 301);
            }
        }else{
            if ($user_url){
                $user = User::where('user_url', $user_url)->first();
            }else{
                $user = auth()->user();
            }
            if($demo) {
                $address_id = 0;
                $address['name'] = 'Demo';
            }
            if($user) {
                $public_address = (int)$user->public_address;
                if (isset($public_address) && $public_address ==1 || auth()->check() && auth()->user()->id == $user->id){
                    if(!$demo) {
                        $address = false;
                        $address = Address::where('user_id', $user->id)->where('id', $address_id)->first();
                    }
                    if (!$user_url){
                        $user_url = $user->user_url;
                    }
                    $addresses = Address::where('user_id', $user->id)->get();
                }else{
                    return redirect('/', 301);
                }
            }

        }

        //якщо є конкретна дата запросу
        $get_date = false;
        $get_date_true = true;
        $get_date_now = date("d.m.Y");

        if ($date_select != null) {
            $dateObject = DateTime::createFromFormat('d.m.Y', $date_select);
            if ($dateObject && $dateObject <= new DateTime()) {
                if ($date_select == $get_date_now) {
                    $get_date = false;
                } else {
                    $get_date_now = $date_select;
                    $get_date = true;
                }
            } else {
                $get_date_true = false;
            }

        }


        if($demo) {
            $futureTime = $this->futureTime();


            $pings[]=['id' => 0, 'address_id' => 0, 'ping' => 1, 'last_activity' => $futureTime[0]];
            $pings[]=['id' => 1, 'address_id' => 0, 'ping' => 0, 'last_activity' => $futureTime[1]];
            $pings[]=['id' => 2, 'address_id' => 0, 'ping' => 1, 'last_activity' => $futureTime[2]];
            $pings[]=['id' => 3, 'address_id' => 0, 'ping' => 0, 'last_activity' => $futureTime[3]];
        }else{
            $pings = Ping::where('address_id', '=', $address_id)
                ->whereBetween('last_activity', [strtotime($get_date_now . ' 00:00:00'), strtotime($get_date_now . ' 23:59:59')])
                ->get()->toArray();
        }



        $t = 0;

        //отримуємо останній Вчорашній статус
        $ping_yesterday = false;
        if ($get_date) {
            $date_old_night = strtotime($get_date_now . ' 00:00:00');
        } else if (!$get_date && $get_date_true) {
            $date_old_night = strtotime(date("Y-m-d") . ' 00:00:00');
        }


        $dateOldNight = strtotime('2022-01-30 14:15:55'); // Adjust time zone if needed

        $ping_yesterday = Ping::where('address_id', '=', $address_id)
            ->whereBetween('last_activity', [$dateOldNight, $date_old_night])
            ->orderBy('id', 'desc')
            ->first();


        if ($ping_yesterday) {
            if ($ping_yesterday->ping == 1) {
                $ping_yesterday_status = (int)$ping_yesterday["ping"];
            } else {
                $ping_yesterday_status = (int)0;
            }
        } else {
            $ping_yesterday_status = (int)0;
        }
        if ($get_date) {
            array_unshift($pings, ['id' => 0, 'address_id' => $address_id, 'ping' => (int)$ping_yesterday_status, 'last_activity' => strtotime($get_date_now . ' 00:00:00')]);
        } else if (!$get_date && $get_date_true) {
            array_unshift($pings, ['id' => 0, 'address_id' => $address_id, 'ping' => (int)$ping_yesterday_status, 'last_activity' => strtotime(date("Y-m-d") . ' 00:00')]);
        }
        if (isset($pings)) {

            $count_pings = count($pings) - 1;

            $lists = [];
            foreach ($pings as $ping) {
                $next = $t + 1;
                $old = date('H:i', $ping['last_activity']);
                if ($count_pings >= $next) {
                    $now = date('H:i', $pings[$next]['last_activity']);
                } else {
                    if ($get_date) {
                        $now = '23:59';
                    } else if (!$get_date && $get_date_true) {
                        $now = date("H:i");
                    }
                }
                //фільтр для вивода в список, для коректності
                if ($count_pings >= $t) {
                    $timeDifference = $this->calculateTimeDifference($old, $now);

                    $lists[$old . '-' . $now] = [$ping['ping'], $timeDifference];
                }

                $t++;
            }
        }

        //отримати скільки відключень вчора
        // Parse the given date string into a DateTime object
        $givenDate = DateTime::createFromFormat('d.m.Y', $get_date_now);

        // Subtract one day from the given date and get its Unix timestamp
        $previousDayTimestamp = $givenDate->sub(new DateInterval('P1D'))->getTimestamp();
        $previousDay = DateTime::createFromFormat('U', $previousDayTimestamp);

        // Set the start time to 00:00 of the previous day
        $startTime = clone $previousDay;
        $startTime->setTime(0, 0, 0);

        // Set the end time to 23:59:59 of the previous day
        $endTime = clone $previousDay;
        $endTime->setTime(23, 59, 59);
        $start_day = $startTime->getTimestamp();
        $end_day = $endTime->getTimestamp();
        $pings2 = Ping::where('last_activity', '>=', $start_day)
            ->where('last_activity', '<', $end_day)
            ->where('address_id', '=', $address_id)
            ->get();
        // Count the number of pings with a value of 0 in the 'ping' column
        $pingCountZero = $pings2->where('ping', 0)->count() ?? 0;

        $pings3 = Ping::where('address_id', '=', $address_id) ->get();
        // Count the number of pings with a value of 0 in the 'ping' column
        $allPingCountZero = $pings3->where('ping', 0)->count() ?? 0;

        //Віджет по містам
        $users = User::get()->toArray();
        // Створимо масив для зберігання згрупованих даних
        $groupedCities = [];
        // add demo users to users
        $demo_users= [
                [
                'name' => 'Іван Петренко',
                'email' => 'ivan.petrenko@example.com',
                'password' => 'password123',
                'city' => 'Київ',
                'country' => 'Україна'
            ],
                [
                'name' => 'Іван Петренко2',
                'email' => 'ivan.petrenko2@example.com',
                'password' => 'password123',
                'city' => 'Київ',
                'country' => 'Україна'
            ],
            [
                'name' => 'Анна Сидоренко',
                'email' => 'anna.sidorenko@example.com',
                'password' => 'password456',
                'city' => 'Львів',
                'country' => 'Україна'
            ],
            [
                'name' => 'Олександр Шевченко',
                'email' => 'oleksandr.shevchenko@example.com',
                'password' => 'password789',
                'city' => 'Одеса',
                'country' => 'Україна'
            ],
            [
                'name' => 'Jean Dupont',
                'email' => 'jean.dupont@example.com',
                'password' => 'password000',
                'city' => 'Paris',
                'country' => 'Франція'
            ],
            [
                'name' => 'Jean Dupont2',
                'email' => 'jean.dupon2t@example.com',
                'password' => 'password000',
                'city' => 'Одеса',
                'country' => 'Україна'
            ],
            [
                'name' => 'Marie Dubois',
                'email' => 'marie.dubois@example.com',
                'password' => 'password111',
                'city' => 'Харків',
                'country' => 'Україна'
            ],
            [
                'name' => 'Pierre Martin',
                'email' => 'pierre.martin@example.com',
                'password' => 'password222',
                'city' => 'Харків',
                'country' => 'Україна'
            ],
            [
                'name' => 'Pierre Martin2',
                'email' => 'pierre.martin2@example.com',
                'password' => 'password222',
                'city' => 'Харків',
                'country' => 'Україна'
            ],
            [
                'name' => 'Pierre Martin3',
                'email' => 'pierre.martin3@example.com',
                'password' => 'password222',
                'city' => 'Харків',
                'country' => 'Україна'
            ],
        ];
        $users = array_merge($users, $demo_users);

        // Пройдемося по масиві користувачів
        foreach ($users as $user) {
            if ($user["city"] == null) {
                $city = 'Не вказано';
            }else{
                $city = $user['city'];
            }

            $country = $user['country'];

            // Перевіримо, чи вже є таке місто в масиві $groupedCities
            if (!isset($groupedCities[$city])) {
                $groupedCities[$city] = [
                    'count' => 0,
                    'country' => $country,
                    'percentage' => 0
                ];
            }

            // Збільшимо лічильник для міста
            $groupedCities[$city]['count']++;
        }

        // Розрахуємо відсоток для кожного міста
        $totalUsers = count($users);
        foreach ($groupedCities as $city => &$cityData) {
            $cityData['percentage'] = round(($cityData['count'] / $totalUsers) * 100, 2);
        }
        uasort($groupedCities, function ($a, $b) {
            return $b['percentage'] - $a['percentage'];
        });

        //Всі відключення
        $pingController = new PingController();
        $pingStats = $pingController->pingStats();
        $data = [ 'name' => $address['name'], 'user_url' => $user_url, 'address_id' => $address_id, 'pings' => $pings, 'lists' => $lists, 'date_select' => $date_select, 'pingCountZero' => $pingCountZero, 'allPingCountZero' => $allPingCountZero, 'groupedCities' => $groupedCities, 'pingStats' => $pingStats, 'addresses' => $addresses];
        return $data;


    }

    public function show(string $user_url, int $address_id, string $date_select = null, bool $link = false, bool $demo = false)
    {

        $data=$this->show_other($user_url, $address_id, $date_select, $link, $demo);
        return view('dashboard', $data);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function calculateTimeDifference($start, $end) {
        $startTime = strtotime($start);
        $endTime = strtotime($end);

        $differenceInSeconds = $endTime - $startTime;

        $hours = floor($differenceInSeconds / 3600);
        $minutes = floor(($differenceInSeconds % 3600) / 60);

        if ($hours > 0) {
            return "$hours годин(-и) $minutes хвилин(-и)";
        } else {
            return "$minutes хвилин(-и)";
        }
    }
    function futureTime() {
        $currentTime = time(); // Get current timestamp

        // Generate 4 random timestamps within today's timeframe
        $randomTimestamps = [];
        for ($i = 0; $i < 4; $i++) {
            $randomDelta = mt_rand(0, $currentTime - strtotime('today'));
            $randomTimestamp = $currentTime - $randomDelta;
            $randomTimestamps[] = $randomTimestamp;
        }

        // Sort timestamps in ascending order
        sort($randomTimestamps);

        // Convert timestamps to Unix timestamps
        $unixTimestamps = [];
        foreach ($randomTimestamps as $timestamp) {
            $unixTimestamps[] = $timestamp;
        }

        return $unixTimestamps;
    }

}
