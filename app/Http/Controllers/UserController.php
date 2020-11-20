<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
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
    public function listCustomer()
    {
        $listCustomers = $this->user->listCustomer();
        return view('admin.listcustomer', compact('listCustomers'));
    }
    public function removeCustomer($id)
    {
        $this->user->deleteUser($id);
        return redirect()->route('listcustomer');
    }
    public function viewEditCustomer($id)
    {
        $user = $this->user->getInformation(Auth::user()->id);
        return view('admin.edit_customer', compact('user'));
    }
    public function editCustomer($id)
    {

    }

}
