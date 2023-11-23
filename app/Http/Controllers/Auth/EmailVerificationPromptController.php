<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        $notification = array(
                        'message' => 'Selamat!, akun berhasil di verifikasi',
                        'alert-type' => 'success'
                    );
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME)->with($notification)
                    : view('backend.pages.auth.verify-email')->with('status', 'registrasi-success');
    }
}
