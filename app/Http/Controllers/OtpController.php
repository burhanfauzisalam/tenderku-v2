<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\UserOtp;
use Illuminate\Support\Carbon;

class OtpController extends Controller
{
    /**
     * Kirim kode OTP ke nomor HP
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'nohp' => 'required|string|max:20',
        ]);

        $nohp = preg_replace('/\D/', '', $request->nohp); // hanya angka
        $otp = rand(100000, 999999); // 6 digit OTP
        $expiresAt = Carbon::now()->addMinutes(5); // OTP berlaku 5 menit

        $check = UserOtp::whereHas('user', function ($query) use ($nohp) {
            $query->where('nohp', $nohp)->where('is_used', 0);
        })->first();
        // dd($check);
        if ($check) {
            $check->delete();
        }
        // Simpan ke database
        UserOtp::create([
            'user_id' => Auth::id(),
            'nohp' => $nohp,
            'otp_code' => $otp,
            'expires_at' => $expiresAt,
            'is_used' => false,
        ]);

        try {
            // Kirim OTP ke nomor user
            // ❗ Ganti dengan API SMS/WA Gateway kamu
            // Contoh: kirim ke API WhatsApp Gateway (MIMAMCH / wa-blast)
            Http::post('https://portal.ptbmi.com/wagateway/message/send-text', [
                'session' => 'burhan',
                'to' => $nohp,
                'text' => "Kode OTP kamu adalah *{$otp}*. Berlaku hingga " . $expiresAt->format('H:i') . ".",
                'is_group' => false,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim OTP: ' . $e->getMessage(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Kode OTP berhasil dikirim ke nomor ' . $nohp,
        ]);
    }

    /**
     * Verifikasi kode OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'nohp' => 'required|string|max:20',
            'otp_code' => 'required|string|size:6',
        ]);

        $nohp = preg_replace('/\D/', '', $request->nohp);
        $otp_code = $request->otp_code;

        // Ambil OTP terbaru
        $otpRecord = UserOtp::where('nohp', $nohp)
            ->where('otp_code', $otp_code)
            ->where('is_used', 0)
            ->latest()
            ->first();
        // dd($otpRecord);
        // Validasi
        if (!$otpRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP salah',
            ]);
        }

        if ($otpRecord->expires_at->isPast()) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP sudah kedaluwarsa.',
            ]);
        }

        // Tandai sudah digunakan
        $otpRecord->update(['is_used' => 1]);

        // Tandai user sudah verifikasi nomor HP
        Auth::user()->details->updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'verified_nohp' => 1,
                'nohp' => $nohp
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Nomor HP berhasil diverifikasi!',
        ]);
    }
}