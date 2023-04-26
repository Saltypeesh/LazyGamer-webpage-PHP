<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create()
    {
        return view('users.user_register');
    }

    // Create New User
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'username' => ['required', 'min:5'],
            'email' => ['required', 'email', 'min:5', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:8'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    // Show User Edit page
    public function edit()
    {
        return view('users.profile');
    }

    // Update User
    public function save(Request $request, User $user)
    {
        $formFields = $request->validate([
            'username' => ['required', 'min:5']
        ]);

        if ($request->hasFile('profile_img')) {
            $formFields['profile_img'] = $request->file('profile_img')->store('profile_img', 'public');
        }

        // Create User
        $user->update($formFields);

        return back()->with('message', 'User profile has been updated!');
    }

    public function toAdmin(Request $request, User $user)
    {
        if ($user->role != 'customer') {
            return back()->with('message', 'User is already admin');
        } else {
            $formFields['role'] = 1;
        }

        // Create User
        $user->update($formFields);

        return redirect('/')->with('message', 'User have been upgraded to admin!');
    }

    // Logout User
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You have been logout');
    }

    // Show Login Form
    public function login_view()
    {
        return view('users.user_login');
    }

    // Manage Listings
    public function manage()
    {
        return view('users.manage', ['listings' => auth()->user()->listings()->get()]);
    }

    public function denyAccess()
    {
        return view('users.denyAccess');
    }

    public function terms_of_Use()
    {
        return view('extra.terms_of_Use');
    }
    public function privacy_Policy()
    {
        return view('extra.privacy_Policy');
    }
    public function faq()
    {
        return view('extra.faq');
    }

    public function destroy(User $user, Request $request)
    {
        // Make sure logged in user is owner
        if ($user->id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $user->delete();

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'Account deleted successfully!');
    }


    // Authenticate User
    // public function authenticate(Request $request)
    // {
    //     $formFields = $request->validate([
    //         'email' => ['required', 'email', 'min:5'],
    //         'password' => 'required'
    //     ]);

    //     if (auth()->attempt($formFields)) {
    //         $request->session()->regenerate();

    //         return redirect('/')->with('message', 'You are now logged in!');
    //     }

    //     return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    // }
}
