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
