<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AnnouncementController;
use App\Http\Controllers\admin\ReportsController;
use App\Http\Controllers\admin\EvacuationController;

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
    // Announcement Routes
    Route::get('/announcement', [AnnouncementController::class, 'AdminAnnouncementPage'])->name('admin.announcement.page');
    Route::post('/announcement/add', [AnnouncementController::class, 'AdminAddAnnouncementRequest'])->name('admin.announcement.add');
    Route::put('/announcements/{id}', [AnnouncementController::class, 'AdminUpdateAnnouncementRequest'])
        ->name('admin.announcements.update');
    Route::delete('/announcements/{id}', [AnnouncementController::class, 'AdminDeleteAnnouncementRequest'])
        ->name('admin.announcements.destroy');

    // Reports Routes
    Route::get('/reports', [ReportsController::class, 'AdminReportsPage'])->name('admin.reports.page');
    // Evacuation Routes
    Route::get('/evacuation', [EvacuationController::class, 'AdminEvacuationPage'])->name('admin.evacuation.page');
    Route::post('/evacuation/add', [EvacuationController::class, 'AdminAddEvacuationRequest'])->name('admin.evacuation.add');
    Route::put('/admin/evacuation/update/{id}', [EvacuationController::class, 'AdminUpdateEvacuationRequest'])->name('admin.evacuation.update');
    Route::delete('/admin/evacuation/delete/{id}', [EvacuationController::class, 'AdminDeleteEvacuationRequest'])->name('admin.evacuation.delete');


});

