<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Services\Log;
use App\Models\User;

class Authentication extends Controller
{
    protected $logService;
    public function __construct(Log $logService)
    {
        $this->logService = $logService;
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => [
                'required',
                'min:8',
                'max:255',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/'
            ],
        ], [
            // Email errors
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',

            // Password errors
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password must not exceed 255 characters.',
            'password.regex' => 'Password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);
        $remember = $request->filled('remember');
        $email = strtolower($request->input('email'));
        $ip = $request->ip();

        $accountKey = 'email_account:' . $email;
        $ipKey = 'ip_address:' . $ip;

        if (RateLimiter::tooManyAttempts($accountKey, 3)) {
            $seconds = RateLimiter::availableIn($accountKey);
            return back()->with('error', "Too many attempts on this account. Please try again in {$seconds} seconds.");
        }

        if (RateLimiter::tooManyAttempts($ipKey, 10)) {
            return back()->with('error', 'Too many requests from this network. Please try again later.');
        }

        RateLimiter::hit($accountKey, 60);
        RateLimiter::hit($ipKey, 60);

        $user = User::where('email', $credentials['email'])
                ->whereNotNull('email_verified_at')
                ->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->with(
                'error','Invalid Email or Password.', // Generic message
            );
        }

        if (Auth::attempt($credentials, $remember))
        {
            RateLimiter::clear($accountKey);
            RateLimiter::clear($ipKey);
            //log the event log
            $this->logService->saveLogs(Auth::id(),'User Logged In',$request->ip(),$request->header('User-Agent'));
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
    }
    public function logout(Request $request)
    {
        //log the event log
        $this->logService->saveLogs(
                Auth::id(),
                'User Logged Out',
                $request->ip(),
                $request->header('User-Agent')
            );
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/")->with('error','You are logged out!');
    }
}
