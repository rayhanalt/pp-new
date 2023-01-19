<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Mobil;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rental.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rental.create', [
            'getMobil' => Mobil::get(),
            'getCustomer' => Customer::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRentalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Rental $rental)
    {
        $rental->validateRental($request);

        // mendapatkan durasi hari
        $tanggal_rental = Carbon::parse($request->tanggal_rental);
        $tanggal_kembali = Carbon::parse($request->tanggal_kembali);
        $days = $tanggal_rental->diffInDays($tanggal_kembali);

        // mendapatkan harga sewa mobil
        $getHarga = Mobil::where('nopol', $request->nopol)->first();
        $harga = $getHarga->harga_sewa;

        // menghitung total harga
        $total_harga = $days * $harga;

        $rental = new Rental();
        $rental->kode_rental = $request->kode_rental;
        $rental->nik = $request->nik;
        $rental->nopol = $request->nopol;
        $rental->tanggal_rental = $request->tanggal_rental;
        $rental->tanggal_kembali = $request->tanggal_kembali;
        $rental->durasi = $days;
        $rental->total_harga = $total_harga;
        $rental->save();

        return redirect('/rental')->with('success', 'New Data has been added!')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function show(Rental $rental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function edit(Rental $rental)
    {
        return view('rental.edit', [
            'item' => $rental,
            'rental' => Rental::get(),
            'getCustomer' => Customer::get(),
            'getMobil' => Mobil::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRentalRequest  $request
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rental $rental)
    {
        $rental->validateRental($request);

        // mendapatkan durasi hari
        $tanggal_rental = Carbon::parse($request->tanggal_rental);
        $tanggal_kembali = Carbon::parse($request->tanggal_kembali);
        $days = $tanggal_rental->diffInDays($tanggal_kembali);

        // mendapatkan harga sewa mobil
        $getHarga = Mobil::where('nopol', $request->nopol)->first();
        $harga = $getHarga->harga_sewa;

        // menghitung total harga
        $total_harga = $days * $harga;

        $rental->nik = $request->nik;
        $rental->nopol = $request->nopol;
        $rental->tanggal_rental = $request->tanggal_rental;
        $rental->tanggal_kembali = $request->tanggal_kembali;
        $rental->durasi = $days;
        $rental->total_harga = $total_harga;
        $rental->update();

        return redirect('/rental')->with('success', 'Data has been updated!')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rental $rental)
    {
        $rental->delete();

        return redirect()->back()->with('success', 'Data has been deleted!');
    }
}
