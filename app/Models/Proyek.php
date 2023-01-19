<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'proyek';

    public function getRouteKeyName()
    {
        return 'kode_proyek';
    }

    public static function boot()
    {
        parent::boot();
        static::creating(
            function ($model) {
                $model->kode_proyek = 'KP-' . rand(100000, 999999);
            }
        );
    }

    // belongs to
    public function getPegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }


    // hasMany
    public function havePekerjaProyek()
    {
        return $this->hasMany(PekerjaProyek::class, 'kode_proyek', 'kode_proyek');
    }
    public function havePerkembanganProyek()
    {
        return $this->hasMany(PerkembanganProyek::class, 'kode_proyek', 'kode_proyek');
    }
    public function havePengadaanBarang()
    {
        return $this->hasMany(PengadaanBarang::class, 'kode_proyek', 'kode_proyek');
    }
    public function haveBidang()
    {
        return $this->hasMany(Bidang::class, 'kode_proyek', 'kode_proyek');
    }

    // Validasi
    public function validateRental($request)
    {
        $rules = [
            'nik' => 'required',
            'nopol' => 'required',
            'tanggal_rental' => 'required|date|before:tanggal_kembali',
            'tanggal_kembali' => 'required|date|after:tanggal_rental',
        ];

        $request->validate($rules);
    }
}
