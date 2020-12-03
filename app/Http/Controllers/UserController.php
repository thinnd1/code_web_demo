<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function getListUser(Request $request)
    {
        try {
            $search = trim($request->input('search_user'));
            $users = $this->user->getUser($search);
            $userTotal = $this->user->getAll();
            return view('admin.list_user', compact('users', 'userTotal'));
        } catch  (\Exception $ex) {
            return redirect()->back()->withInput();
        }
    }
    public function editUser($id)
    {
        try {
            $userDetail = $this->user->userDetail($id);
            if (is_null($userDetail)){
                return redirect()->route('404-notfound');
            }
            return view('admin.edit_user', compact('userDetail'));
        } catch  (\Exception $ex) {
            return redirect()->back()->withInput();
        }
    }
    public function updateUser(UpdateUserRequest $request, $id)
    {
        try {
            $this->user->updateInformation($request, $id);
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch  (\Exception $ex) {
            return redirect()->back()->withInput();
        }
    }
    public function removeUser($id)
    {
        try {
            $this->user->removeUser($id);
            return redirect()->route('getlistuser');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Lỗi hệ thống')->withInput();
        }
    }
}
