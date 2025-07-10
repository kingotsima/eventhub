<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password'); // no change needed
    }

    public function sendOTP(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        $otp = rand(100000, 999999);
        session(['otp' => $otp, 'reset_email' => $user->email]);

        Mail::raw("Your OTP is: $otp", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Password Reset OTP');
        });

        return redirect()->route('password.verify')->with('success', 'OTP sent to your email.');
    }

    public function showVerifyOTPForm()
    {
        return view('auth.verify-otp'); // rename view from reset-password to verify-otp
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        if (session('otp') != $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        $user = User::where('email', session('reset_email'))->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User session expired. Try again.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        session()->forget(['otp', 'reset_email']);

        return redirect('/login')->with('success', 'Password has been reset.');
    }
}
