<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;


class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'pegawai' => Pegawai::count(),
            // 'customer' => Customer::count(),
            // 'rental' => Rental::count(),
        ]);
    }
}
