<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvertisementController;

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


Route::get('/', function () {
    return redirect('advertisement');
});

Route::get('advertisement/admin', [AdvertisementController::class, 'admin'])
    ->name('advertisement.admin');

Route::resource('advertisement', AdvertisementController::class);

Auth::routes();
