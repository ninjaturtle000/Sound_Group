<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Show registration form
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('pages.auth.register');
    }

    /**
     * Handle user registration with mandatory fields and strict validation
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'userid' => ['required', 'string', 'min:3', 'max:50', 'alpha_dash', 'unique:users,userid'],
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'min:7', 'max:25', 'regex:/^[0-9\+\-\s\(\)]+$/'],
            'address' => ['required', 'string', 'min:5', 'max:500'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'userid.required' => 'User ID is mandatory and must be unique.',
            'userid.unique' => 'This User ID is already taken. Please choose another.',
            'userid.alpha_dash' => 'User ID may only contain letters, numbers, dashes, and underscores.',
            'name.required' => 'Full Name is mandatory.',
            'email.required' => 'Email-id is mandatory.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This Email-id is already registered.',
            'phone.required' => 'Phone Number is mandatory.',
            'phone.regex' => 'Please provide a valid phone number (digits, spaces, dashes, or + only).',
            'address.required' => 'Address is mandatory.',
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 6 characters.',
        ]);

        $user = User::create([
            'userid' => strtolower($validated['userid']),
            'name' => $validated['name'],
            'email' => strtolower($validated['email']),
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'role' => 'user',
            'is_active' => true,
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', "Welcome to SOUND Group, {$user->name}! Your account has been created.");
    }

    /**
     * Show login form
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('pages.auth.login');
    }

    /**
     * Handle login authentication (supports USERID or Email)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'login.required' => 'Please enter your USERID or Email-id.',
            'password.required' => 'Please enter your password.',
        ]);

        $loginInput = $credentials['login'];
        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'userid';

        $attemptCredentials = [
            $fieldType => strtolower($loginInput),
            'password' => $credentials['password'],
        ];

        $remember = $request->boolean('remember');

        if (Auth::attempt($attemptCredentials, $remember)) {
            $user = Auth::user();

            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors(['login' => 'Your account is deactivated. Please contact SOUND Group support.']);
            }

            $request->session()->regenerate();

            if ($user->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome back, Administrator!');
            }

            return redirect()->intended(route('home'))->with('success', "Welcome back, {$user->name}!");
        }

        return back()->withInput($request->only('login'))->withErrors([
            'login' => 'Invalid credentials. Please verify your USERID/Email and password.',
        ]);
    }

    /**
     * Handle user logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }
}
