<?php


//-----------------------------route accounting_guide---------------------------------

Route::get('/account', [\App\Http\Controllers\AccountController::class,'index'])->name('account')->middleware('can:show account');
Route::get('account/tree-building', [\App\Http\Controllers\AccountController::class,'treeBuilding'])->name('account.treeBuilding')->middleware('can:show account');
Route::post('account/store', [\App\Http\Controllers\AccountController::class,'store'])->name('account.store')->middleware('can:create account');
Route::post('account/update', [\App\Http\Controllers\AccountController::class,'update'])->name('account.update')->middleware('can:update account');
Route::get('account/edit/{id}', [\App\Http\Controllers\AccountController::class,'edit'])->name('account.edit')->middleware('can:update account');
Route::delete('account/destroy', [\App\Http\Controllers\AccountController::class,'destroy'])->name('account.destroy')->middleware('can:delete account');
// report ------------------
Route::get('account/report', [\App\Http\Controllers\AccountReportController::class,'index'])->name('account.report')->middleware('can:report account');
Route::get('account/report_export', [\App\Http\Controllers\AccountReportController::class,'reportExport'])->name('account.report_export')->middleware('can:report account');
Route::get('account/export', [\App\Http\Controllers\AccountReportController::class,'export'])->name('account.export');
Route::get('/account/search', [\App\Http\Controllers\AccountReportController::class,'search'])->name('account.search');
Route::get('/account/show', [\App\Http\Controllers\AccountReportController::class,'show'])->name('account.show');
Route::get('account/exportExcel', [\App\Http\Controllers\AccountReportController::class,'exportExcel'])->name('account.exportExcel');


//-----------------------------route Journal---------------------------------

Route::get('/journal', [\App\Http\Controllers\JournalController::class,'index'])->name('journal')->middleware('can:show journal');
Route::get('journal/create', [\App\Http\Controllers\JournalController::class,'create'])->name('journal.create')->middleware('can:create journal');
Route::post('journal/store', [\App\Http\Controllers\JournalController::class,'store'])->name('journal.store')->middleware('can:create journal');
Route::post('journal/update/{id}', [\App\Http\Controllers\JournalController::class,'update'])->name('journal.update')->middleware('can:update journal');
Route::get('journal/edit/{id}', [\App\Http\Controllers\JournalController::class,'edit'])->name('journal.edit')->middleware('can:update journal');
Route::delete('journal/destroy/{id}', [\App\Http\Controllers\JournalController::class,'destroy'])->name('journal.destroy')->middleware('can:delete journal');
Route::get('/journal/search', [\App\Http\Controllers\JournalController::class,'search'])->name('journal.search');
Route::get('/journal/show', [\App\Http\Controllers\JournalController::class,'show'])->name('journal.show');
Route::get('/journal/falter_curr_val/{id}', [\App\Http\Controllers\JournalController::class,'falterCurrVal'])->name('journal.falter_curr_val');
Route::delete('journal/details/delete/{id}', [\App\Http\Controllers\JournalController::class,'delete'])->name('journal.details.destroy')->middleware('can:delete journal');
// report ------------------
Route::get('journal/report', [\App\Http\Controllers\JournalReportController::class,'index'])->name('journal.report')->middleware('can:report journal');
Route::get('journal/report_export', [\App\Http\Controllers\JournalReportController::class,'reportExport'])->name('journal.report_export')->middleware('can:report journal');
Route::get('journal/export', [\App\Http\Controllers\JournalReportController::class,'export'])->name('journal.export');

Route::get('/journal/show/report', [\App\Http\Controllers\JournalReportController::class,'show'])->name('journal.show');
Route::get('journal/exportExcel', [\App\Http\Controllers\JournalReportController::class,'exportExcel'])->name('journal.exportExcel');

//-----------------------------route exchange_bond---------------------------------

