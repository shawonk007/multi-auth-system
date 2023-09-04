<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        // Auth::guard('web')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        // return redirect('/');

        // if (Auth::guard('web')->check()) {
        //     Auth::guard('web')->logout();  // Logout the 'web' guard (user)
        //     $request->session()->invalidate();  // Invalidate the session
        //     $request->session()->regenerateToken();  // Regenerate the CSRF token
        // }

        // return redirect('/login');
        $request->session()->forget('user_id');
        Auth::guard('web')->logout();  // This will log out the user using the 'web' guard
        // $request->session()->invalidate();  // Invalidate the session
        $request->session()->regenerateToken();  // Regenerate the CSRF token
    
        return redirect('/login');  // Redirect to the login page
    }
}
