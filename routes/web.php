<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogActivityController;

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
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:admin', 'role:approver1', 'role:approver2'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/status-count', [DashboardController::class, 'index'])->name('dashboard.statusCounts');
    Route::get('/dashboard/vehicle-count', [DashboardController::class, 'index'])->name('dashboard.vehicleCounts');
    Route::get('/formPemesanan', [OrderController::class, 'create'])->name('formPemesanan');
    Route::post('/formPemesanan', [OrderController::class, 'store'])->name('storePemesanan');
    Route::get('/pemesanan', [OrderController::class, 'index'])->name('pemesanan');
    Route::post('/pemesanan/approve/{order}', [OrderController::class, 'approve'])->name('pemesanan.approve');
    Route::post('/pemesanan/reject/{order}', [OrderController::class, 'reject'])->name('pemesanan.reject');
    Route::post('/pemesanan/{order}/complete', [OrderController::class, 'complete'])->name('pemesanan.complete');
    Route::get('/pemesanan/export', [OrderController::class, 'export'])->name('pemesanan.export');
    Route::get('/logPemesanan', [OrderController::class, 'showLogs'])->name('logPemesanan');

});
