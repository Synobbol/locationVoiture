<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgencesController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\MembresController;
use App\Http\Controllers\CommandesController;

use App\Http\Controllers\HomeController;
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

Route::resource('agences', AgencesController::class);
Route::resource('cars', VehiculeController::class);
Route::resource('membres', MembresController::class);
Route::resource('commandes', CommandesController::class);

Route::get('/', [HomeController::class, 'index']);

