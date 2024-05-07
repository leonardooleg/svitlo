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
                'email' => 'ivan.petrenko@example.com',
                'password' => bcrypt('password123'),
                'city' => 'Київ',
                'country' => 'Україна'
            ],
            [
                'name' => 'Анна Сидоренко',
                'email' => 'anna.sidorenko@example.com',
                'password' => bcrypt('password456'),
                'city' => 'Львів',
                'country' => 'Україна'
            ],
            [
                'name' => 'Олександр Шевченко',
                'email' => 'oleksandr.shevchenko@example.com',
                'password' => bcrypt('password789'),
                'city' => 'Одеса',
                'country' => 'Україна'
            ],
            [
                'name' => 'Jean Dupont',
                'email' => 'jean.dupont@example.com',
                'password' => bcrypt('password000'),
                'city' => 'Paris',
                'country' => 'Франція'
            ],
            [
                'name' => 'Marie Dubois',
                'email' => 'marie.dubois@example.com',
                'password' => bcrypt('password111'),
                'city' => 'Marseille',
                'country' => 'Франція'
            ],
            [
                'name' => 'Pierre Martin',
                'email' => 'pierre.martin@example.com',
                'password' => bcrypt('password222'),
                'city' => 'Lyon',
                'country' => 'Франція'
            ],
            // Add more users with different cities in Ukraine and France
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }

    }
}
