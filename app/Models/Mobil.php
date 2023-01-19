<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Mobil extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'mobil';

    public function getRouteKeyName()
    {
        return 'kode_mobil';
    }

    public static function boot()
    {
        parent::boot();
        static::creating(
            function ($model) {
                $model->kode_mobil = 'KM-' . rand(100000, 999999);
            }
        );
    }
    //  hasMany
    public function haveRental()
    {
        return $this->hasMany(Rental::class, 'nopol', 'nopol');
    }

    public static function createValidate($request)
    {
        return $request->validate([
            'nopol' => 'required|unique:mobil,nopol',
            'merk' => 'required',
            'model' => 'required',
            'tahun' => 'required',
            'warna' => 'required',
            'harga_sewa' => 'required',
            'gambar' => 'required|image|file|max:2048',
        ]);
    }
    public static function createNew($validatedData, $request)
    {
        // Mendapatkan file gambar yang diupload
        $validatedData['gambar'] = $request->file('gambar');

        // Menyimpan file ke direktori public/gambar
        $fileName = uniqid() . '.' . $validatedData['gambar']->getClientOriginalExtension();
        $validatedData['gambar']->move(public_path('gambar'), $fileName);
        $validatedData['gambar'] = $fileName;
        self::create($validatedData);
    }

    public static function updateValidate($request)
    {
        return $request->validate([
            'merk' => 'required',
            'model' => 'required',
            'tahun' => 'required',
            'warna' => 'required',
            'harga_sewa' => 'required',
            'gambar' => 'image|file|max:2048',
        ]);
    }

    public static function updateData($mobil, $validatedData, $request)
    {
        // simpan gambar
        if ($request->file('gambar')) {
            // menghapus gambar sebelumnya
            if ($mobil->gambar) {
                File::delete(public_path('gambar/' . $mobil->gambar));
            }
            // memindahkan gambar ke public/gambar
            $validatedData['gambar'] = $request->file('gambar');

            // membuat filename random
            $fileName = uniqid() . '.' . $validatedData['gambar']->getClientOriginalExtension();
            $validatedData['gambar']->move(public_path('gambar'), $fileName);
            $validatedData['gambar'] = $fileName;
        }
        // validasi nopol jika berbeda dengan database
        if ($request->nopol != $mobil->nopol) {
            $validatedData = $request->validate(['nopol' => 'required|unique:mobil,nopol']);
            $nopol = $validatedData['nopol'];
        }
        //validasi nopol jika berbeda dengan database
        $validatedData['nopol'] = $request->nopol != $mobil->nopol ? $nopol : $request->nopol;
        $mobil->update($validatedData);
    }
}
