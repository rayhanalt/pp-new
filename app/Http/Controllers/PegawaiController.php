<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Pegawai;
use App\Models\Proyek;
use Illuminate\Foundation\Auth\User as AuthUser;
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
            return view('pegawai.create', [
                'getBidang' => Bidang::get(),
            ]);
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
                'kode_bidang' => 'required'
            ]);

            pegawai::create($validasiPegawai);

            DB::table('users')->insert([
                'nip' => $validasiPegawai['nip'],
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
        if (Auth::user()->jabatan != 'staff' && Auth::user()->nip != $pegawai->nip) {
            return view('pegawai.edit', [
                'item' => $pegawai,
                'pegawai' => Pegawai::get(),
                'getBidang' => Bidang::get(),
            ]);
        } elseif (Auth::user()->jabatan != 'staff' && Auth::user()->nip == $pegawai->nip) {
            return view('pegawai.edit', [
                'item' => $pegawai,
                'pegawai' => Pegawai::get(),
                'getBidang' => Bidang::get(),
            ]);
        } elseif (Auth::user()->jabatan == 'staff' && Auth::user()->nip == $pegawai->nip) {
            return view('pegawai.edit', [
                'item' => $pegawai,
                'pegawai' => Pegawai::get(),
                'getBidang' => Bidang::get(),
            ]);
        } elseif (Auth::user()->jabatan == 'staff' && Auth::user()->nip != $pegawai->nip) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk halaman Edit Pegawai Lain.');
        }
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
            'kode_bidang' => 'required'
        ];

        if ($request->nip != $pegawai->nip) {
            $rules['nip'] = 'required|numeric|unique:pegawai,nip';
            Proyek::where('nip', $pegawai->nip)->update(['nip' => $request->nip]);
        }

        if (Auth::user()->nip == $pegawai->nip) {

            if ($request->password != null) {

                DB::table('users')->where('nip', '=', $pegawai->nip)->update([
                    'password' => bcrypt($request->password),
                ]);

                $validasi = $request->validate($rules);

                DB::table('users')->where('nip', '=', $pegawai->nip)->update([
                    'nip' => $request->nip,
                ]);

                $pegawai->update($validasi);

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/loginpage');
            }

            if ($request->password == null) {

                $validasi = $request->validate($rules);

                DB::table('users')->where('nip', '=', $pegawai->nip)->update([
                    'nip' => $request->nip,
                ]);

                $pegawai->update($validasi);

                return redirect('/')->with('success', 'Data has been updated!')->withInput();
            }
        }

        if (Auth::user()->nip != $pegawai->nip) {
            if ($request->password != null) {

                DB::table('users')->where('nip', '=', $pegawai->nip)->update([
                    'password' => bcrypt($request->password),
                ]);

                $validasi = $request->validate($rules);

                DB::table('users')->where('nip', '=', $pegawai->nip)->update([
                    'nip' => $request->nip,
                    'jabatan' => $request->jabatan
                ]);

                $pegawai->update($validasi);
            }

            if ($request->password == null) {

                $validasi = $request->validate($rules);

                DB::table('users')->where('nip', '=', $pegawai->nip)->update([
                    'nip' => $request->nip,
                    'jabatan' => $request->jabatan
                ]);

                $pegawai->update($validasi);
            }

            return redirect('/pegawai')->with('success', 'Data has been updated!')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $proyek = Proyek::where('nip', $pegawai->nip);
        if ($proyek->count() > 0) {
            return redirect()->back()->with('failed', '(' . $pegawai->nama . ') masih penanggung jawab dalam salah satu proyek');
        } else {
            AuthUser::where('nip', $pegawai->nip)->delete();
            $pegawai->delete();
            return redirect()->back()->with('success', 'Data has been deleted!');
        }
    }
}
