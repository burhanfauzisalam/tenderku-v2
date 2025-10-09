<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Mail\VerifyEmail;
use App\Models\UserProfiles;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $token = Str::random(60);

        $user = User::create([
            'name'     => strtoupper($request->name),
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'verify_token'    => $token,
        ]);

        UserProfiles::create([
            'user_id' => $user->id,
        ]);

        // default role user
        $user->assignRole('user');

        if ($user) {
            Mail::to($user->email)->send(new VerifyEmail($token));
            return response()->json([
                'success' => true,
                'message' => 'Akun berhasil dibuat!'
            ]);
        } else {
            return back()->with('error', 'Registrasi gagal. Silakan coba lagi.');
        }

        // return response()->json([
        //     'message' => 'User registered successfully',
        //     'user'    => $user,
        // ], 201);
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // ✅ Cek status user
            if ($user->status == 0) {
                Auth::logout(); // langsung logout
                return back()->withErrors([
                    'email' => 'Akun Anda belum aktif. Silakan verifikasi email terlebih dahulu.'
                ]);
            }

            return match (true) {
                // $user->hasRole('admin') => redirect()->route('admin.dashboard'),
                $user->hasRole('user')  => redirect()->route('dashboard'),
                default => tap(function () {
                    Auth::logout();
                }, fn() => back()->withErrors(['email' => 'Your account has no role.']))
            };
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function verifyEmail($token)
    {
        $user = User::where('verify_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Token tidak valid.');
        }

        // $user->is_verified = true;
        $user->verify_token = null;
        $user->status = 1;
        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('login')->with('success', 'Email berhasil diverifikasi, silakan login.');
    }
}
