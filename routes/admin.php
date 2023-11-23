<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\UserController;

Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['auth', 'verified'])->controller(ProfileController::class)->group(function(){
        Route::get('/profile','adminProfile')->name('profile');
        Route::post('/change-profile-picture', 'ChangeProfilePicture')->name('change-profile-picture');
    });

    Route::middleware(['auth', 'verified'])->controller(UserController::class)->group(function(){
        Route::get('/users', 'userList')->name('user-list');
    });

});
