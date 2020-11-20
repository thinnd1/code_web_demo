<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function viewSignup()
    {
        return view('layout.signup');
    }

    public function signup(Request $request)
    {
        $user = $request->all();
        $this->user->signup($user);

        return redirect()->route('login');
    }

    public function viewLogin()
    {
        return view('layout.login');
    }
    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // login thành công
            // check xem user này thuộc cái nào. và chuyển hướng tới cái đó.
            dd(Auth::user());
            dd("234234234234");
        } else {
            dd("sai nhe 12 ");
        }
    }
}
