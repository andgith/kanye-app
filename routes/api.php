<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\QuotesController;

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

Route::prefix('v1')->middleware(['api.token'])->group(function () {
    Route::get('quotes', [QuotesController::class, 'index'])->name('api.quotes.index');
    Route::get('refresh', [QuotesController::class, 'refresh'])->name('api.quotes.refresh');
});
