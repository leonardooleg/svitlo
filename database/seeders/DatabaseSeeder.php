<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Ping;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'LeonardoOleg',
            'email' => 'leonardooleg2@gmail.com',
            'theme' => 'dark',
        ]);
        Address::create([
            'user_id' => 1,
            'name' => 'Квартира',
            'ip_address' => '192.168.1.1',
            'public' => '1',
            'link' => 'jhsdAHDI9hasu',
        ]);
        Address::create([
            'user_id' => 1,
            'name' => 'Оранж',
            'url_address' => '1713478951512',
        ]);

        Ping::create([
            'address_id' => 1,
            'ping' => 1,
            'last_activity' => 1713479092,
        ]);
    }
}
