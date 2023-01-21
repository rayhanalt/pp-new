<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pegawai';
    public function getRouteKeyName()
    {
        return 'nip';
    }

    // hasMany
    public function haveProyek()
    {
        return $this->hasMany(Proyek::class, 'nip', 'nip');
    }

    // BelongsTo
    public function getBidang()
    {
        return $this->belongsTo(Bidang::class, 'kode_bidang', 'kode_bidang');
    }
    public function getUser()
    {
        return $this->belongsTo(User::class, 'nip', 'nip');
    }
}
