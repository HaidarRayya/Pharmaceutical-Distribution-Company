<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showsignin()
    {
        return view('Auth.signIn');
    }

    public function signin(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $user = User::where('email', '=', $loginData['email'])->first();
        if (!$user || !Hash::check($loginData['password'], $user->password)) {
            return redirect()->back()->with('message', 'invalid data');
        } else {
            if ($user->role == "admin") {
                Auth::login($user);
                $request->session()->regenerate();
                return redirect('/admin');
            } else if ($user->role == 'driverManager') {
                Auth::login($user);
                $request->session()->regenerate();
                return redirect('/driverManager');
            } else if ($user->role == 'driver') {
                Auth::login($user);
                $request->session()->regenerate();
                return redirect('/driver');
            } elseif ($user->role == "pharmacist" || $user->role == "beautystore") {
                if ($user->status == 'accept') {
                    Auth::login($user);
                    $request->session()->regenerate();
                    return redirect('/customer');
                } else {
                    return redirect()->back()->with('message', 'your request is under review, please wait');
                }
            }
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }


    public function showsignup()
    {
        return view('Auth.signUp');
    }

    public function signup(Request $request)
    {
        $signupData = $request->validate([
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'storename' => 'required|min:2',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:21', Password::min(8)->letters()->numbers()],
            'role' => 'required',
            'phonenumber' => 'required',
            'address' => 'required',
        ]);
        $signupData['password'] = Hash::make($signupData['password']);
        $signupData['certificate'] = $request->file('certificate')->store('certificateImages', 'public');

        User::create($signupData);

        return redirect()->back()->with('message', ' registerd successfully ,your request will be reviewed and a message will be sent to you upon acceptance  ');
    }
}