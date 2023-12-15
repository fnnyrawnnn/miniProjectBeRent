<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBooking extends Model
{
    use HasFactory;
    protected $fillable = [
        'paket_id',
        'booking_id',
        'catatan'
    ];

    public function paket()
    {
        return $this->belongsTo(PaketAlat::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
