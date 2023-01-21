<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bidang;
use App\Models\Pegawai;
use App\Models\User;
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
        Bidang::create([

            "nama_bidang" => 'Front End',
        ]);
        Bidang::create([

            "nama_bidang" => 'Back End',
        ]);
        Bidang::create([

            "nama_bidang" => 'Full Stack',
        ]);
        Bidang::create([

            "nama_bidang" => 'Data Analis',
        ]);
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
            'nama' => 'Rayhan Althaf',
            'kode_bidang' => Bidang::inRandomOrder()->first()->kode_bidang,

        ]);
        Pegawai::create([
            'nip' => '123',
            'nama' => 'Qomar',
            'kode_bidang' => Bidang::inRandomOrder()->first()->kode_bidang,

        ]);
        Pegawai::create([
            'nip' => '1234',
            'nama' => 'Samidi',
            'kode_bidang' => Bidang::inRandomOrder()->first()->kode_bidang,

        ]);
        // Customer::factory(10)->create();
        // Mobil::factory(10)->create();
        // Rental::factory(10)->create();
    }
}
