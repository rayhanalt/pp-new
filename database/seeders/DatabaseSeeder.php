<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Mobil;
use App\Models\Rental;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'username' => 'admin',
            'name' => 'Rayhan Althaf',
            'password' => bcrypt('12345'),
        ]);
        Customer::factory(10)->create();
        Mobil::factory(10)->create();
        Rental::factory(10)->create();
    }
}
