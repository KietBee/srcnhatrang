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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Client\StoryController;
use App\Http\Controllers\Client\PetAdoptionController;
use App\Http\Controllers\Client\MoneyDonationController;
use App\Http\Controllers\Client\PayMentController;
use App\Http\Controllers\Client\StatisticsController;
use App\Http\Controllers\Client\FeedbacksController;


Route::get('districts/{province_id}', [AddressController::class, 'getDistricts'])->name('districts');
Route::get('wards/{district_id}', [AddressController::class, 'getWards'])->name('wards');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/new-and-post', [StoryController::class, 'index'])->name('new-and-post');
Route::get('new-and-post/{id}', [StoryController::class, 'details'])->name('new-and-post.details');
Route::get('pet-adoptions', [PetAdoptionController::class, 'index'])->name('pet-adoptions');
Route::get('pet-adoptions/{id}', [PetAdoptionController::class, 'details'])->name('pet-adoptions.details');
Route::get('/money-donation', [MoneyDonationController::class, 'index'])->name('money-donation');

Route::get('handle-payment', [MoneyDonationController::class, 'handlePayment'])->name('handle-payment');
Route::get('thanks', [MoneyDonationController::class, 'thanks'])->name('thanks');

Route::post('vnpay-payment', [PaymentController::class, 'vnPayPayment'])->name('vnpay-payment');

Route::get('statistics', [StatisticsController::class, 'index'])->name('statistics');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('new-and-post', [StoryController::class, 'create'])->name('new-and-post.create');
    Route::get('pet-adoptions-requests/{id}', [PetAdoptionController::class, 'requests'])->name('pet-adoptions-requests.requests');
    Route::post('pet-adoptions-requests', [PetAdoptionController::class, 'createRequests'])->name('pet-adoptions-requests.createRequests');

    Route::get('feedbacks', [FeedbacksController::class, 'index'])->name('feedbacks');
    Route::post('feedbacks', [FeedbacksController::class, 'create'])->name('feedbacks.create');
});

require __DIR__.'/auth.php';

require __DIR__.'/admin.php';
