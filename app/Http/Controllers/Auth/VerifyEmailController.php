<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            $notification = array(
                        'message' => 'Selamat!, akun berhasil di verifikasi',
                        'alert-type' => 'success'
                    );
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1')->with($notification);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        $notification = array(
                        'message' => 'Selamat!, akun berhasil di verifikasi',
                        'alert-type' => 'success'
                    );
        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1')->with($notification);
    }
}
