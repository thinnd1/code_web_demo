<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function signup(UserRequest $request)
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
        $checkExistUser = User::where('username', $request->username )->first();
        if (!$checkExistUser) {
            return redirect()->route('login')->with('error', 'tài khoản không tồn tại');
        } elseif(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect()->route('home')->with('key', 'Đăng nhập thành công');
        } else {
            return redirect()->route('login')->with('error', 'Sai mật khẩu');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function getInformation()
    {
        $id = Auth::user()->id;
        $user = $this->user->getInformation($id);
        return view('admin.information', compact('user'));
    }
    public function viewEditInformation()
    {
        $user = $this->user->getInformation(Auth::user()->id);
        return view('admin.editinformation', compact('user'));
    }
    public function updateInformation(Request $request)
    {
        $id = Auth::user()->id;
        $this->user->updateInformation($id, $request);
        return redirect()->route('home')->with('key', 'Cập nhật thông tin thành công');
    }
}
