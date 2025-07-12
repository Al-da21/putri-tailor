<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cari user berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Jika belum ada, buat user baru
                $user = User::create([
                    'id' => Str::uuid(),
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(16)), // random password
                    'roles' => 'User',
                ]);
            }

            Auth::login($user, true);

            if ($user->name === 'admin') {
                return redirect('admin/dashboard');
            }

            return redirect('/');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['google' => 'Gagal login dengan Google.']);
        }
    }
}
