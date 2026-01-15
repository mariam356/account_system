<?php

use Illuminate\Support\Facades\Route;
//----------------------branch--------------------------------


Route::get('/suppliers', [\App\Http\Controllers\SupplierController::class,'index'])->name('suppliers')->middleware('can:show suppliers');
Route::get('/suppliers/show', [\App\Http\Controllers\SupplierController::class,'show'])->name('suppliers.show')->middleware('can:show suppliers');
Route::post('/suppliers/store', [\App\Http\Controllers\SupplierController::class,'store'])->name('suppliers.store')->middleware('can:create suppliers');
Route::get('/suppliers/edit/{id}', [\App\Http\Controllers\SupplierController::class,'edit'])->name('suppliers.edit')->middleware('can:update suppliers');
Route::post('/suppliers/update/{id}', [\App\Http\Controllers\SupplierController::class,'update'])->name('suppliers.update')->middleware('can:update suppliers');
Route::delete('/suppliers/destroy/{id}', [\App\Http\Controllers\SupplierController::class,'destroy'])->name('suppliers.destroy')->middleware('can:delete suppliers');
Route::get('/suppliers/search', [\App\Http\Controllers\SupplierController::class,'search'])->name('suppliers.search');


//-----------------------------route purchases_invoice---------------------------------

Route::get('/purchases_invoice', [\App\Http\Controllers\PurchasesInvoiceController::class,'index'])->name('purchases_invoice')->middleware('can:show purchases_invoice');
Route::get('purchases_invoice/create', [\App\Http\Controllers\PurchasesInvoiceController::class,'create'])->name('purchases_invoice.create')->middleware('can:create purchases_invoice');
Route::post('purchases_invoice/store', [\App\Http\Controllers\PurchasesInvoiceController::class,'store'])->name('purchases_invoice.store')->middleware('can:create purchases_invoice');
Route::post('purchases_invoice/update/{id}', [\App\Http\Controllers\PurchasesInvoiceController::class,'update'])->name('purchases_invoice.update')->middleware('can:update purchases_invoice');
Route::get('purchases_invoice/edit/{id}', [\App\Http\Controllers\PurchasesInvoiceController::class,'edit'])->name('purchases_invoice.edit')->middleware('can:update purchases_invoice');
Route::delete('purchases_invoice/destroy/{id}', [\App\Http\Controllers\PurchasesInvoiceController::class,'destroy'])->name('purchases_invoice.destroy')->middleware('can:delete purchases_invoice');
Route::get('/purchases_invoice/search', [\App\Http\Controllers\PurchasesInvoiceController::class,'search'])->name('purchases_invoice.search');
Route::get('/purchases_invoice/show', [\App\Http\Controllers\PurchasesInvoiceController::class,'show'])->name('purchases_invoice.show');
Route::get('/purchases_invoice/falter_curr_val/{id}', [\App\Http\Controllers\PurchasesInvoiceController::class,'falterCurrVal'])->name('purchases_invoice.falter_curr_val');
Route::delete('purchases_invoice/details/delete/{id}', [\App\Http\Controllers\PurchasesInvoiceController::class,'delete'])->name('purchases_invoice.details.destroy')->middleware('can:delete journal');

