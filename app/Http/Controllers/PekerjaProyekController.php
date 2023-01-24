<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PekerjaProyek;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        return view('pekerjaProyek.create', [
            'getPegawai' => Pegawai::get(),
            'getProyek' => Proyek::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PekerjaProyek $pekerjaProyek)
    {
        $pekerjaProyek->createValidate($request);
        $pekerjaProyek->create($request->all());

        return redirect('/pekerjaProyek')->with('success', 'New Data has been added!')->withInput();
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

        $pekerjaProyek->updateValidate($request);
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
        $pekerjaProyek->delete();

        return redirect()->back()->with('success', 'Data has been deleted!');
    }
}
