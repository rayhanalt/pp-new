<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PengadaanBarang;
use App\Models\Proyek;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'pegawai' => Pegawai::count(),
            'proyek' => Proyek::count(),
            'pengadaanBarang' => PengadaanBarang::count(),
        ]);
    }
}
