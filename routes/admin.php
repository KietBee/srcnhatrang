<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\SpecieController;
use App\Helpers\ExcelHelpers;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('post', [DashBoardController::class, 'post']);
    Route::get('user', [UserController::class, 'getAllUsers'])->name('admin.user');
    Route::post('user', [UserController::class, 'createUser'])->name('admin.user.create');
    Route::post('user/delete-user', [UserController::class, 'deleteUser'])->name('admin.user.delete');
    Route::get('pet', [PetController::class, 'getAllPet'])->name('admin.pet');
    Route::get('pet/{id}', [PetController::class, 'getDetailPet'])->name('admin.detail-pet');
    Route::get('/user-detail/{id}', [UserController::class, 'getDetailUser'])->name('admin.detail-user');
    Route::patch('/user-detail/{id}', [UserController::class, 'updateUser'])->name('admin.user.update');
    Route::get('specie', [SpecieController::class, 'getAllSpecie'])->name('admin.specie');
    Route::get('/export-excel', [UserController::class, 'exportUserToExcel'])->name('admin.export-excel');
});
