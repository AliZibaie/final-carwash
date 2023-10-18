<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'showRegister'])->name('show.register');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::middleware('auth')->group(function (){
    Route::prefix('dashboard')->group(function (){
        Route::post('/', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [ProfileController::class, 'dashboard'])->name('dashboard');
    });
    Route::prefix('services')->group(function (){
        Route::get('/', [ServiceController::class, 'index'])->name('services.index');
        Route::get('/create', [ServiceController::class, 'create'])->name('services.create');
        Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        Route::get('/{service}', [ServiceController::class, 'show'])->name('services.show');
        Route::post('/', [ServiceController::class, 'reserve'])->name('services.reserve');
        Route::put('/', [ServiceController::class, 'fastReserve'])->name('services.fast.reserve');
    });
});

