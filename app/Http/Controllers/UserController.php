<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    public function registerForm()
    {
        return view('Auth.registration');
    }

    public function register(RegistrationRequest $request)
    {
        $request['password'] = bcrypt($request['password']);

        $user = User::create($request);

        session()->flash("success", "User Created Successfully");

        Auth::login($user);

        return redirect(url('posts'));
    }

    public function loginForm()
    {
        return view('Auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => 'required|email',
            "password" => 'required|string|max:10'
        ]);

        $is_login = Auth::attempt(["email" => $data['email'], "password" => $data['password']]);

        if ($is_login != true) {
            return redirect(url(''))->withErrors("The Email Or Password Is Incorrect");
        }

        return redirect(url('posts'));
    }

    public function restForm()
    {
        return view('Auth.rest');
    }

    public function rest(Request $request)
    {
        $data = $request->validate([
            "email" => 'required|email|exists:users,email',
            "password" => 'required|string|max:10|confirmed'
        ]);

        $data['password'] = bcrypt($data['password']);

        User::where("email", $request->email)->first()->update($data);

        session()->flash("success", "Password Changed Successfully");

        return view('Auth.login');
    }

    public function logout()
    {
        Auth::logout();

        session()->flash("success", "Logged Out Successfully");

        return redirect(url(''));
    }
}
