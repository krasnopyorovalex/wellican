<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::pattern('alias', '[\da-z-&A-Z]+');

Route::get('/', static function () {
    return view('layouts.admin');
});

require_once base_path('routes/dashboard.php');
