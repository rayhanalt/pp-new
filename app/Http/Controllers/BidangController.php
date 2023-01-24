<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidangController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->jabatan != 'staff') {
            return view('bidang.index');
        } elseif (Auth::user()->jabatan == 'staff') {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses ke halaman Bidang.');
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
            return view('bidang.create');
        } elseif (Auth::user()->jabatan == 'staff') {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses ke halaman Bidang.');
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
        if (Auth::user()->jabatan != 'staff') {
            $validasi = $request->validate([
                'nama_bidang' => 'required',
            ]);
            Bidang::create($validasi);

            return redirect('/bidang')->with('success', 'New Data has been added!')->withInput();
        } elseif (Auth::user()->jabatan == 'staff') {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses ke halaman Bidang.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bidang  $bidang
     * @return \Illuminate\Http\Response
     */
    public function show(Bidang $bidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bidang  $bidang
     * @return \Illuminate\Http\Response
     */
    public function edit(Bidang $bidang)
    {
        if (Auth::user()->jabatan != 'staff') {
            return view('bidang.edit', [
                'item' => $bidang
            ]);
        } elseif (Auth::user()->jabatan == 'staff') {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses ke halaman Bidang.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bidang  $bidang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bidang $bidang)
    {
        if (Auth::user()->jabatan != 'staff') {
            $rules = [
                'nama_bidang' => 'required'
            ];
            $validasi = $request->validate($rules);

            $bidang->update($validasi);
            return redirect('/bidang')->with('success', 'Data has been updated!')->withInput();
        } elseif (Auth::user()->jabatan == 'staff') {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses ke halaman Bidang.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bidang  $bidang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bidang $bidang)
    {
        if (Auth::user()->jabatan != 'staff') {
            $pegawai = Pegawai::where('kode_bidang', $bidang->kode_bidang);
            if ($pegawai->count() > 0) {
                return redirect()->back()->with('failed', '(' . $bidang->nama_bidang . ') masih digunakan dalam data Pegawai.');
            } else {
                $bidang->delete();
                return redirect()->back()->with('success', 'Data has been deleted!');
            }
        } elseif (Auth::user()->jabatan == 'staff') {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses ke halaman Bidang.');
        }
    }
}
