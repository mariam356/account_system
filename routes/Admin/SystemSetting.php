<?php


use Illuminate\Support\Facades\Route;

//----------------------branch--------------------------------
Route::get('/branch', [\App\Http\Controllers\BranchController::class,'index'])->name('branch')->middleware('can:show branch');
Route::get('/branch/show', [\App\Http\Controllers\BranchController::class,'show'])->name('branch.show')->middleware('can:show branch');
Route::post('/branch/store', [\App\Http\Controllers\BranchController::class,'store'])->name('branch.store')->middleware('can:create branch');
Route::get('/branch/edit/{id}', [\App\Http\Controllers\BranchController::class,'edit'])->name('branch.edit')->middleware('can:update branch');
Route::post('/branch/update/{id}', [\App\Http\Controllers\BranchController::class,'update'])->name('branch.update')->middleware('can:update branch');
Route::delete('/branch/destroy/{id}', [\App\Http\Controllers\BranchController::class,'destroy'])->name('branch.destroy')->middleware('can:delete branch');
Route::get('/branch/search', [\App\Http\Controllers\BranchController::class,'search'])->name('branch.search');

//----------------------fund--------------------------------
Route::get('/fund', [\App\Http\Controllers\FundController::class,'index'])->name('fund')->middleware('can:show fund');
Route::post('/fund/store', [\App\Http\Controllers\FundController::class,'store'])->name('fund.store')->middleware('can:create fund');
Route::get('/fund/edit/{id}', [\App\Http\Controllers\FundController::class,'edit'])->name('fund.edit')->middleware('can:update fund');
Route::post('/fund/update/{id}', [\App\Http\Controllers\FundController::class,'update'])->name('fund.update')->middleware('can:update fund');
Route::delete('/fund/destroy/{id}', [\App\Http\Controllers\FundController::class,'destroy'])->name('fund.destroy')->middleware('can:delete fund');
Route::get('/fund/search', [\App\Http\Controllers\FundController::class,'search'])->name('fund.search');

//----------------------bank--------------------------------
Route::get('/bank', [\App\Http\Controllers\BankController::class,'index'])->name('bank')->middleware('can:show bank');
Route::post('/bank/store', [\App\Http\Controllers\BankController::class,'store'])->name('bank.store')->middleware('can:create bank');
Route::get('/bank/edit/{id}', [\App\Http\Controllers\BankController::class,'edit'])->name('bank.edit')->middleware('can:update bank');
Route::post('/bank/update/{id}', [\App\Http\Controllers\BankController::class,'update'])->name('bank.update')->middleware('can:update bank');
Route::delete('/bank/destroy/{id}', [\App\Http\Controllers\BankController::class,'destroy'])->name('bank.destroy')->middleware('can:delete bank');
Route::get('/bank/search', [\App\Http\Controllers\BankController::class,'search'])->name('bank.search');



//----------------------currency--------------------------------
Route::get('/currency', [\App\Http\Controllers\CurrencyController::class,'index'])->name('currency')->middleware('can:show currency');
Route::post('/currency/store', [\App\Http\Controllers\CurrencyController::class,'store'])->name('currency.store')->middleware('can:create currency');
Route::get('/currency/edit/{id}', [\App\Http\Controllers\CurrencyController::class,'edit'])->name('currency.edit')->middleware('can:update currency');
Route::post('/currency/update/{id}', [\App\Http\Controllers\CurrencyController::class,'update'])->name('currency.update')->middleware('can:update currency');
Route::delete('/currency/destroy/{id}', [\App\Http\Controllers\CurrencyController::class,'destroy'])->name('currency.destroy')->middleware('can:delete currency');
Route::get('/currency/search', [\App\Http\Controllers\CurrencyController::class,'search'])->name('currency.search');
