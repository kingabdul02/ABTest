<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ABTestController;


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

Route::get('/', [ABTestController::class, 'showWelcomePage'])->name('/');
Route::get('/start-test/{id}', [ABTestController::class, 'startTest'])->name('start-test');
Route::get('/stop-test/{id}', [ABTestController::class, 'stopTest'])->name('stop-test');
