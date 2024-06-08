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
use App\Http\Controllers\Admin\AgeController;
use App\Http\Controllers\Admin\BreedController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\FundController;
use App\Http\Controllers\Admin\MoneyDonationController;
use App\Http\Controllers\Admin\PetImageController;
use App\Http\Controllers\Admin\PredefinedMonthlyAmountController;
use App\Http\Controllers\Admin\PredefinedOnlyAmountController;
use App\Http\Controllers\Admin\PrimaryColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\UserTypeController;

Route::middleware(['auth', 'admin'])->group(function () {
    //user
    Route::get('admin/user', [UserController::class, 'index'])->name('admin.user');
    Route::post('admin/user', [UserController::class, 'create'])->name('admin.user.create');
    Route::delete('admin/user/{id}', [UserController::class, 'destroy']);
    
    //pet
    Route::get('admin/pet', [PetController::class, 'index'])->name('admin.pet');
    Route::post('admin/pet', [PetController::class, 'create'])->name('admin.pet.create');
    Route::get('admin/pet/{id}', [PetController::class, 'edit'])->name('admin.pet.edit');
    Route::patch('admin/pet/{id}', [PetController::class, 'update'])->name('admin.pet.update');
    Route::delete('admin/pet/{id}', [PetController::class, 'destroy'])->name('admin.pet.delete');
    
    //pet-adoption
    Route::get('admin/pet-adoption', [PetAdoptionController::class, 'index'])->name('admin.pet-adoption');
    Route::post('admin/pet-adoption', [PetAdoptionController::class, 'create'])->name('admin.pet-adoption.create');
    Route::get('admin/pet-adoption/edit/{id}', [PetAdoptionController::class, 'edit'])->name('admin.pet-adoption.edit');
    Route::patch('admin/pet-adoption/edit/{id}', [PetAdoptionController::class, 'update'])->name('admin.pet-adoption.update');
    Route::delete('admin/pet-adoption/{id}', [PetAdoptionController::class, 'destroy']);
    
    //pet-adoption-request
    Route::get('admin/pet-adoption-request', [PetAdoptionRequestController::class, 'index'])->name('admin.pet-adoption-request');
    Route::get('admin/pet-adoption-request/edit/{id}', [PetAdoptionRequestController::class, 'edit'])->name('admin.pet-adoption-request.edit');
    Route::patch('admin/pet-adoption-request/edit/{id}', [PetAdoptionRequestController::class, 'update'])->name('admin.pet-adoption-request.update');
    Route::get('admin/pet-adoption-request/refuse/{id}', [PetAdoptionRequestController::class, 'refuseView'])->name('admin.pet-adoption-request.refuseView');
    Route::patch('admin/pet-adoption-request/refuse/{id}', [PetAdoptionRequestController::class, 'refuse'])->name('admin.pet-adoption-request.refuse');
    Route::delete('admin/pet-adoption-request/{id}', [PetAdoptionRequestController::class, 'destroy']);
    
    //address
    Route::get('admin/address', [AddressController::class, 'index'])->name('admin.address');
    
    //q&a
    Route::get('admin/QA', [QAController::class, 'index'])->name('admin.QA');
    Route::post('admin/QA', [QAController::class, 'create'])->name('admin.QA.create');
    Route::get('admin/QA/edit/{id}', [QAController::class, 'edit'])->name('admin.QA.edit');
    Route::patch('admin/QA/edit/{id}', [QAController::class, 'update'])->name('admin.QA.update');
    Route::delete('admin/QA/{id}', [QAController::class, 'destroy'])->name('admin.QA.delete');
    
    //predefined monthly amount
    Route::get('admin/predefined-monthly-amount', [PredefinedMonthlyAmountController::class, 'index'])->name('admin.predefined-monthly-amount');
    Route::post('admin/predefined-monthly-amount', [PredefinedMonthlyAmountController::class, 'create'])->name('admin.predefined-monthly-amount.create');
    Route::get('admin/predefined-monthly-amount/edit/{id}', [PredefinedMonthlyAmountController::class, 'edit'])->name('admin.predefined-monthly-amount.edit');
    Route::patch('admin/predefined-monthly-amount/edit/{id}', [PredefinedMonthlyAmountController::class, 'update'])->name('admin.predefined-monthly-amount.update');
    Route::delete('admin/predefined-monthly-amount/{id}', [PredefinedMonthlyAmountController::class, 'destroy']);
    
    //predefined only amount
    Route::get('admin/predefined-only-amount', [PredefinedOnlyAmountController::class, 'index'])->name('admin.predefined-only-amount');
    Route::post('admin/predefined-only-amount', [PredefinedOnlyAmountController::class, 'create'])->name('admin.predefined-only-amount.create');
    Route::get('admin/predefined-only-amount/edit/{id}', [PredefinedOnlyAmountController::class, 'edit'])->name('admin.predefined-only-amount.edit');
    Route::patch('admin/predefined-only-amount/edit/{id}', [PredefinedOnlyAmountController::class, 'update'])->name('admin.predefined-only-amount.update');
    Route::delete('admin/predefined-only-amount/{id}', [PredefinedOnlyAmountController::class, 'destroy']);
    
    //user type
    Route::get('admin/user-type', [UserTypeController::class, 'index'])->name('admin.user-type');
    Route::post('admin/user-type', [UserTypeController::class, 'create'])->name('admin.user-type.create');
    Route::get('admin/user-type/edit/{id}', [UserTypeController::class, 'edit'])->name('admin.user-type.edit');
    Route::patch('admin/user-type/edit/{id}', [UserTypeController::class, 'update'])->name('admin.user-type.update');
    Route::delete('admin/user-type/{id}', [UserTypeController::class, 'destroy']);
    
    //expense
    Route::get('admin/expense', [ExpenseController::class, 'index'])->name('admin.expense');
    Route::post('admin/expense', [ExpenseController::class, 'create'])->name('admin.expense.create');
    Route::get('admin/expense/edit/{id}', [ExpenseController::class, 'edit'])->name('admin.expense.edit');
    Route::patch('admin/expense/edit/{id}', [ExpenseController::class, 'update'])->name('admin.expense.update');
    Route::delete('admin/expense/{id}', [ExpenseController::class, 'destroy']);
    
    //feedback
    Route::get('admin/feedback', [FeedbackController::class, 'index'])->name('admin.feedback');
    Route::get('admin/feedback/send-response/{id}', [FeedbackController::class, 'sendResponse'])->name('admin.feedback.sendResponse');
    Route::patch('admin/feedback/send-response/{id}', [FeedbackController::class, 'update'])->name('admin.feedback.update');
    Route::delete('admin/feedback/{id}', [FeedbackController::class, 'destroy']);
    
    //statistic
    Route::get('admin/statistic', [StatisticController::class, 'index'])->name('admin.statistic');
    
    //story
    Route::get('admin/story', [StoryController::class, 'index'])->name('admin.story');
    Route::post('admin/story', [StoryController::class, 'create'])->name('admin.story.create');
    Route::get('admin/story/edit/{id}', [StoryController::class, 'edit'])->name('admin.story.edit');
    Route::patch('admin/story/edit/{id}', [StoryController::class, 'update'])->name('admin.story.update');
    Route::delete('admin/story/{id}', [StoryController::class, 'destroy']);
    Route::get('admin/story/refuse/{id}', [StoryController::class, 'refuseView'])->name('admin.story.refuseView');
    Route::patch('admin/story/refuse/{id}', [StoryController::class, 'refuse'])->name('admin.story.refuse');

    //money donations
    Route::get('admin/money-donation', [MoneyDonationController::class, 'index'])->name('admin.money-donation');

    //fund
    Route::get('admin/fund', [FundController::class, 'index'])->name('admin.fund');
    Route::post('admin/fund', [FundController::class, 'create'])->name('admin.fund.create');
    
    //category
    Route::get('admin/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('admin/category', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::patch('admin/category/edit/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('admin/category/{id}', [CategoryController::class, 'destroy']);

    //age
    Route::get('admin/age', [AgeController::class, 'index'])->name('admin.age');
    Route::post('admin/age', [AgeController::class, 'create'])->name('admin.age.create');
    Route::get('admin/age/edit/{id}', [AgeController::class, 'edit'])->name('admin.age.edit');
    Route::patch('admin/age/edit/{id}', [AgeController::class, 'update'])->name('admin.age.update');
    Route::delete('admin/age/{id}', [AgeController::class, 'destroy']);

    //size
    Route::get('admin/size', [SizeController::class, 'index'])->name('admin.size');
    Route::post('admin/size', [SizeController::class, 'create'])->name('admin.size.create');
    Route::get('admin/size/edit/{id}', [SizeController::class, 'edit'])->name('admin.size.edit');
    Route::patch('admin/size/edit/{id}', [SizeController::class, 'update'])->name('admin.size.update');
    Route::delete('admin/size/{id}', [SizeController::class, 'destroy']);

    //primary color
    Route::get('admin/primary-color', [PrimaryColorController::class, 'index'])->name('admin.primary-color');
    Route::post('admin/primary-color', [PrimaryColorController::class, 'create'])->name('admin.primary-color.create');
    Route::get('admin/primary-color/edit/{id}', [PrimaryColorController::class, 'edit'])->name('admin.primary-color.edit');
    Route::patch('admin/primary-color/edit/{id}', [PrimaryColorController::class, 'update'])->name('admin.primary-color.update');
    Route::delete('admin/primary-color/{id}', [PrimaryColorController::class, 'destroy']);

    //breed
    Route::get('admin/breed', [BreedController::class, 'index'])->name('admin.breed');
    Route::post('admin/breed', [BreedController::class, 'create'])->name('admin.breed.create');
    Route::get('admin/breed/edit/{id}', [BreedController::class, 'edit'])->name('admin.breed.edit');
    Route::patch('admin/breed/edit/{id}', [BreedController::class, 'update'])->name('admin.breed.update');
    Route::delete('admin/breed/{id}', [BreedController::class, 'destroy']);

    //species
    Route::get('admin/species', [SpecieController::class, 'index'])->name('admin.species');
    Route::post('admin/species', [SpecieController::class, 'create'])->name('admin.species.create');
    Route::get('admin/species/edit/{id}', [SpecieController::class, 'edit'])->name('admin.species.edit');
    Route::patch('admin/species/edit/{id}', [SpecieController::class, 'update'])->name('admin.species.update');
    Route::delete('admin/species/{id}', [SpecieController::class, 'destroy']);

    //pet image
    Route::get('admin/pet-image', [PetImageController::class, 'index'])->name('admin.pet-image');
    Route::post('admin/pet-image', [PetImageController::class, 'create'])->name('admin.pet-image.create');
    Route::delete('admin/pet-image/{id}', [PetImageController::class, 'destroy']);
});
