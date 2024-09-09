<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendResetCode;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => 0,
            'status' => 0
        ]);

        return redirect('login')->with('success', 'Registration successful. Please log in.');
    }
    public function login()
    {
        if (Auth::check()) {
            if (Auth::user()->is_admin) {
                return redirect('admin/dashboard');
            }
            return redirect('/');
        }
        return view('auth.login');
    }

    public function authLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 0], $remember)) {
            if (Auth::user()->is_admin) {
                return redirect('admin/dashboard');
            } else {
                session(['logged_in' => true]);
                return redirect('/');
            }
        } else {
            return redirect()->back()->with('error', 'Please enter correct email and password');
        }
    }

    public function authLogout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password');
    }

    public function sendResetCode(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $code = Str::random(6);
        $email = $request->email;

        PasswordReset::updateOrCreate(
            ['email' => $email],
            ['token' => $code, 'created_at' => now()]
        );
        Mail::to($email)->send(new sendResetCode($code));
        session(['password_reset_email' => $email]);
        return redirect()->route('password.verifyCodeForm');
    }

    public function showVerifyCodeForm()
    {
        return view('auth.verify_code');
    }

    public function verifyResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:password_resets,email',
            'code' => 'required'
        ]);

        $reset = PasswordReset::where('email', $request->email)
            ->where('token', $request->code)
            ->first();

        if (!$reset) {
            return back()->withErrors(['code' => 'Invalid code']);
        }

        return redirect()->route('password.resetForm');
    }

    public function showResetPasswordForm()
    {
        return view('auth.reset_password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email not found']);
        }

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        PasswordReset::where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password has been reset successfully!');
    }
}
