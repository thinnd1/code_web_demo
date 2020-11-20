<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    //
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getInformation()
    {
        $user = $this->user->getInformation();
        return view('admin.information', compact('user'));
    }
    public function viewEditInformation()
    {
        $user = $this->user->getInformation();
        return view('admin.editinformation', compact('user'));
    }
    public function updateInformation(Request $request)
    {
        $id = '5fb4e7d5986a000045007362';
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

}
