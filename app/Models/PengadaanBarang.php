<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengadaanBarang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pengadaan_barang';

    public function getRouteKeyName()
    {
        return 'kode_pengadaan_barang';
    }

    public static function boot()
    {
        parent::boot();
        static::creating(
            function ($model) {
                $model->kode_pengadaan_barang = 'KPB-' . rand(100000, 999999);
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
}
