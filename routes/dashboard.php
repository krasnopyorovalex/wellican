<?php

use App\Http\Controllers\Admin\FilterOptionController;
use App\Http\Controllers\Admin\FiltersController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\InfoController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ObjectController;
use App\Http\Controllers\Admin\ObjectImageController;
use App\Http\Controllers\Admin\ObjectTypeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[\d]+');
Route::pattern('objectId', '[\d]+');
Route::pattern('filterId', '[\d]+');

Route::group(['prefix' => '_root', 'middleware' => 'auth', 'as' => 'admin.'], static function () {
    Route::get('', HomeController::class)->name('home');

    Route::resource('locations', LocationController::class)->parameters(['locations' => 'id']);
    Route::resource('pages', PageController::class)->parameters(['pages' => 'id']);
    Route::resource('news', InfoController::class)->parameters(['news' => 'id']);
    Route::resource('users', UserController::class)->parameters(['users' => 'id']);
    Route::resource('objects', ObjectController::class)->parameters(['objects' => 'id']);
    Route::resource('object-types', ObjectTypeController::class)->parameters(['object_types' => 'id']);

    Route::group(['prefix' => 'object-types'], static function () {
        Route::controller(FiltersController::class)->prefix('{parentId}/filters')->group(function () {
            Route::get('', 'index')->name('filters.index');
            Route::post('', 'store')->name('filters.store');
            Route::get('create', 'create')->name('filters.create');
            Route::get('{id}/edit', 'edit')->name('filters.edit');
            Route::put('{id}', 'update')->name('filters.update');
            Route::delete('{id}', 'destroy')->name('filters.destroy');
        });
    });

    Route::controller(ObjectImageController::class)->prefix('object-images')->group(function () {
        Route::get('{objectId}', 'index')->name('object-images.index');
        Route::post('{objectId}', 'store')->name('object-images.store');
        Route::put('{id}', 'update')->name('object-images.update');
        Route::delete('{id}', 'destroy')->name('object-images.destroy');
    });

    Route::controller(FilterOptionController::class)->prefix('options')->group(function () {
        Route::get('{filterId}', 'index')->name('options.index');
        Route::post('{filterId}', 'store')->name('options.store');
        Route::get('{filterId}/create', 'create')->name('options.create');
        Route::get('{id}/edit', 'edit')->name('options.edit');
        Route::put('{id}', 'update')->name('options.update');
        Route::delete('{id}', 'destroy')->name('options.destroy');
    });

    Route::resource('images', ImageController::class)->parameters(['images' => 'id'])->only(['update', 'destroy']);
    Route::resource('roles', RoleController::class)->parameters(['roles' => 'id']);
    Route::resource('permissions', PermissionController::class)->parameters(['permissions' => 'id']);

    Route::get('search', SearchController::class)->name('search');
});
