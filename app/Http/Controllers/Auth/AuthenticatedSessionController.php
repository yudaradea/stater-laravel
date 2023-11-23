<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('backend.pages.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
         $filedType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if($filedType == 'email') {
            $request->validate([
                "login_id" => "required|email|exists:users,email",
                "password" => "required|min:5"
            ],[
                "login_id.required" => "Masukan Email atau Username",
                "login_id.email" => "Email address salah",
                "login_id.exists" => "Email address belum terdaftar",
                "password.required" => "Masukan password"
            ]);
        } else {
            $request->validate([
                "login_id" => "required|exists:users,username",
                "password" => "required|min:5"
            ],[
                "login_id.required" => "Masukan Email atau Username",
                "login_id.exists" => "Username belum terdaftar",
                "password.required" => "Masukan password"
            ]);
        }

        $creds = array($filedType=>$request->login_id, 'password'=>$request->password);

        if(Auth::guard('web')->attempt($creds) ){

            $checkUser = User::where($filedType, $request->login_id)->first();
            if($checkUser->blocked == 1){
                Auth::guard('web')->logout();
                return redirect()->route('login')->with('fail', 'Your account has been blocked.');
            }else {
                    $notification = array(
                        'message' => 'Hi Welcome'. ' '. Auth::user()->name,
                        'alert-type' => 'success'
                    );

               $request->session()->regenerate();

              return redirect()->intended(RouteServiceProvider::HOME)->with($notification);
            }

        }else {
            return redirect()->back()->with('fail', 'Email/Username atau Password salah');
        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
