<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\AccountRequest;
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
        if (Auth::check()){
            return redirect()->route('listcustomer');
        }
        return view('layout.signup');
    }

    public function signup(SignupRequest $request)
    {
        $user = $request->all();
        $this->user->signup($user);

        return redirect()->route('login');
    }

    public function viewLogin(Request $request)
    {
        if (Auth::check()){
            return redirect()->route('listcustomer');
        } else
        $request->session()->put('url.intended',url()->previous());
        return view('layout.login');
    }
    public function login(LoginRequest $request)
    {
        $checkExistUser = User::where('username', $request->username )->first();
        if (!$checkExistUser) {
            return redirect()->back()->with('error', 'Tài khoản không tồn tại')->withInput();
        } elseif(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect($request->session()->get('url.intended'));
        } else {
            return redirect()->back()->with('error', 'Sai mật khẩu')->withInput();
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
    public function updateInformation(AccountRequest $request)
    {
        $id = Auth::user()->id;
        $this->user->updateInformation($request, $id);
        return redirect()->back()->with('key', 'Cập nhật thông tin thành công');
    }
}
