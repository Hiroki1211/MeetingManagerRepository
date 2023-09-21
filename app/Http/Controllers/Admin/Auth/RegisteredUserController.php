<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Admin::class],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Admin::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::guard('admin')->login($user);

        return redirect(RouteServiceProvider::ADMIN_HOME);
    }
}
