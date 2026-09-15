<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show login page.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Authenticate user.
     */
    public function login(Request $request)
    {
        // Validate login form
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        /*
         * Check credentials against the users table.
         *
         * Laravel automatically compares the
         * submitted password with the hashed password.
         */
        if (Auth::attempt(
            $credentials,
            $request->boolean('remember')
        )) {

            /*
             * Generate a new session ID after
             * successful authentication.
             *
             * This protects against session fixation.
             */
            $request->session()->regenerate();

            // Login successful
            return redirect()
                ->route('dashboard')
                ->with('success', 'Welcome back to ClientHub.');
        }

        // Login failed
        return back()
            ->withErrors([
                'email' => 'The email or password is incorrect.',
            ])
            ->onlyInput('email');
    }

    /**
     * Logout user.
     */
    public function logout(Request $request)
    {
        // Remove authenticated user
        Auth::logout();

        /*
         * Completely invalidate the current session.
         */
        $request->session()->invalidate();

        /*
         * Generate a new CSRF token for the next session.
         */
        $request->session()->regenerateToken();

        // Return to login page
        return redirect()
            ->route('login')
            ->with('success', 'You have been logged out.');
    }
}