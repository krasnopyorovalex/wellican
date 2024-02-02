<?php

use App\Http\Controllers\App\CatalogController;
use App\Http\Controllers\App\IndexController;
use App\Http\Controllers\App\NewController;
use App\Http\Controllers\App\ObjectController;
use App\Http\Controllers\App\ObjectTypeController;
use App\Http\Controllers\App\PageController;
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

Route::get('/', IndexController::class)->name('home');

Route::get('catalog', CatalogController::class)->name('catalog.show');
Route::get('{alias}', PageController::class)->name('page.show');
Route::get('object-type/{alias}', ObjectTypeController::class)->name('object_type.show');
Route::get('object/{alias}', ObjectController::class)->name('object.show');
Route::get('new/{alias}', NewController::class)->name('new.show');

require_once base_path('routes/dashboard.php');
