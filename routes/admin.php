<?php


use App\Http\Controllers\Admin\AdminDashboardController;


Route::group(['prefix' => 'admin', 'name' => 'admin.'], function () {
    Route::get('dashboard',[AdminDashboardController::class,'index'])->name('dashboard');
});
