<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\SpecieController;

Route::get('/', function () {
    return view('index');
});



Route::get('send-email', function () {
    Mail::to('hien37211@gmail.com')->send(new NotifyMail());
    echo "Email has been sent";
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [DashBoardController::class, 'index'])->middleware('auth')->name('home');

Route::get('post', [DashBoardController::class, 'post'])->middleware(['auth', 'admin']);
Route::get('user', [UserController::class, 'getAllUser'])->middleware(['auth', 'admin']);
Route::get('pet', [PetController::class, 'getAllPet'])->middleware(['auth', 'admin'])->name('admin.pet');
Route::get('pet/{id}', [PetController::class, 'getDetailPet'])->middleware(['auth', 'admin'])->name('admin.detail-pet');
Route::get('/user/{id}', [UserController::class, 'getDetailUser'])->name('admin.detail-user');
Route::get('specie', [SpecieController::class, 'getAllSpecie'])->middleware(['auth', 'admin'])->name('admin.specie');
// dd(Route::get('post', [DashBoardController::class, 'post'])->middleware(['auth', 'admin']));

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
