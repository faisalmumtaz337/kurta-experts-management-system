<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        // Validate Request
        $credentials = $request->validate([
            'contact'  => 'required|numeric',
            'password' => 'required|string',
        ]);

        // Remember Me Checkbox
        $remember = $request->boolean('remember');

        // Attempt Login
        if (Auth::attempt($credentials, $remember)) {

            // Prevent Session Fixation
            $request->session()->regenerate();

            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Redirect Based On Role
            if ($user->isAdmin()) {
                return redirect()->intended(route('dashboard'));
            }

            // Default Redirect
            return redirect()->intended('/');
        }

        // Failed Login
        return back()
            ->withErrors([
                'contact' => 'Invalid contact number or password.',
            ])
            ->onlyInput('contact');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }


    // TEMPORARY
    public function create(): View
    {
        return view('register');
    }

    public function store(Request $request, User $user)
    {
        $password = Hash::make($request->input('password'));

        $user->create([
            'name' => $request->input('name'),
            'caste' => $request->input('caste'),
            'contact' => $request->input('contact'),
            'password' => $password,
            'name' => $request->input('name')
        ]);

        return redirect()->back();
    }
}
