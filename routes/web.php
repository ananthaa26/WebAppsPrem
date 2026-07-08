<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homeapps');
});

Route::get('/hubungi-kami', function () {
    return view('contact');
});
