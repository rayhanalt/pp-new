<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'bidang';

    public function getRouteKeyName()
    {
        return 'kode_bidang';
    }

    public static function boot()
    {
        parent::boot();
        static::creating(
            function ($model) {
                $model->kode_bidang = 'KB-' . rand(100000, 999999);
            }
        );
    }
    //  BelongsTo
    public function getPegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }
}
