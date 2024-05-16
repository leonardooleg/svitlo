<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            [
                'name' => 'Іван Петренко',
                'email' => 'leonardooleg2@gmail.com',
                'password' => bcrypt('password'),
                'city' => 'Полтава',
                'country' => 'Україна'
            ],
            // Add more users with different cities in Ukraine and France
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }

    }
}
