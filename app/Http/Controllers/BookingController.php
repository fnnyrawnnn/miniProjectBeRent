<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\CategoryAlat;
use App\Models\DetailBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function bookingPage($id)
    {
        $paket['pakets'] = CategoryAlat::with(['pakets'])
            ->findOrFail($id);

        $user = Auth::user();

        return view('user/pemesananpage', ['pakets' => $paket, 'user' => $user, 'id_pakets' => $id]);
    }

    public function booking(Request $request)
    {
        $request->validate([
            'paket_id' => 'required',
            'user_id' => 'required',
            'tipe' => 'required',
            'waktu_booking' => 'required',
            'lama_meminjam' => 'required',
            'qty' => 'required',
            'catatan_tambahan' => 'max:250',

        ]);

        if (!$this->checkActiveBookings($request->user_id)) {
            return redirect()->back()->withErrors('You have reached the maximum number of active bookings.');
        }

        if ($request->lama_meminjam > 5){
            return redirect()->back()->withErrors('You have reached the maximum number of active bookings.');
        }

        $user_id = Auth::id();

        $status = BookingStatus::Pending;

        $booking = Booking::create([
            'paket_id' => $request->paket_id,
            'user_id' => $user_id,
            'tipe' => $request->tipe,
            'waktu_booking' => $request->waktu_booking,
            'lama_meminjam' => $request->lama_meminjam,
            'catatan_tambahan' => $request->catatan_tambahan,
            'status' => $status
        ]);

        foreach ($request->layanan_id as $layanan_id) {
            DetailBooking::create([
                'layanan_id' => $layanan_id,
                'booking_id' => $booking->id,
                'qty' => $request->qty
            ]);
        }
        return redirect('/profileuser')->with('success', 'Booking Berhasil Dibuat!');
    }

    public function checkActiveBookings($userId)
{
    $activeBookings = Booking::where('user_id', $userId)
                                ->where('status', 'dipinjam')
                                ->count();

    if ($activeBookings >= 2) {
        return false;
    }

    return true;
}
}
