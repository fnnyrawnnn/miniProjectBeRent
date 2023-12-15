<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\DetailBooking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileUserController extends Controller
{
    public function showuser()
    {
        $datauser = User::get();
        return view('user/profileuser', ['users' => $datauser]);
    }

    public function showdetailuser($id)
    {
        $datauser = User::findOrFail($id);
        return view('user/profileuserdetail', ['users' => $datauser]);
    }

    public function edit($id)
    {
        $data['users'] = User::findOrFail($id);

        return view(
            'user/profileuseredit',
            $data
        );
    }

    public function updatedetailuser(Request $request, $id)
    {
        // mendapatkan data user
        $dataUser = User::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('profile_picture'), $imageName);

            $dataUser->image = $imageName;
        }

        $dataUser->name = $request->name;
        $dataUser->email = $request->email;
        $dataUser->alamat = $request->alamat;
        $dataUser->phone_number = $request->phone_number;
        $dataUser->save();

        return redirect('/profileuser/' . $dataUser->id)->with('success', 'User Berhasil Diubah!');
    }

    public function showtransaksi()
    {
        $user = Auth::user();
        $idUser = $user->id;

        $booking = Booking::with(['user', 'paket'])
            ->where('user_id', $idUser)->orderBy('id', 'desc')->paginate(4);

        $detail_booking = DetailBooking::with(['booking', 'paket'])->get();

        return view('user/profiletransaksi', ['user' => $user, 'transaksi' => $booking, 'detail_booking' => $detail_booking]);
    }
}
