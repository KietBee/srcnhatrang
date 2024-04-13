<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashBoardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/post', [DashBoardController::class, 'post'])->name('admin.post');
    Route::get('/user', [UserController::class, 'getAllUser'])->name('admin.user');
    Route::get('/user-detail', [UserController::class, 'getAllUser'])->name('admin.user');
    Route::get('/user/{id}', [UserController::class, 'getDetailUser'])->name('admin.detail-user');
});

