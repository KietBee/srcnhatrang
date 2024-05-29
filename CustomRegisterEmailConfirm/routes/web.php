<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\LoginRegisterController;

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

// Define Custom User Registration & Login Routes
Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/home', 'home')->middleware('verified')->name('home');
    Route::post('/logout', 'logout')->name('logout');
});

// Define Custom Verification Routes
Route::controller(VerificationController::class)->group(function() {
    Route::get('/email/verify', 'notice')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
    Route::post('/email/resend', 'resend')->name('verification.resend');
});

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
