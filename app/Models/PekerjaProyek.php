<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PekerjaProyek extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pekerja_proyek';

    public function getRouteKeyName()
    {
        return 'kode_pekerja_proyek';
    }

    public static function boot()
    {
        parent::boot();
        static::creating(
            function ($model) {
                $model->kode_pekerja_proyek = 'KPK-' . rand(100000, 999999);
            }
        );
    }
    //  BelongsTo
    public function getPegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }
    public function getProyek()
    {
        return $this->belongsTo(Proyek::class, 'kode_proyek', 'kode_proyek');
    }

    // public static function createValidate($request)
    // {
    //     return $request->validate([
    //         'kode_proyek' => 'required',
    //         'nip' => 'required',
    //     ]);
    // }
    // public static function createNew($validatedData, $request)
    // {
    //     // Mendapatkan file gambar yang diupload
    //     $validatedData['gambar'] = $request->file('gambar');

    //     // Menyimpan file ke direktori public/gambar
    //     $fileName = uniqid() . '.' . $validatedData['gambar']->getClientOriginalExtension();
    //     $validatedData['gambar']->move(public_path('gambar'), $fileName);
    //     $validatedData['gambar'] = $fileName;
    //     self::create($validatedData);
    // }


    // public static function updateValidate($request)
    // {

    //     return $request->validate([
    //         'kode_proyek' => 'required',
    //         Rule::unique('nip')
    //             ->where(function ($query) {
    //                 return $query->where('kode_proyek', request('kode_proyek'));
    //             }),
    //     ]);
    // }

    // public static function updateData($mobil, $validatedData, $request)
    // {
    //     // simpan gambar
    //     if ($request->file('gambar')) {
    //         // menghapus gambar sebelumnya
    //         if ($mobil->gambar) {
    //             File::delete(public_path('gambar/' . $mobil->gambar));
    //         }
    //         // memindahkan gambar ke public/gambar
    //         $validatedData['gambar'] = $request->file('gambar');

    //         // membuat filename random
    //         $fileName = uniqid() . '.' . $validatedData['gambar']->getClientOriginalExtension();
    //         $validatedData['gambar']->move(public_path('gambar'), $fileName);
    //         $validatedData['gambar'] = $fileName;
    //     }
    //     // validasi nopol jika berbeda dengan database
    //     if ($request->nopol != $mobil->nopol) {
    //         $validatedData = $request->validate(['nopol' => 'required|unique:mobil,nopol']);
    //         $nopol = $validatedData['nopol'];
    //     }
    //     //validasi nopol jika berbeda dengan database
    //     $validatedData['nopol'] = $request->nopol != $mobil->nopol ? $nopol : $request->nopol;
    //     $mobil->update($validatedData);
    // }
}
