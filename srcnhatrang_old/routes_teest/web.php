<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\SpecieController;
use App\Http\Controllers\AddressController;

Route::get('/', function () {
    return view('index');
});
Route::get('/', function () {
    return view('dashboard');
});
Route::get('districts/{province_id}', [AddressController::class, 'getDistricts'])->name('districts');
Route::get('wards/{district_id}', [AddressController::class, 'getWards'])->name('wards');

Route::get('send-email', function () {
    Mail::to('hien37211@gmail.com')->send(new NotifyMail());
    echo "Email has been sent";
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [DashBoardController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
// Route::get('post', [DashBoardController::class, 'post']);
// dd(Route::get('post', [DashBoardController::class, 'post'])->middleware(['auth', 'admin']));

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

require __DIR__.'/admin.php';
