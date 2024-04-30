<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleCallback($provider)
    {
        try {
            $SocialUser = Socialite::driver($provider)->user();

            // Створення або оновлення користувача
            $user = User::where([
                'provider' => $provider,
                'provider_id' => $SocialUser->getId(),
            ])->first();

            if (!$user){
                // Якщо користувача не існує з цим провайдером
                $user = User::where('email', $SocialUser->email)->where('provider', null)->first();
                if($user){

                    $user->update([
                        'provider' => $provider,
                        'provider_id' => $SocialUser->getId(),
                        'provider_token' => $SocialUser->token,
                    ]);
                }elseif(User::where('email', $SocialUser->email)->where('provider', !null)->exists()){
                    return redirect()->route('login')->withErrors( 'social', 'Ви використовуєте іншу службу для входу.');
                }else{
                    $user = User::create([
                        'name' => $SocialUser->name,
                        'email' => $SocialUser->email,
                        'provider' => $provider,
                        'provider_id' => $SocialUser->getId(),
                        'provider_token' => $SocialUser->token,
                        'email_verified_at' => now(),
                        'password' => Hash::make('svitlo'. $SocialUser->getId()),
                    ]);
                }




            }


            Auth::login($user);

            return redirect('/dashboard');
        } catch (Exception $e) {
            return view('auth.login', ['error' => 'Не вдалося увійти через ' . $provider . '. Ви використовуєте іншу службу для входу.']);

        }
    }



}
