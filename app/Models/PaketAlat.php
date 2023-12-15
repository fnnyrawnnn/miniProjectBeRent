<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketAlat extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'image',
        'description'
    ];

    public function category_kendaraan()
    {
        return $this->belongsTo(CatAlat::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
