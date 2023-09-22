<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Client\Controller;
use App\Models\Client;
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
        return view('client.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'group_id' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Client::class],
            'name_last' => ['required', 'string', 'max:255'],
            'name_first' => ['required', 'string', 'max:255'],
            'name_last_read' => ['required', 'string', 'max:255'],
            'name_first_read' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Client::create([
            'group_id' => $request->group_id,
            'email' => $request->email,
            'name_last' => $request->name_last,
            'name_first' => $request->name_first,
            'name_last_read' => $request->name_last_read,
            'name_first_read' => $request->name_first_read,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::guard('client')->login($user);

        return redirect(RouteServiceProvider::CLIENT_HOME);
    }
}
