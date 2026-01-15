<?php


/*
|--------------------------------------------------------------------------
| Web Routes Admin
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| Prefix providers_management.
|
*/

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//route profile start

Route::get('/profile', [ProfileController::class,'index'])->name('profile');
Route::get('/profile/delete_image', [ProfileController::class,'delete_image'])->name('profile.delete_image');
Route::post('/profile/edit_image', [ProfileController::class,'edit_image'])->name('profile.edit_image');
Route::get('/profile/edit/{id}', [ProfileController::class,'edit'])->name('profile.edit');
Route::get('/profile/edit_password/{id}', [ProfileController::class,'edit_password'])->name('profile.edit_password');
Route::post('/profile/update', [ProfileController::class,'update'])->name('profile.update');
Route::post('/profile/update_password/{id}', [ProfileController::class,'update_password'])->name('profile.update_password');
Route::post('/profile/hdelete/{id}', [ProfileController::class,'update_password'])->name('profile.hdelete');
//route profile end

