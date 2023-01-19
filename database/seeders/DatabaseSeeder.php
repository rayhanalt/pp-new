<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Mobil;
use App\Models\Pegawai;
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
            'nip' => '12345',
            'jabatan' => 'manajer',
            'password' => bcrypt('12345'),
        ]);
        User::create([
            'nip' => '123',
            'jabatan' => 'admin',
            'password' => bcrypt('12345'),
        ]);
        User::create([
            'nip' => '1234',
            'jabatan' => 'staff',
            'password' => bcrypt('12345'),
        ]);
        Pegawai::create([
            'nip' => '12345',
            'nama' => 'Rayhan Althaf'

        ]);
        Pegawai::create([
            'nip' => '123',
            'nama' => 'Qomar'

        ]);
        Pegawai::create([
            'nip' => '1234',
            'nama' => 'Samidi'

        ]);
        // Customer::factory(10)->create();
        // Mobil::factory(10)->create();
        // Rental::factory(10)->create();
    }
}
