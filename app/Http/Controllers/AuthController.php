<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function userregister()
    {
        return view('userregister');
    }

    public function douserregister(Request $request)
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

        // 
        Auth::login($users);

        return redirect('/login')->with('success', 'registrasi berhasil');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('adminindex');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function forgot()
    {
        return view('forgotpassword');
    }

    public function forgotPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect('login')->with('success', 'Berhasil ganti password!');
        } else {
            return redirect(route('forgot.password'))->with('error', 'User tidak ditemukan!');
        }
    }
}
