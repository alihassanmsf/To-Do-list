<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showProfile(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user is authenticated
        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to login to view your profile.');
        }

        // Check if the user is in edit mode
        $editMode = $request->has('edit');

        // Pass the user data and edit mode to the profile view
        return view('auth.profile', [
            'user' => $user,
            'editMode' => $editMode,
        ]);
    }

    public function updateProfile(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Update the user's profile
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Log the activity
        Activity::create([
            'user_id' => $user->id,
            'action' => 'User updated their profile',
            'target_type' => 'User',
            'target_id' => $user->id,
        ]);

        // Redirect back to the profile page with a success message
        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = auth()->user();


            if ($user->role->name === 'Admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role->name === 'Manager') {
                return redirect()->route('manager.dashboard');
//                    dd('You Have logged in as a Manager');
            } elseif ($user->role->name === 'User') {
                return redirect()->route('tasks.index');
            }


            Activity::create([
                'user_id' => Auth::id(),
                'action' => 'User logged in',
                'target_type' => 'User',
                'target_id' => $user->id,
            ]);
        }

        return back()->with(
            'email', 'The provided credentials do not match our records.'
        );

    }

    public function showRegisterForm()
    {

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $role = Role::where('name', 'User')->first();

        if (!$role) {
            return back()->withErrors(['role' => 'Role "User" not found. Please ensure the role exists in the roles table.']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $role->id,
            'password' => Hash::make($request->password),
        ]);

        Activity::create([
            'user_id' => Auth::id() ?? $user->id,
            'action' => 'User is Created',
            'target_type' => 'User',
            'target_id' => $user->id,
        ]);
        return redirect()->route('login')->with('success', 'Account created successfully.');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $resetEmail = $request->email;
        $user = User::where('email', $resetEmail)->first();
        $status = Password::sendResetLink(
            $request->only('email')
        );
        Activity::create([
            'user_id' => $user->id,
            'action' => 'Send Rest Link',
            'target_type' => 'User',
            'target_id' => $user->id,
        ]);
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $resetEmail = $request->email;
        $user = User::where('email', $resetEmail)->first();

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        Activity::create([
            'user_id' => $user->id,
            'action' => 'Done Resting Password',
            'target_type' => 'User',
            'target_id' => $user->id,
        ]);

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
