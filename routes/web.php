<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\RayController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum'])->group(function () {
    // CATEGORY
    Route::resource('categories', CategoryController::class);
    // FAMILY
    Route::resource('families', FamilyController::class);
    // SIZE
    Route::resource('sizes', SizeController::class);
    // COLOR
    Route::resource('colors', ColorController::class);
    // RAY
    Route::resource('rays', RayController::class);
});
