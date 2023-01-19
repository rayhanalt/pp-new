<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Denda;
use App\Models\Mobil;
use App\Models\Rental;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('denda.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('denda.create', [
            'getRental' => Rental::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Denda $denda)
    {
        $denda->validateDenda($request);

        // mendapatkan durasi hari
        $ambilRental = Rental::where('kode_rental', $request->kode_rental)->first();
        $tanggal_kembali = $ambilRental->tanggal_kembali;
        $kembaliParse = Carbon::parse($tanggal_kembali);
        $tanggal_denda = Carbon::parse($request->tanggal_denda);
        $days = $kembaliParse->diffInDays($tanggal_denda);

        // mendapatkan harga sewa mobil

        $harga = $ambilRental->getMobil->harga_sewa;

        // menghitung total harga
        $jumlah_denda = $days * $harga;

        $denda = new Denda();
        $denda->kode_rental = $request->kode_rental;
        $denda->tanggal_denda = $request->tanggal_denda;
        $denda->jumlah_denda = $jumlah_denda;
        $denda->save();

        return redirect('/denda')->with('success', 'New Data has been added!')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Denda $denda
     * @return \Illuminate\Http\Response
     */
    public function show(Denda $denda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Denda $denda
     * @return \Illuminate\Http\Response
     */
    public function edit(Denda $denda)
    {
        return view('denda.edit', [
            'item' => $denda,
            'getRental' => Rental::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Denda $denda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Denda $denda)
    {
        $denda->validateDenda($request);

        // mendapatkan durasi hari
        $ambilRental = Rental::where('kode_rental', $request->kode_rental)->first();
        $tanggal_kembali = $ambilRental->tanggal_kembali;
        $kembaliParse = Carbon::parse($tanggal_kembali);
        $tanggal_denda = Carbon::parse($request->tanggal_denda);
        $days = $kembaliParse->diffInDays($tanggal_denda);

        // mendapatkan harga sewa mobil

        $harga = $ambilRental->getMobil->harga_sewa;

        // menghitung total harga
        $jumlah_denda = $days * $harga;


        $denda->kode_rental = $request->kode_rental;
        $denda->tanggal_denda = $request->tanggal_denda;
        $denda->jumlah_denda = $jumlah_denda;
        $denda->update();

        return redirect('/denda')->with('success', 'Data has been updated!')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Denda $denda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Denda $denda)
    {
        $denda->delete();
        return redirect()->back()->with('success', 'Data has been deleted!');
    }

    public function getData($kode_rental)
    {
        $data = Rental::where('kode_rental', $kode_rental)->first();
        return response()->json($data);
    }
}
