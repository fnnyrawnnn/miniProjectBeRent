<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Booking;
use App\Models\CatAlat;
use App\Models\PaketAlat;
use App\Models\DetailBooking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $paketCount = PaketAlat::count();
        $catCount = CatAlat::count();
        $adminCount = Admin::count();

        return view('admin/app', ['user_count' => $userCount, 'paket_count' => $paketCount, 'cat_count' => $catCount, 'admin_count' => $adminCount]);
    }

    public function listuser()
    {
        $userCount = User::count();
        $paketCount = PaketAlat::count();
        $catCount = CatAlat::count();
        $adminCount = Admin::count();
        $data['users'] = User::all();
        return view('admin/listuser', $data, ['user_count' => $userCount, 'paket_count' => $paketCount, 'cat_count' => $catCount, 'admin_count' => $adminCount]);
    }

    public function listadmin()
    {
        $userCount = User::count();
        $paketCount = PaketAlat::count();
        $catCount = CatAlat::count();
        $adminCount = Admin::count();
        $data['admin'] = Admin::all();
        return view('admin/listadmin', $data, ['user_count' => $userCount, 'paket_count' => $paketCount, 'cat_count' => $catCount, 'admin_count' => $adminCount]);
    }

    public function listpaket()
    {
        $userCount = User::count();
        $paketCount = PaketAlat::count();
        $catCount = CatAlat::count();
        $adminCount = Admin::count();
        $data['pakets'] = PaketAlat::all();
        return view('admin/listpaket', $data, ['user_count' => $userCount, 'paket_count' => $paketCount, 'cat_count' => $catCount, 'admin_count' => $adminCount]);
    }

    public function detailpaket($id)
    {
        $userCount = User::count();
        $paketCount = PaketAlat::count();
        $paket = PaketAlat::findOrFail($id);

        $booking = Booking::with(['user', 'paket'])
            ->get();

        $detail_booking = DetailBooking::with(['booking', 'paket'])->get();
        
        return view('admin/detailpaket', ['transaksi' => $booking, 'detail_booking' => $detail_booking, 'paket' => $paket, 'users_count' => $userCount, 'pakets_count' => $paketCount]);
    }

    public function destroyuser($id)
    {
        User::destroy($id);
        return redirect(route('showlistuser'))->with('success', 'User Berhasil Dihapus!');
    }

    public function destroyadmin($id)
    {
        Admin::destroy($id);
        return redirect(route('showlistadmin'))->with('success', 'Admin Berhasil Dihapus!');
    }

    public function destroypaket($id)
    {
        PaketAlat::destroy($id);
        return redirect(route('showlistpaket'))->with('success', 'Paket Berhasil Dihapus!');
    }

    public function adduser()
    {
        return view('admin/adduser');
    }

    public function createuser(Request $request)
    {
        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('profile_picture'), $imageName);

        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->alamat = $request->alamat;
        $users->password = Hash::make($request->password);
        $users->phone_number = $request->phone_number;
        $users->image = $imageName;

        $users->save();

        return redirect()->route('showlistuser')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['users'] = User::findOrFail($id);

        return view(
            'admin/updateuser',
            $data
        );
    }

    public function updateuser(Request $request, $id)
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

        return redirect(route('showlistuser'))->with('success', 'User Berhasil Diubah!');
    }

    public function addadmin()
    {
        return view('admin/addadmin');
    }

    public function createadmin(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:100', 'email', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect(route('showlistadmin'));
    }

    public function editadmin($id)
    {
        $data['admin'] = Admin::findOrFail($id);

        return view(
            'admin/updateadmin',
            $data
        );
    }

    public function updateadmin(Request $request, $id)
    {
        // mendapatkan data
        $data['admin'] = Admin::findOrFail($id);

        $request->validate([
            'name' => 'string',
            'email' => 'string',
        ]);

        // update data pada database berdasarkan id
        Admin::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect(route('showlistadmin'))->with('success', 'Admin Berhasil Diubah!');
    }
}
