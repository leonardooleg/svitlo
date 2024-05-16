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
];

        foreach ($seedData as $seed) {
            DB::table('pings')->insert($seed);
        }

    }
}
