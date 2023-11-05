<?php

use App\Http\Controllers\Admin\ObjectController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ObjectTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '_root', 'middleware' => 'auth','as' => 'admin.'], static function () {
    Route::get('', HomeController::class)->name('home');

    Route::controller(ObjectController::class)->prefix('objects')->group(function () {
        Route::get('', 'index')->name('objects.index');
        Route::get('create', 'create')->name('objects.create');
        Route::post('', 'store')->name('objects.store');
        Route::get('{id}/edit', 'edit')->name('objects.edit');
        Route::put('{id}', 'update')->name('objects.update');
        Route::delete('{id}', 'destroy')->name('objects.destroy');
    });

    Route::controller(ObjectTypeController::class)->prefix('object-types')->group(function () {
        Route::get('', 'index')->name('object-types.index');
        Route::get('create', 'create')->name('object-types.create');
        Route::post('', 'store')->name('object-types.store');
        Route::get('{id}/edit', 'edit')->name('object-types.edit');
        Route::put('{id}', 'update')->name('object-types.update');
        Route::delete('{id}', 'destroy')->name('object-types.destroy');
    });

    //    Route::post('upload-ckeditor', 'CkeditorController@upload')->name('upload-ckeditor');
});
