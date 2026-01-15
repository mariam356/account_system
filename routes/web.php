<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

Route::get('/locale/{lang}', [LocalizationController::class, 'switchLanguage']);

Route::get('/auth/google', [GoogleController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

Auth::routes();
Route::middleware([
    'auth:user',

])->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
    Route::post('/send-mail', [MailController::class, 'send'])->name('send-mail');

    Route::get('/chat/{userId?}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'store'])->name('chat.send');
    Route::get('/chat/messages/{userId}', [ChatController::class, 'getMessages'])
        ->name('chat.messages');

    Route::group(['prefix' => 'system_setting'], function () {
        require_once __DIR__ . '/Admin/SystemSetting.php';
    });


    Route::group(['prefix' => 'file'], function () {
        require_once __DIR__ . '/Admin/File.php';
    });

    Route::group(['prefix' => 'accounts'], function () {
        require_once __DIR__ . '/Admin/Account.php';
    });

    Route::group(['prefix' => 'stores'], function () {
        require_once __DIR__ . '/Admin/Stores.php';
    });

    Route::group(['prefix' => 'purchases'], function () {
        require_once __DIR__ . '/Admin/Purchases.php';
    });

    Route::group(['prefix' => 'sales'], function () {
        require_once __DIR__ . '/Admin/Sales.php';
    });

    Route::group(['prefix' => 'about_us'], function () {
        require_once __DIR__ . '/Admin/AboutUs.php';
    });

    Route::group(['prefix' => 'profile_management'], function () {
        require_once __DIR__ . '/Admin/profile-management-web.php';
    });

});
