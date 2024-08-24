<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function register(Request $request){
        //Validasi data
        $validasiData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|in:male,female',
            'linkedin' => 'required|string',
            'job' => 'required|array|min:3',
            'phone_number' => 'required|string',
        ]);

        $forJob = implode(',', (array) $request->input('job'));

        //buat user baru 
        $user = User::create([
            'name' => $validasiData['name'],
            'email' => $validasiData['email'],
            'password' => Hash::make($validasiData['password']),
            'gender' => $validasiData['gender'],
            'linkedin' => $validasiData['linkedin'],
            'job' => $forJob,
            'phone_number' => $validasiData['phone_number'],
            'register_price' =>rand(100000, 125000)
        ]);

        return redirect('/login');

    }

    public function login(Request $request){
        $validasiLogin = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $validasiLogin['email'])->first();

        if ($user && Hash::check($validasiLogin['password'], $user->password)) {
    
            Auth::login($user);

            return redirect()->route('user.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}

