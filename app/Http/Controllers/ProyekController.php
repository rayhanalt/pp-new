<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Models\PekerjaProyek;
use Illuminate\Support\Facades\Auth;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->jabatan != 'staff') {
            return view('proyek.index');
        } elseif (Auth::user()->jabatan == 'staff') {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses ke halaman Proyek.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->jabatan != 'staff') {
            return view('proyek.create', [
                'getPegawai' => Pegawai::get()
            ]);
        } elseif (Auth::user()->jabatan == 'staff') {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses ke halaman Proyek.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProyekRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Proyek $proyek)
    {
        $proyek->validateProyek($request);
        $proyek->create($request->all());

        return redirect('/proyek')->with('success', 'New Data has been added!')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proyek  $proyek
     * @return \Illuminate\Http\Response
     */
    public function show(Proyek $proyek)
    {
        return view('pekerjaProyek.show', [
            'item' => $proyek,
            'data' => PekerjaProyek::where('kode_proyek', $proyek->kode_proyek)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proyek  $proyek
     * @return \Illuminate\Http\Response
     */
    public function edit(Proyek $proyek)
    {
        if (Auth::user()->jabatan != 'staff') {
            return view('proyek.edit', [
                'item' => $proyek,
                'getPegawai' => Pegawai::get(),
            ]);
        } elseif (Auth::user()->jabatan == 'staff') {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses ke halaman Proyek.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProyekRequest  $request
     * @param  \App\Models\Proyek  $proyek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyek $proyek)
    {
        $proyek->validateProyek($request);

        $proyek->update($request->all());

        return redirect('/proyek')->with('success', 'Data has been updated!')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyek $proyek)
    {
        PekerjaProyek::where('kode_proyek', $proyek->kode_proyek)->delete();
        $proyek->delete();

        return redirect()->back()->with('success', 'Data has been deleted!');
    }
}
