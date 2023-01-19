<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'rental';

    public function getRouteKeyName()
    {
        return 'kode_rental';
    }

    public static function boot()
    {
        parent::boot();
        static::creating(
            function ($model) {
                $model->kode_rental = 'KR-' . rand(100000, 999999);
            }
        );
    }

    // belongs to
    public function getMobil()
    {
        return $this->belongsTo(Mobil::class, 'nopol', 'nopol');
    }
    public function getCustomer()
    {
        return $this->belongsTo(Customer::class, 'nik', 'nik');
    }

    // hasMany
    public function haveDenda()
    {
        return $this->hasMany(Denda::class, 'kode_rental', 'kode_rental');
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
