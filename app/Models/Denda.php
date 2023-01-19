<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'denda';

    public function getRouteKeyName()
    {
        return 'kode_denda';
    }

    public static function boot()
    {
        parent::boot();
        static::creating(
            function ($model) {
                $model->kode_denda = 'KD-' . rand(100000, 999999);
            }
        );
    }

    // belongsTo
    public function getRental()
    {
        return $this->belongsTo(Rental::class, 'kode_rental', 'kode_rental');
    }

    // Validasi
    public function validateDenda($request)
    {
        $rules = [
            'kode_rental' => 'required',
            'tanggal_denda' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $tanggal_rental_terakhir = Rental::where('kode_rental', $request->kode_rental)
                        ->orderBy('tanggal_kembali', 'desc')
                        ->first();
                    if ($tanggal_rental_terakhir && $value <= $tanggal_rental_terakhir->tanggal_kembali) {
                        $fail('Tanggal rental harus setelah tanggal kembali terakhir (' . $tanggal_rental_terakhir->tanggal_kembali . ').');
                    }
                }
            ],
        ];

        $request->validate($rules);
    }
}
