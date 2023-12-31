<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     Auth::setDefaultDriver('web'); // Set the default guard to 'web'
    // }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        return view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('admin.auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    public function store(AdminLoginRequest $request): RedirectResponse
    {
        //
        $credentials = $request->validated();

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        // Auth::guard('admin')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        // return redirect('/admin');

        // if (auth('admin')->check()) {
        //     auth('admin')->logout();  // Logout the 'admin' guard
        //     $request->session()->invalidate();  // Invalidate the session
        //     $request->session()->regenerateToken();  // Regenerate the CSRF token
        // }

        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();  // Logout the 'admin' guard
            $request->session()->invalidate();  // Invalidate the session
            $request->session()->regenerateToken();  // Regenerate the CSRF token
        }

        // $this->guard('admin')->logout();
        
        return redirect('/admin');
    }
}
