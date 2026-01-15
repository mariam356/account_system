<?php

namespace App\Providers;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str; // <--- مهم

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        view()->composer('*', function ($view) {
            if (auth()->check()) {
                $data = Message::where('user_id', auth()->id())
                    ->where('is_read', 'false')
                    ->latest()
                    ->get();

                $view->with([
                    'messages' => $data,
                    'messages_count' => $data->count()
                ]);
            } else {
                $view->with([
                    'messages' => collect(),
                    'messages_count' => 0
                ]);
            }
        });
    }

}
