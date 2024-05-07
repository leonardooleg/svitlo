<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


$seedData = [
    [
        "address_id" => 1,
        "last_activity" => 1713479092,
        "ping" => 0
    ],
    [
        "address_id" => 2,
        "last_activity" => 1713479093,
        "ping" => 1
    ],
    [
        "address_id" => 1,
        "last_activity" => 1713479094,
        "ping" => 0
    ],
    [
        "address_id" => 2,
        "last_activity" => 1713479095,
        "ping" => 1
    ],
    [
        "address_id" => 1,
        "last_activity" => 1713479096,
        "ping" => 0
    ],
    [
        "address_id" => 2,
        "last_activity" => 1713479097,
        "ping" => 1
    ],
    [
        "address_id" => 7,
        "last_activity" => 1713479098,
        "ping" => 0
    ],
    [
        "address_id" => 8,
        "last_activity" => 1713479099,
        "ping" => 1
    ],
    [
        "address_id" => 9,
        "last_activity" => 1713479100,
        "ping" => 0
    ],
    [
        "address_id" => 10,
        "last_activity" => 1713479101,
        "ping" => 1
    ]
];

        foreach ($seedData as $seed) {
            DB::table('pings')->insert($seed);
        }

    }
}
