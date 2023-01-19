<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerkembanganProyek extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'perkembangan_proyek';

    public function getRouteKeyName()
    {
        return 'kode_perkembangan_proyek';
    }

    public static function boot()
    {
        parent::boot();
        static::creating(
            function ($model) {
                $model->kode_perkembangan_proyek = 'KPR-' . rand(100000, 999999);
            }
        );
    }

    // belongsTo
    public function getProyek()
    {
        return $this->belongsTo(Proyek::class, 'kode_proyek', 'kode_proyek');
    }
    public function getPegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
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
