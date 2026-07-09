<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth');
});

Route::get('/akun', function () {
    return view('akun');
});
