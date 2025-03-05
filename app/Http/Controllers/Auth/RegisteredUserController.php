<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student; // Add this line
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
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'role' => ['required', 'string', 'in:student,admin'],
            'password' => $request->role === 'admin'
                ? ['required', 'confirmed', Rules\Password::defaults()]
                : ['nullable'], // No password required for students
        ]);

        if ($request->role === 'admin') {
            // Register as admin in users table
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'admin',
            ]);

            event(new Registered($user));
            Auth::login($user);

            return redirect()->route('dashboard'); // Redirect to admin dashboard
        } else {
            // Register as student in students table
            $student = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('12345678'), // Default password for students
            ]);

            event(new Registered($student));
            Auth::guard('student')->login($student);

            return redirect()->route('studentdashboard'); // Redirect to student dashboard
        }
    }
}
