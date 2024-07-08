<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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

            dd($gUser);
            /** Jika Belum punya akun */
            // $register = User::create([
            //     'uuid'          => Str::uuid(),
            //     'first_name'    => $request->get('first-name'),
            //     'last_name'     => $request->get('last-name'),
            //     'username'      => Str::lower($request->get('first-name') . "_" . $request->get('last-name')),
            //     'email'         => $request->get('email'),
            //     'password'      => Hash::make($request->get('password')),
            //     'referral'      => Str::random(10),
            //     'crated_at '    => date("Y-m-d H:i:s")
            // ]);
    
            // if(!$register) {
            //     return redirect()->route('register')->withInput($request->all())->withErrors($validate->errors())->with('email', "System mainctance");
            // }

        } catch (Exception $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }
    }
}
