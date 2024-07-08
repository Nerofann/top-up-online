<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function throttleKey(Request $request)
    {
        return Str::transliterate(Str::lower($request->get('email')) . "|" . $request->ip());
    }

    public function do_login(Request $request)
    {
        $validate = Validator::make($request->only(['email', 'password']), [
            'email'     => ['required', 'string', 'email', 'exists:users,email'],
            'password'  => ['required', 'string']
        ]);

        if($validate->fails()) {
            return redirect()->route('login')->withInput($request->all())->withErrors($validate->errors());
        }

        $remember   = ($request->get('remember'))? true : false;
        $login      = Auth::attempt($request->only(['email', 'password']), $remember);

        if(!$login) {
            if(RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
                event( new Lockout($request));
                
                $seconds = RateLimiter::availableIn($this->throttleKey($request));
                throw ValidationException::withMessages([
                    'email' => trans('auth.throttle', [
                        'seconds' => $seconds,
                        'minute' => ($seconds / 60)
                    ])
                ]);
            }
            
            RateLimiter::hit($this->throttleKey($request), 60);
            return redirect()->route('login')->withInput($request->all())->withErrors(['password' => 'Password Salah']);
        }

        session()->regenerate();
        $user   = Auth::user();

        if($user->status !== 1) {
            return redirect()->route('login')->withInput($request->all())->with("danger", "Akun belum aktif");
        }

        return redirect()->route( "dashboard" )->with("success", "Selamat datang kembali {$user->first_name}");
    }
}
