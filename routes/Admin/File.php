<?php

//----------------------user--------------------------------


Route::get('/user', [\App\Http\Controllers\UserController::class,'index'])->name('user')->middleware('can:show user');
Route::post('/user/store', [\App\Http\Controllers\UserController::class,'store'])->name('user.store')->middleware('can:create user');
Route::get('/user/edit/{id}', [\App\Http\Controllers\UserController::class,'edit'])->name('user.edit')->middleware('can:update user');
Route::post('/user/update/{id}', [\App\Http\Controllers\UserController::class,'update'])->name('user.update')->middleware('can:update user');
Route::delete('/user/destroy/{id}', [\App\Http\Controllers\UserController::class,'destroy'])->name('user.destroy')->middleware('can:delete user');
Route::get('/user/search', [\App\Http\Controllers\UserController::class,'search'])->name('user.search');


//----------------------permission--------------------------------
Route::get('/permission', [\App\Http\Controllers\PermissionController::class,'index'])->name('permission')->middleware('can:show permission');
Route::get('/permission/display', [\App\Http\Controllers\PermissionController::class,'display'])->name('permission.display')->middleware('can:show permission');
Route::get('/permission/create', [\App\Http\Controllers\PermissionController::class,'create'])->name('permission.create')->middleware('can:create permission');
Route::post('/permission/store', [\App\Http\Controllers\PermissionController::class,'store'])->name('permission.store')->middleware('can:create permission');
Route::get('/permission/edit/{id}', [\App\Http\Controllers\PermissionController::class,'edit'])->name('permission.edit')->middleware('can:update permission');
Route::post('/permission/update/{id}', [\App\Http\Controllers\PermissionController::class,'update'])->name('permission.update')->middleware('can:update permission');
Route::get('/permission/show/{id}', [\App\Http\Controllers\PermissionController::class,'show'])->name('permission.show')->middleware('can:show permission');
Route::delete('/permission/destroy/{id}', [\App\Http\Controllers\PermissionController::class,'destroy'])->name('permission.destroy')->middleware('can:delete permission');
Route::get('/permission/search', [\App\Http\Controllers\PermissionController::class,'search'])->name('permission.search')->middleware('can:show permission');


//----------------------backup--------------------------------


Route::get('/backup', [\App\Http\Controllers\BackUpController::class,'index'])->name('backup')->middleware('can:show backup');
Route::post('/backup/store', [\App\Http\Controllers\BackUpController::class,'backup'])->name('backup.store')->middleware('can:create backup');
