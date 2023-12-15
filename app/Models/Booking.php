<?php

namespace App\Models;

use App\Enums\BookingStatus;
use App\Enums\BookingType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'paket_id',
        'user_id',
        'waktu_booking',
        'catatan_tambahan',
        'status',
        'tipe',
        'lama_meminjam',
        'qty'
    ];

    protected $casts = [
        'status' => BookingStatus::class,
        'tipe' => BookingType::class
    ];

    public function detail_layanan_bookings()
    {
        return $this->hasMany(DetailBooking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->belongsTo(PaketAlat::class);
    }
}
