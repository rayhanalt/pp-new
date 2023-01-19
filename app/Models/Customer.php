<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'customer';
    public function getRouteKeyName()
    {
        return 'nik';
    }

    // hasMany
    public function haveRental()
    {
        return $this->hasMany(Rental::class, 'nik', 'nik');
    }
}
