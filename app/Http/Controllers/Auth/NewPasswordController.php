<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('backend.pages.auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', Rules\Password::defaults()],
            'password_confirmation' =>['same:password'],
        ],[
            'password.required' => 'Password tidak boleh kosong',
            'password_confirmation.same' => 'Konfirmasi password tidak sama'
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        $notification = array(
                        'message' => 'Reset password berhasil',
                        'alert-type' => 'success'
                    );

        $notification_error = array(
                        'message' => 'Reset password gagal',
                        'alert-type' => 'error'
                    );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('success', 'Reset password berhasil, silakan login menggunakan Email/Username dan password baru anda')->with($notification)
                    : redirect()->route('password.request')->with('fail', 'reset password gagal, token expired, silakan minta link reset password yang baru')->with($notification_error);
    }
}
