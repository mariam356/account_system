<?php
use Illuminate\Support\Facades\Route;

//----------------------stores--------------------------------


Route::get('/stores', [\App\Http\Controllers\StoreController::class,'index'])->name('stores')->middleware('can:show stores');
Route::get('/stores/show', [\App\Http\Controllers\StoreController::class,'show'])->name('stores.show')->middleware('can:show stores');
Route::post('/stores/store', [\App\Http\Controllers\StoreController::class,'store'])->name('stores.store')->middleware('can:create stores');
Route::get('/stores/edit/{id}', [\App\Http\Controllers\StoreController::class,'edit'])->name('stores.edit')->middleware('can:update stores');
Route::post('/stores/update/{id}', [\App\Http\Controllers\StoreController::class,'update'])->name('stores.update')->middleware('can:update stores');
Route::delete('/stores/destroy/{id}', [\App\Http\Controllers\StoreController::class,'destroy'])->name('stores.destroy')->middleware('can:delete stores');
Route::get('/stores/search', [\App\Http\Controllers\StoreController::class,'search'])->name('stores.search');


//----------------------categories--------------------------------


Route::get('/categories', [\App\Http\Controllers\CategoryController::class,'index'])->name('categories')->middleware('can:show categories');
Route::get('/categories/show', [\App\Http\Controllers\CategoryController::class,'show'])->name('categories.show')->middleware('can:show categories');
Route::post('/categories/store', [\App\Http\Controllers\CategoryController::class,'store'])->name('categories.store')->middleware('can:create categories');
Route::get('/categories/edit/{id}', [\App\Http\Controllers\CategoryController::class,'edit'])->name('categories.edit')->middleware('can:update categories');
Route::post('/categories/update/{id}', [\App\Http\Controllers\CategoryController::class,'update'])->name('categories.update')->middleware('can:update categories');
Route::delete('/categories/destroy/{id}', [\App\Http\Controllers\CategoryController::class,'destroy'])->name('categories.destroy')->middleware('can:delete categories');
Route::get('/categories/search', [\App\Http\Controllers\CategoryController::class,'search'])->name('categories.search');


//----------------------units--------------------------------


Route::get('/units', [\App\Http\Controllers\UnitController::class,'index'])->name('units')->middleware('can:show units');
Route::get('/units/show', [\App\Http\Controllers\UnitController::class,'show'])->name('units.show')->middleware('can:show units');
Route::post('/units/store', [\App\Http\Controllers\UnitController::class,'store'])->name('units.store')->middleware('can:create units');
Route::get('/units/edit/{id}', [\App\Http\Controllers\UnitController::class,'edit'])->name('units.edit')->middleware('can:update units');
Route::post('/units/update/{id}', [\App\Http\Controllers\UnitController::class,'update'])->name('units.update')->middleware('can:update units');
Route::delete('/units/destroy/{id}', [\App\Http\Controllers\UnitController::class,'destroy'])->name('units.destroy')->middleware('can:delete units');
Route::get('/units/search', [\App\Http\Controllers\UnitController::class,'search'])->name('units.search');


//----------------------product--------------------------------


Route::get('/product', [\App\Http\Controllers\ProductController::class,'index'])->name('product')->middleware('can:show product');
Route::get('/product/show', [\App\Http\Controllers\ProductController::class,'show'])->name('product.show')->middleware('can:show product');
Route::post('/product/store', [\App\Http\Controllers\ProductController::class,'store'])->name('product.store')->middleware('can:create product');
Route::get('/product/edit/{id}', [\App\Http\Controllers\ProductController::class,'edit'])->name('product.edit')->middleware('can:update product');
Route::post('/product/update/{id}', [\App\Http\Controllers\ProductController::class,'update'])->name('product.update')->middleware('can:update product');
Route::delete('/product/destroy/{id}', [\App\Http\Controllers\ProductController::class,'destroy'])->name('product.destroy')->middleware('can:delete product');
Route::get('/product/search', [\App\Http\Controllers\ProductController::class,'search'])->name('product.search');


//----------------------inventory_management--------------------------------


Route::get('/inventory_management', [\App\Http\Controllers\InventoryController::class,'index'])->name('inventory_management')->middleware('can:show inventory_management');
Route::get('/inventory_management/show', [\App\Http\Controllers\InventoryController::class,'show'])->name('inventory_management.show')->middleware('can:show inventory_management');
Route::post('/inventory_management/store', [\App\Http\Controllers\InventoryController::class,'store'])->name('inventory_management.store')->middleware('can:update inventory_management');

Route::get('/inventory_management/search', [\App\Http\Controllers\InventoryController::class,'search'])->name('inventory_management.search');

//----------------------category_movement--------------------------------


Route::get('/category_movement', [\App\Http\Controllers\CategoryMovementController::class,'index'])->name('category_movement')->middleware('can:show category_movement');
Route::get('/category_movement/show', [\App\Http\Controllers\CategoryMovementController::class,'show'])->name('category_movement.show')->middleware('can:show category_movement');

Route::get('/category_movement/search', [\App\Http\Controllers\CategoryMovementController::class,'search'])->name('category_movement.search');
