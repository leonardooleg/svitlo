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
        ]);
        Address::create([
            'user_id' => 1,
            'name' => 'Квартира',
            'ip_address' => '192.168.1.1',
            'public' => '1',
            'link' => 'jhsdAHDI9hasuh',
        ]);

        Ping::create([
            'address_id' => 1,
            'ping' => 10,
            'last_activity' => 1712832814,
        ]);
    }
}
