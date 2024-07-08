<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class OauthGoogleController extends Controller
{
    public function index() {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback() {
        try {
            $gUser = Socialite::driver('google')->user();
            $findUser = User::where("gauth_id", $gUser->id)->first();

            if($findUser) {
                session()->regenerate();
                $user   = Auth::user();
                return redirect()->route( "dashboard" )->with("success", "Selamat datang kembali {$user->first_name}");
            }

            /** Jika Belum punya akun */
            $register = User::create([
                'uuid'          => Str::uuid(),
                'first_name'    => $gUser->user['given_name'],
                'last_name'     => $gUser->user['family_name'],
                'username'      => Str::snake(Str::lower($gUser->user['given_name'] . "_" . $gUser->user['family_name'])),
                'email'         => $gUser->email,
                'password'      => Hash::make($gUser->id),
                'referral'      => Str::random(10),
                'crated_at '    => date("Y-m-d H:i:s")
            ]);
    
            if(!$register) {
                $input  = [
                    'first-name'    => $gUser->user['given_name'],
                    'last-name'     => $gUser->user['family_name'],
                    'email'         => $gUser->email,
                ];

                return redirect()->route('register')->withInput($input)->with('danger', "Mohon registrasi manual");
            }

            return redirect()->route('login')->with('success', "Berhasil didaftarkan, mohon login");


        } catch (Exception $e) {
            return redirect()->route('login')->with('danger', "[EXCEPTION] Code: " . $e->getCode());
        }
    }
}