Route::get('/exchange_bond', [\App\Http\Controllers\ExchangeBondController::class,'index'])->name('exchange_bond')->middleware('can:show exchange_bond');
Route::get('exchange_bond/create', [\App\Http\Controllers\ExchangeBondController::class,'create'])->name('exchange_bond.create')->middleware('can:create exchange_bond');
Route::post('exchange_bond/store', [\App\Http\Controllers\ExchangeBondController::class,'store'])->name('exchange_bond.store')->middleware('can:create exchange_bond');
Route::post('exchange_bond/update/{id}', [\App\Http\Controllers\ExchangeBondController::class,'update'])->name('exchange_bond.update')->middleware('can:update exchange_bond');
Route::get('exchange_bond/edit/{id}', [\App\Http\Controllers\ExchangeBondController::class,'edit'])->name('exchange_bond.edit')->middleware('can:update exchange_bond');
Route::delete('exchange_bond/destroy/{id}', [\App\Http\Controllers\ExchangeBondController::class,'destroy'])->name('exchange_bond.destroy')->middleware('can:delete exchange_bond');
Route::get('/exchange_bond/search', [\App\Http\Controllers\ExchangeBondController::class,'search'])->name('exchange_bond.search');
Route::get('/exchange_bond/show', [\App\Http\Controllers\ExchangeBondController::class,'show'])->name('exchange_bond.show');
Route::get('/exchange_bond/falter_curr_val/{id}', [\App\Http\Controllers\ExchangeBondController::class,'falterCurrVal'])->name('exchange_bond.falter_curr_val');
Route::delete('exchange_bond/details/delete/{id}', [\App\Http\Controllers\ExchangeBondController::class,'delete'])->name('exchange_bond.details.destroy')->middleware('can:delete exchange_bond');

// report ------------------
Route::get('exchange_bond/report', [\App\Http\Controllers\ExchangeBondReportController::class,'index'])->name('exchange_bond.report')->middleware('can:report exchange_bond');
Route::get('exchange_bond/report_export', [\App\Http\Controllers\ExchangeBondReportController::class,'reportExport'])->name('exchange_bond.report_export')->middleware('can:report exchange_bond');
Route::get('exchange_bond/export', [\App\Http\Controllers\ExchangeBondReportController::class,'export'])->name('exchange_bond.export');
Route::get('/exchange_bond/show/report', [\App\Http\Controllers\ExchangeBondReportController::class,'show'])->name('exchange_bond.show');
Route::get('exchange_bond/exportExcel', [\App\Http\Controllers\ExchangeBondReportController::class,'exportExcel'])->name('exchange_bond.exportExcel');


//-----------------------------route receive_bond---------------------------------

Route::get('/receive_bond', [\App\Http\Controllers\ReceiveBondController::class,'index'])->name('receive_bond')->middleware('can:show receive_bond');
Route::get('receive_bond/create', [\App\Http\Controllers\ReceiveBondController::class,'create'])->name('receive_bond.create')->middleware('can:create receive_bond');
Route::post('receive_bond/store', [\App\Http\Controllers\ReceiveBondController::class,'store'])->name('receive_bond.store')->middleware('can:create receive_bond');
Route::post('receive_bond/update/{id}', [\App\Http\Controllers\ReceiveBondController::class,'update'])->name('receive_bond.update')->middleware('can:update receive_bond');
Route::get('receive_bond/edit/{id}', [\App\Http\Controllers\ReceiveBondController::class,'edit'])->name('receive_bond.edit')->middleware('can:update receive_bond');
Route::delete('receive_bond/destroy/{id}', [\App\Http\Controllers\ReceiveBondController::class,'destroy'])->name('receive_bond.destroy')->middleware('can:delete receive_bond');
Route::get('/receive_bond/search', [\App\Http\Controllers\ReceiveBondController::class,'search'])->name('receive_bond.search');
Route::get('/receive_bond/show', [\App\Http\Controllers\ReceiveBondController::class,'show'])->name('receive_bond.show');
Route::get('/receive_bond/falter_curr_val/{id}', [\App\Http\Controllers\ReceiveBondController::class,'falterCurrVal'])->name('receive_bond.falter_curr_val');
Route::delete('receive_bond/details/delete/{id}', [\App\Http\Controllers\ReceiveBondController::class,'delete'])->name('receive_bond.details.destroy')->middleware('can:delete receive_bond');

