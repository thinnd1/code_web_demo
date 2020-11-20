<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\DocBlock\Tags\Generic;

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
            return redirect()->route('home')->with('key', 'Đăng nhập thành công');
        } else {
            return redirect()->route('login')->with('error', 'Sai username hoặc mật khẩu');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
