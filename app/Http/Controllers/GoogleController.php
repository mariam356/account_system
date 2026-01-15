<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    // توجيه المستخدم إلى Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // استقبال البيانات من Google
    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName(),
                'full_name'=> $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(Str::random(24)),
                'google_id' => $googleUser->getId(),
            ]);
        }

        Auth::login($user);

        return redirect('/home');
    }
}
