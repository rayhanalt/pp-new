<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{

    // public function __construct()
    // {
    // $this->middleware('admin');
    //     $this->middleware(['manajer', 'admin']);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->jabatan != 'staff') {
            return view('pegawai.index');
        } elseif (Auth::user()->jabatan == 'staff') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk halaman Pegawai.');
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
            return view('pegawai.create');
        } elseif (Auth::user()->jabatan == 'staff') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk halaman Pegawai.');
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
            $validasiPegawai = $request->validate([
                'nip' => 'required|numeric|unique:pegawai,nip',
                'nama' => 'required',
            ]);

            pegawai::create($validasiPegawai);

            DB::table('users')->insert([
                'nip' => $request->nip,
                'password' => bcrypt('12345'),
                'jabatan' => $request->jabatan,
            ]);

            return redirect('/pegawai')->with('success', 'New Data has been added!')->withInput();
        } elseif (Auth::user()->jabatan == 'staff') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk halaman Pegawai.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', [
            'item' => $pegawai,
            'pegawai' => Pegawai::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $rules = [
            'nama' => 'required',
            'jabatan' => 'required'
        ];

        if ($request->nip != $pegawai->nip) {
            $rules['nip'] = 'required|numeric|unique:pegawai,nip';
        }
        if ($request->password != null) {
            $rules['password'] = 'required';
        }
        $validasi = $request->validate($rules);

        // if ($request->password  != null) {
        //     $validasi['password'] = Hash::make($validasi['password']);
        // }

        $pegawai->update($validasi);
        DB::table('users')->where('nip', $pegawai->nip)->update([
            'nip' => $request->nip,
            'password' => bcrypt($request->password)
        ]);

        return redirect('/pegawai')->with('success', 'Data has been updated!')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return redirect()->back()->with('success', 'Data has been deleted!');
    }
}
