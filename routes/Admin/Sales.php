<?php

use Illuminate\Support\Facades\Route;
//----------------------customer--------------------------------

Route::get('/customer', [\App\Http\Controllers\CustomerController::class,'index'])->name('customer')->middleware('can:show customer');
Route::get('/customer/show', [\App\Http\Controllers\CustomerController::class,'show'])->name('customer.show')->middleware('can:show customer');
Route::post('/customer/store', [\App\Http\Controllers\CustomerController::class,'store'])->name('customer.store')->middleware('can:create customer');
Route::get('/customer/edit/{id}', [\App\Http\Controllers\CustomerController::class,'edit'])->name('customer.edit')->middleware('can:update customer');
Route::post('/customer/update/{id}', [\App\Http\Controllers\CustomerController::class,'update'])->name('customer.update')->middleware('can:update customer');
Route::delete('/customer/destroy/{id}', [\App\Http\Controllers\CustomerController::class,'destroy'])->name('customer.destroy')->middleware('can:delete customer');
Route::get('/customer/search', [\App\Http\Controllers\CustomerController::class,'search'])->name('customer.search');


//----------------------sale_representative--------------------------------

Route::get('/sale_representative', [\App\Http\Controllers\SaleRepresentativesController::class,'index'])->name('sale_representative')->middleware('can:show sale_representative');
Route::get('/sale_representative/show', [\App\Http\Controllers\SaleRepresentativesController::class,'show'])->name('sale_representative.show')->middleware('can:show sale_representative');
Route::post('/sale_representative/store', [\App\Http\Controllers\SaleRepresentativesController::class,'store'])->name('sale_representative.store')->middleware('can:create sale_representative');
Route::get('/sale_representative/edit/{id}', [\App\Http\Controllers\SaleRepresentativesController::class,'edit'])->name('sale_representative.edit')->middleware('can:update sale_representative');
Route::post('/sale_representative/update/{id}', [\App\Http\Controllers\SaleRepresentativesController::class,'update'])->name('sale_representative.update')->middleware('can:update sale_representative');
Route::delete('/sale_representative/destroy/{id}', [\App\Http\Controllers\SaleRepresentativesController::class,'destroy'])->name('sale_representative.destroy')->middleware('can:delete sale_representative');
Route::get('/sale_representative/search', [\App\Http\Controllers\SaleRepresentativesController::class,'search'])->name('sale_representative.search');


//-----------------------------route sales_invoice---------------------------------

Route::get('/sales_invoice', [\App\Http\Controllers\SalesInvoiceController::class,'index'])->name('sales_invoice')->middleware('can:show sales_invoice');
Route::get('sales_invoice/create', [\App\Http\Controllers\SalesInvoiceController::class,'create'])->name('sales_invoice.create')->middleware('can:create sales_invoice');
Route::post('sales_invoice/store', [\App\Http\Controllers\SalesInvoiceController::class,'store'])->name('sales_invoice.store')->middleware('can:create sales_invoice');
Route::post('sales_invoice/update/{id}', [\App\Http\Controllers\SalesInvoiceController::class,'update'])->name('sales_invoice.update')->middleware('can:update sales_invoice');
Route::get('sales_invoice/edit/{id}', [\App\Http\Controllers\SalesInvoiceController::class,'edit'])->name('sales_invoice.edit')->middleware('can:update sales_invoice');
Route::delete('sales_invoice/destroy/{id}', [\App\Http\Controllers\SalesInvoiceController::class,'destroy'])->name('sales_invoice.destroy')->middleware('can:delete sales_invoice');
Route::get('/sales_invoice/search', [\App\Http\Controllers\SalesInvoiceController::class,'search'])->name('sales_invoice.search');
Route::get('/sales_invoice/show', [\App\Http\Controllers\SalesInvoiceController::class,'show'])->name('sales_invoice.show');
Route::get('/sales_invoice/falter_curr_val/{id}', [\App\Http\Controllers\SalesInvoiceController::class,'falterCurrVal'])->name('sales_invoice.falter_curr_val');
Route::delete('sales_invoice/details/delete/{id}', [\App\Http\Controllers\SalesInvoiceController::class,'delete'])->name('sales_invoice.details.destroy')->middleware('can:delete sales_invoice');

