<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function throttleKey(Request $request)
    {
        return Str::transliterate(Str::lower($request->get('email') . "|" . $request->ip()));
    }

    public function do_register(Request $request) 
    {
        $validate = Validator::make($request->all(), [
            'first-name'    => ['required', 'string'],
            'last-name'     => ['required', 'string'],
            'email'         => ['required', 'string', 'email:rdf,dns', 'unique:users,email'],
            'password'      => ['required', 'string', Password::min('8')->letters()->mixedCase()->numbers()->symbols()],
        ]);

        if($validate->fails()) {
            if(RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
                event(new Lockout($request));

                $seconds = RateLimiter::availableIn($this->throttleKey($request));
                throw ValidationException::withMessages([
                    'email' => trans('auth.throttle', [
                        'seconds'   => $seconds,
                        'minute'    => ($seconds / 60)
                    ])
                ]);
            }

            RateLimiter::hit($this->throttleKey($request), 60);
            return redirect()->route('register')->withInput($request->all())->withErrors($validate->errors());
        }

        if(empty($request->get('term-policy'))) {
            return redirect()->route('register')->withInput($request->all())->withErrors($validate->errors())->with('warning', 'Mohon menyutujui Terms & Policy');
        }

        $register = User::create([
            'uuid'          => Str::uuid(),
            'first_name'    => $request->get('first-name'),
            'last_name'     => $request->get('last-name'),
            'username'      => Str::lower($request->get('first-name') . "_" . $request->get('last-name')),
            'email'         => $request->get('email'),
            'password'      => Hash::make($request->get('password')),
            'referral'      => Str::random(10),
            'crated_at '    => date("Y-m-d H:i:s")
        ]);

        if(!$register) {
            return redirect()->route('register')->withInput($request->all())->withErrors($validate->errors())->with('email', "System mainctance");
        }

        return redirect()->route('login')->withInput($request->only(['email', 'password']))->with('success', "Pendaftaran berhasil, silahkan login");
    }
}
