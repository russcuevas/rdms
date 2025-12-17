<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\auth\AuthController;

use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'HomePage'])->name('homepage');

Route::get('/login', [AuthController::class, 'LoginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['supabase.auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'AdminDashboardPage'])->name('admin.dashboard.page');
});

