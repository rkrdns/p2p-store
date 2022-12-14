<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

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

// buy product
Route::get('/', [OrderController::class, 'index']);

// generate checkout session
Route::post('/', [OrderController::class, 'store']);

// verify status update
Route::get('/verify/{ref}', [OrderController::class, 'verify']);

// show current status
Route::get('/status/{ref}', [OrderController::class, 'status']);

// show orders
Route::get('/orders', [OrderController::class, 'orders']);

// regenerate checkout session
Route::get('/regenerate/{ref}', [OrderController::class, 'regenerate']);