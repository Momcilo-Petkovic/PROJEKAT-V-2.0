<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReservationController;
//use vendor\laravel\fortify\src\Http\Controllers\AuthenticatedSessionController;


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

Route::get('/',[HomeController::class,'index']);

Route::get("/filter/type/{id}",[HomeController::class,'filter'])->name('filter');
Route::get("/place/{id}",[PlaceController::class,'index']);
Route::get("/reservation/{id}",[ReservationController::class,'index']);
Route::post("/reservation/make",[ReservationController::class,'reserve'])->name('make-reservation');


Route::middleware('admin:admin')->group(function () {
    Route::get('admin/login', [AdminController::class, 'loginForm']);
    Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:sanctum,admin', config('jetstream.auth_session'), 'verified'
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin-dashboard'); // Ovde bih menjao kom dashboardu zelim admin da pristupi
    })->name('dashboard')->middleware('auth:admin');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('admin/logout', [AdminController::class, 'destroy'])->name('alogout');

Route::get('/admin/dashboard', [AdminController::class, 'returnData'])->name('admin-dashboard');

Route::post('/insert-place', [AdminController::class, 'insertPlace'])->name('insert-place');
Route::post('/insert-performance', [AdminController::class, 'insertPerformance'])->name('insert-performance');
Route::post('/insert-genre', [AdminController::class, 'insertGenre'])->name('insert-genre');
Route::post('/insert-type', [AdminController::class, 'insertType'])->name('insert-type');

