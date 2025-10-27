<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister() {
        return view('pages.registration');
    }

    public function register(Request $request)
        {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s\-]+$/', 
            ],
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:50',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/',
            ],
        ], [
            'name.regex' => 'Name can only contain letters, spaces, and hyphens.',
            'password.regex' => 'Password does not meet security requirements.',
            'password.regex.lower' => 'Password must contain at least one lowercase letter.',
            'password.regex.upper' => 'Password must contain at least one uppercase letter.',
            'password.regex.number' => 'Password must contain at least one number.',
            'password.regex.special' => 'Password must contain at least one special character.',
        ], [], [], 'register');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        $request->session()->put('username', $user->name);
        $request->session()->put('email', $user->email);

        return redirect()->route('dashboard');
    }

    public function showLogin() {
        return view('pages.log');
    }

    public function login(Request $request)
     {
        // Validate input
        $request->validate([
            'email' => [
                'required',
                'email',
                'max:255'
            ],
            'password' => [
                'required',
                'string',
                'min:8', 
                'max:50' 
            ],
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email cannot be longer than 255 characters.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password cannot exceed 50 characters.',
        ], [], [], 'login');

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $request->session()->put('username', Auth::user()->name);
            $request->session()->put('email', Auth::user()->email);

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials. Please check your email and password.',
        ], 'login');; 
    }

    public function manga(Request $request){

        $username = $request->session()->get('username');
        $email = $request->session()->get('email');

        return view('pages.manga', compact('username', 'email'));
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function updateUsername(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:14',
        ]);

        $user = Auth::user();

        if ($request->name === $user->name) {
            return back()->with('error', 'You entered the same username.');
        }

        $exists = User::where('name', $request->name)
                    ->where('id', '!=', $user->id)
                    ->exists();

        if ($exists) {
            return back()->with('error', 'This username is already taken.');
        }

        $user->name = $request->name;
        $user->save();

        $request->session()->put('username', $user->name);

        return back()->with('success', 'Username updated successfully!');
    }


}

