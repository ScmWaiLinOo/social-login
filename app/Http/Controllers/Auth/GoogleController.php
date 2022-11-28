<?php

namespace App\Http\Controllers\Auth;

use Throwable;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the gmail authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

/**
 * Login with gmail function
 *
 * @return \Illuminate\Http\Response
 */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::where('google_id', $googleUser->id)->first();

            if (!$user) {
                $user = new User();
                $user->name = $googleUser->name;
                $user->email = $googleUser->email;
                $user->google_id = $googleUser->id;
                $user->email_verified_at = now();
                $user->save();
            }

            event(new Registered($user));

            Auth::login($user);

            return redirect()->intended(RouteServiceProvider::HOME);

        } catch (Throwable $th) {
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '[line: ' . __LINE__ . '][Login Fail] Message: ' . $th->getMessage());
            return redirect()->route('auth.google');
        }
    }
}
