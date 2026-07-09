<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('homeapps');
});

Route::get('/hubungi-kami', function () {
    return view('contact');
});

Route::get('/syarat-ketentuan', function () {
    return view('terms');
});

Route::get('/kebijakan-privasi', function () {
    return view('privacy');
});

Route::get('/pesanan', function () {
    return view('pesanan');
});

Route::get('/auth', function () {
    if (auth()->check()) {
        return redirect('/akun');
    }
    return view('auth');
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/akun', function () {
    return view('akun');
});

Route::get('/auth/verify-email/send', function () {
    if (!auth()->check()) return redirect('/auth');
    $user = auth()->user();
    
    if ($user->email_verified_at) {
        return back()->with('success', 'Email sudah terverifikasi.');
    }

    $token = base64_encode($user->email . '|' . time());
    $verify_url = url('/auth/verify-email/confirm?token=' . $token);

    $html = view('components.email', [
        'name' => $user->name,
        'verify_url' => $verify_url
    ])->render();

    $response = Illuminate\Support\Facades\Http::get('https://emailsend.zannstore.com/send-email', [
        'to' => $user->email,
        'subject' => 'Verifikasi Email - ZANNSTORE',
        'message' => $html
    ]);

    if ($response->successful()) {
        return back()->with('success', 'Email aktivasi berhasil dikirim! Silakan cek kotak masuk atau folder spam Anda.');
    } else {
        return back()->with('error', 'Gagal mengirim email aktivasi. Coba lagi nanti.');
    }
});

Route::get('/auth/verify-email/confirm', function (Illuminate\Http\Request $request) {
    $token = $request->query('token');
    if (!$token) return redirect('/')->with('error', 'Token verifikasi tidak valid.');
    
    $decoded = base64_decode($token);
    $parts = explode('|', $decoded);
    if (count($parts) !== 2) return redirect('/')->with('error', 'Token verifikasi tidak valid.');
    
    $email = $parts[0];
    
    $user = App\Models\User::where('email', $email)->first();
    if ($user) {
        $user->email_verified_at = now();
        $user->save();
        return redirect('/akun')->with('success', 'Email Anda berhasil diverifikasi!');
    }
    
    return redirect('/')->with('error', 'Pengguna tidak ditemukan.');
});
