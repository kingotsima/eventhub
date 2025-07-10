<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\ResetPasswordOTP;
use Illuminate\Support\Facades\Password;



class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if ($user && $user->is_suspended) {
            return back()->withErrors([
                'email' => 'Your account has been suspended. Contact the admin or contact us @ +2348088547019.',
            ]);
        }
    
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
    
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }
    
    
    

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'profile_image' => 'nullable|image|max:2048', // optional, max 2MB
            'terms' => 'accepted',
        ]);
    
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
    
        if ($request->hasFile('profile_image')) {
            // store in 'public/profile_images' folder
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $data['profile_image'] = $path;
        }
    
        $user = User::create($data);
    
        Auth::login($user);
        return redirect('/');
    }
    

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }



    //forgot password
    public function showForgotPasswordForm()
{
    return view('auth.forgot-password');
}

public function sendOTP(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email not found.']);
    }

    $otp = rand(100000, 999999);

    DB::table('password_resets')->updateOrInsert(
        ['email' => $request->email],
        [
            'token' => Hash::make($otp),
            'created_at' => Carbon::now()
        ]
    );

    $user->notify(new ResetPasswordOTP($otp));

    return redirect()->route('password.verify')->with('email', $request->email);
}

public function showVerifyOTPForm()
{
    return view('auth.verify-otp');
}

public function verifyOTP(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'otp' => 'required|digits:6',
        'password' => 'required|confirmed|min:6',
    ]);

    $record = DB::table('password_resets')->where('email', $request->email)->first();

    if (!$record || !Hash::check($request->otp, $record->token)) {
        return back()->withErrors(['otp' => 'Invalid OTP.']);
    }

    if (Carbon::parse($record->created_at)->addMinutes(15)->isPast()) {
        return back()->withErrors(['otp' => 'OTP has expired.']);
    }

    $user = User::where('email', $request->email)->first();
    $user->password = Hash::make($request->password);
    $user->save();

    DB::table('password_resets')->where('email', $request->email)->delete();

    return redirect()->route('login')->with('status', 'Password has been reset.');
}

}


