<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login.form'); // redirect ke login
        }
        $user = Auth::user()->load('details');
        // dd($user->details['fullname']);
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'fullname'     => 'required|string|max:255',
            'name'         => 'required|string|max:255',
            'nohp'         => [
                'nullable',
                'string',
                'max:20',
                // tidak boleh sama dengan user lain
                Rule::unique('user_profiles', 'nohp')->ignore(Auth::id(), 'user_id'),
            ],
            'address'      => 'nullable|string|max:255',
            'address_ktp'  => 'nullable|string|max:255',
            'rekening'     => [
                'nullable',
                'string',
                'max:50',
                // tidak boleh sama dengan user lain
                Rule::unique('user_profiles', 'rekening')->ignore(Auth::id(), 'user_id'),
            ],
            'bank'         => 'nullable|string|max:100',
        ]);


        try {
            DB::beginTransaction();

            // Update tabel users
            // $user->update([
            //     'name' => $request->name,
            // ]);

            // Update atau buat data detail user (relasi one-to-one)
            $user->details()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'fullname'    => strtoupper($request->fullname),
                    'nohp'        => $request->nohp,
                    'address'     => $request->address,
                    'address_ktp' => $request->address_ktp,
                    'rekening'    => strtoupper($request->rekening),
                    'bank'        => strtoupper($request->bank),
                ]
            );

            DB::commit();

            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to update profile: ' . $e->getMessage()]);
        }
    }
}
