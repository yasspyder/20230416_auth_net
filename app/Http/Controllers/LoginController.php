<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginVK()
    {
        return Socialite::with('vkontakte')->redirect();
    }

    public function responseVK(UserRepository $userRepository)
    {
        if (Auth::id()) {
            return redirect()->route('home');
        }

        $user = Socialite::driver('vkontakte')->user();
        session(['soc_token' => $user->token]);
        $userInSystem = $userRepository->getUserBySocId($user, 'vk');
        Auth::login($userInSystem);
        return redirect()->back();
    }

    public function loginYandex()
    {
        return Socialite::with('yandex')->redirect();
    }

    public function responseYandex(UserRepository $userRepository)
    {
        if (Auth::id()) {
            return redirect()->route('home');
        }

        $user = Socialite::driver('yandex')->user();
        session(['soc_token' => $user->token]);
        $userInSystem = $userRepository->getUserBySocId($user, 'yandex');
        Auth::login($userInSystem);
        return redirect()->back();
    }

}
