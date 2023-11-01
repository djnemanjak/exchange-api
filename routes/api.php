<?php

use App\Http\Controllers\Api\V1\ExchangeController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\RateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/sync-rates', [RateController::class, 'syncRates']);
Route::get('/convert', [ExchangeController::class, 'convert']);
Route::post('/orders', [OrderController::class, 'createOrder']);
