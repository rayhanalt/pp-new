<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Models\PekerjaProyek;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PekerjaProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pekerjaProyek.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function customCreate(Proyek $proyek)
    {
        if (Auth::user()->jabatan != 'staff') {
            return view('pekerjaProyek.create', [
                'getPegawai' => Pegawai::get(),
                'getProyek' => $proyek,
            ]);
        } elseif (Auth::user()->jabatan == 'staff') {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses ke halaman Proyek.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_proyek' => 'required',
            'nip' => 'required|unique:pekerja_proyek,nip,NULL,id,kode_proyek,' . $request->kode_proyek . '|unique:proyek,nip,NULL,id,kode_proyek,' . $request->kode_proyek,
        ], [
            'nip.unique' => 'Pegawai sudah terdaftar dalam proyek ini',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        PekerjaProyek::create($request->all());

        return redirect()->to('proyek/' . $request->kode_proyek)->with('success', 'New Data has been added!')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PekerjaProyek  $pekerjaproyek
     * @return \Illuminate\Http\Response
     */
    public function show(PekerjaProyek $pekerjaProyek)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PekerjaProyek  $pekerjaproyek
     * @return \Illuminate\Http\Response
     */
    public function edit(PekerjaProyek $pekerjaProyek)
    {
        return view('pekerjaProyek.edit', [
            'item' => $pekerjaProyek,
            'getPegawai' => Pegawai::get(),
            'getProyek' => Proyek::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PekerjaProyek  $pekerjaproyek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PekerjaProyek $pekerjaProyek)
    {

        $validator = Validator::make($request->all(), [
            'kode_proyek' => 'required',
            'nip' => 'required|unique:pekerja_proyek,nip,NULL,id,kode_proyek,' . $request->kode_proyek . '|unique:proyek,nip,NULL,id,kode_proyek,' . $request->kode_proyek,
        ], [
            'nip.unique' => 'Pegawai sudah terdaftar dalam proyek ini',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pekerjaProyek->update($request->all());

        return redirect('/pekerjaProyek')->with('success', 'Data has been updated!')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PekerjaProyek  $pekerjaproyek
     * @return \Illuminate\Http\Response
     */
    public function destroy(PekerjaProyek $pekerjaProyek)
    {
        if (Auth::user()->jabatan != 'staff') {
            $pekerjaProyek->delete();
            return redirect()->back()->with('success', 'Data has been deleted!');
        } elseif (Auth::user()->jabatan == 'staff') {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses ke halaman Proyek.');
        }
    }
}
