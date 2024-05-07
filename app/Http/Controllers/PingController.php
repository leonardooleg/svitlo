<?php

namespace App\Http\Controllers;

use App\Models\Ping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PingController extends Controller
{
    public function pingStats()
    {
        // Get current month data
        $currentMonthStart = date('Y-m-01');
        $currentMonthEnd = date('Y-m-d', strtotime(' +1 day'));

        $pingCountCurrent = Ping::where('ping', 0)
            ->where('last_activity', '>=', strtotime($currentMonthStart)) // Convert to timestamp
            ->where('last_activity', '<', strtotime($currentMonthEnd)) // Convert to timestamp
            ->count();

        $totalPingsCurrent = Ping::count();

        // Get previous month data (with error handling)
        $previousMonthStart = date('Y-m-01', strtotime('-1 month'));
        $previousMonthEnd = date('Y-m-d', strtotime('last day of previous month'));

        $pingCountPrevious = Ping::where('ping', 0)
            ->where('last_activity', '>=', strtotime($previousMonthStart)) // Convert to timestamp
            ->where('last_activity', '<', strtotime($previousMonthEnd)) // Convert to timestamp
            ->count();

        $totalPingsPrevious = Ping::where('last_activity', '>=', strtotime($previousMonthStart)) // Convert to timestamp
        ->where('last_activity', '<', strtotime($previousMonthEnd)) // Convert to timestamp
        ->count();

        // Calculate percentage difference and trend
        if (!$totalPingsPrevious) {
            $percentageDifference = 0;
            $trend = 'no-data'; // Indicate no data for previous month
        } else {
            $percentageCurrent = ($pingCountCurrent / $totalPingsCurrent) * 100;
            $percentagePrevious = ($pingCountPrevious / (float) $totalPingsPrevious) * 100; // Ensure float division
            $percentageDifference = $percentageCurrent - $percentagePrevious;
            $trend = ($percentageDifference > 0) ? 'plus' : 'minus';
        }
        if ($totalPingsPrevious && $percentageDifference > 0) {
            $numberString = strval($percentageDifference);
            $parts = explode('.', $numberString);
            if(count($parts) > 2) {
                $firstDigitAfterDecimal = $parts[1][0];
                $percentageDifference = $parts[0] . '.' . $firstDigitAfterDecimal;
            }
        }
        // Prepare data array (with only 3 values)
        $data = [
            'pingCountCurrent' => $pingCountCurrent,
            'percentageDifference' => $percentageDifference,
            'trend' => $trend,
        ];

        // Return the data
        return $data;
    }

}
