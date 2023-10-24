<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\UserStatusController;
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
        Route::get('edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('edit', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    Route::prefix('services')->group(function (){
        Route::get('/', [ServiceController::class, 'index'])->name('services.index');
        Route::get('/create', [ServiceController::class, 'create'])->name('services.create');
        Route::post('/create', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        Route::patch('/{service}/edit', [ServiceController::class, 'update'])->name('services.update');
        Route::get('/{service}', [ServiceController::class, 'show'])->name('services.show');
        Route::post('/{service}', [ReservationController::class, 'reserve'])->name('services.reserve');
        Route::put('/{service}', [ReservationController::class, 'fastReserve'])->name('services.fast.reserve');
        Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('service.destroy');
    });
    Route::prefix('trackings')->group(function (){
        Route::get('/', [TrackingController::class, 'index'])->name('trackings.index');
        Route::get('/{tracking}/edit', [TrackingController::class, 'edit'])->name('trackings.edit');
        Route::patch('/{tracking}/edit', [TrackingController::class, 'update'])->name('trackings.update');
        Route::get('/{tracking}', [TrackingController::class, 'show'])->name('trackings.show');
        Route::delete('/{tracking}', [TrackingController::class, 'destroy'])->name('tracking.destroy');
    });
    Route::prefix('reservations')->group(function (){
        Route::get('/', [ReservationController::class, 'index'])->name('reservations.index');
//
        Route::post('/indexByDay', [ReservationController::class, 'indexFilterByDay'])->name('filter.day');Route::put('/indexByService', [ReservationController::class, 'indexFilterByService'])->name('filter.service');

    });
    Route::middleware('is_admin')->group(function (){
       Route::get('users', [UserStatusController::class,'index' ])->name('users.index') ;
       Route::get('users/{user}', [UserStatusController::class,'show' ])->name('users.show') ;
    });
});