// report ------------------
Route::get('receive_bond/report', [\App\Http\Controllers\ReceiveBondReportController::class,'index'])->name('receive_bond.report')->middleware('can:report receive_bond');
Route::get('receive_bond/report_export', [\App\Http\Controllers\ReceiveBondReportController::class,'reportExport'])->name('receive_bond.report_export')->middleware('can:report receive_bond');
Route::get('receive_bond/export', [\App\Http\Controllers\ReceiveBondReportController::class,'export'])->name('receive_bond.export');
Route::get('/receive_bond/show/report', [\App\Http\Controllers\ReceiveBondReportController::class,'show'])->name('receive_bond.show');
Route::get('receive_bond/exportExcel', [\App\Http\Controllers\ReceiveBondReportController::class,'exportExcel'])->name('receive_bond.exportExcel');



//-----------------------------route account_statement---------------------------------

Route::get('/account_statement', [\App\Http\Controllers\AccountStatementController::class,'index'])->name('account_statement')->middleware('can:show account_statement');
Route::get('account_statement/search', [\App\Http\Controllers\AccountStatementController::class,'search'])->name('account_statement.search')->middleware('can:show account_statement');
// report ------------------

Route::get('account_statement/report_export', [\App\Http\Controllers\AccountStatementController::class,'reportExport'])->name('account_statement.report_export')->middleware('can:report account_statement');
Route::get('account_statement/export', [\App\Http\Controllers\AccountStatementController::class,'export'])->name('account_statement.export');
Route::get('account_statement/exportExcel', [\App\Http\Controllers\AccountStatementController::class,'exportExcel'])->name('account_statement.exportExcel');

//-----------------------------route trial_balance---------------------------------

Route::get('/trial_balance', [\App\Http\Controllers\TrialBalanceController::class,'index'])->name('trial_balance')->middleware('can:show trial_balance');
Route::get('trial_balance/search', [\App\Http\Controllers\TrialBalanceController::class,'search'])->name('trial_balance.search')->middleware('can:show trial_balance');

// report ------------------

Route::get('trial_balance/report_export', [\App\Http\Controllers\TrialBalanceController::class,'reportExport'])->name('trial_balance.report_export')->middleware('can:report trial_balance');
Route::get('trial_balance/export', [\App\Http\Controllers\TrialBalanceController::class,'export'])->name('trial_balance.export');
Route::get('trial_balance/exportExcel', [\App\Http\Controllers\TrialBalanceController::class,'exportExcel'])->name('trial_balance.exportExcel');

//-----------------------------route balance_sheet---------------------------------

Route::get('/balance_sheet', [\App\Http\Controllers\BalanceSheetController::class,'index'])->name('balance_sheet')->middleware('can:show balance_sheet');
Route::get('balance_sheet/search', [\App\Http\Controllers\BalanceSheetController::class,'search'])->name('balance_sheet.search')->middleware('can:show balance_sheet');

// report ------------------

Route::get('balance_sheet/report_export', [\App\Http\Controllers\BalanceSheetController::class,'reportExport'])->name('balance_sheet.report_export')->middleware('can:report balance_sheet');
Route::get('balance_sheet/export', [\App\Http\Controllers\BalanceSheetController::class,'export'])->name('balance_sheet.export');
Route::get('balance_sheet/exportExcel', [\App\Http\Controllers\BalanceSheetController::class,'exportExcel'])->name('balance_sheet.exportExcel');

//-----------------------------route profit_loss---------------------------------

Route::get('/profit_loss', [\App\Http\Controllers\ProfitLossController::class,'index'])->name('profit_loss')->middleware('can:show profit_loss');
Route::get('profit_loss/search', [\App\Http\Controllers\ProfitLossController::class,'search'])->name('profit_loss.search')->middleware('can:show profit_loss');

// report ------------------

Route::get('profit_loss/report_export', [\App\Http\Controllers\ProfitLossController::class,'reportExport'])->name('profit_loss.report_export')->middleware('can:report profit_loss');
Route::get('profit_loss/export', [\App\Http\Controllers\ProfitLossController::class,'export'])->name('profit_loss.export');
Route::get('profit_loss/exportExcel', [\App\Http\Controllers\ProfitLossController::class,'exportExcel'])->name('profit_loss.exportExcel');
