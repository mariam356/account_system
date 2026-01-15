<?php
use Illuminate\Support\Facades\Route;
//-----------------------------route Who_are_we---------------------------------



Route::get('/Who_are_we', [\App\Http\Controllers\WhoAreWeController::class,'index'])->name('Who_are_we');
