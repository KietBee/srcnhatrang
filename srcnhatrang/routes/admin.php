<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\SpecieController;
use App\Http\Controllers\Admin\PetAdoptionController;
use App\Http\Controllers\Admin\PetAdoptionRequestController;
use App\Http\Controllers\Admin\QAController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Helpers\ExcelHelpers;

Route::middleware(['auth', 'admin'])->group(function () {
    // Route::get('post', [DashBoardController::class, 'post']);
    Route::get('admin/user', [UserController::class, 'index'])->name('admin.user');
    Route::post('admin/user', [UserController::class, 'create'])->name('admin.user.create');
    Route::delete('admin/user/{id}', [UserController::class, 'destroy']);
    Route::get('admin/pet', [PetController::class, 'index'])->name('admin.pet');
    Route::get('admin/pet/{id}', [PetController::class, 'getDetailPet'])->name('admin.detail-pet');
    Route::delete('admin/pet/{id}', [PetController::class, 'destroy']);

    //pet-adoption
    Route::get('admin/pet-adoption', [PetAdoptionController::class, 'index'])->name('admin.pet-adoption');
    Route::post('admin/pet-adoption', [PetAdoptionController::class, 'create'])->name('admin.pet-adoption.create');
    Route::get('admin/pet-adoption/edit/{id}', [PetAdoptionController::class, 'edit'])->name('admin.pet-adoption.edit');
    Route::patch('admin/pet-adoption/edit/{id}', [PetAdoptionController::class, 'update'])->name('admin.pet-adoption.update');
    Route::delete('admin/pet-adoption/{id}', [PetAdoptionController::class, 'destroy']);
    //pet-adoption-request
    Route::get('admin/pet-adoption-request', [PetAdoptionRequestController::class, 'index'])->name('admin.pet-adoption-request');
    // Route::post('pet-adoption', [PetAdoptionController::class, 'create'])->name('admin.pet-adoption.create');
    // Route::get('pet-adoption/edit/{id}', [PetAdoptionController::class, 'edit'])->name('admin.pet-adoption.edit');
    // Route::patch('pet-adoption/edit/{id}', [PetAdoptionController::class, 'update'])->name('admin.pet-adoption.update');
    // Route::delete('pet-adoption/{id}', [PetAdoptionController::class, 'destroy']);
    //address
    Route::get('admin/address', [AddressController::class, 'index'])->name('admin.address');
    //q&a
    Route::get('admin/QA', [QAController::class, 'index'])->name('admin.QA');
    Route::post('admin/QA', [QAController::class, 'create'])->name('admin.QA.create');
    Route::get('admin/QA/edit/{id}', [QAController::class, 'edit'])->name('admin.QA.edit');
    Route::patch('admin/QA/edit/{id}', [QAController::class, 'update'])->name('admin.QA.update');
    Route::delete('admin/QA/{id}', [QAController::class, 'destroy']);
    //feedback
    Route::get('admin/feedback', [FeedbackController::class, 'index'])->name('admin.feedback');
    Route::get('admin/feedback/send-response/{id}', [FeedbackController::class, 'sendResponse'])->name('admin.feedback.sendResponse');
    Route::patch('admin/feedback/send-response/{id}', [FeedbackController::class, 'update'])->name('admin.feedback.update');
    Route::delete('admin/feedback/{id}', [FeedbackController::class, 'destroy']);
    //
    Route::get('admin/user-detail/{id}', [UserController::class, 'getDetailUser'])->name('admin.detail-user');
    Route::patch('admin/user-detail/{id}', [UserController::class, 'updateUser'])->name('admin.user.update');
    Route::get('admin/specie', [SpecieController::class, 'getAllSpecie'])->name('admin.specie');
    Route::get('admin/export-excel', [UserController::class, 'exportUserToExcel'])->name('admin.export-excel');
});
