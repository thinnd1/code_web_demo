<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    protected $customer;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    public function createCustomer()
    {
        $this->customer->createCustomer();
    }
    public function listCustomer()
    {
        $listCustomers = $this->customer->listCustomer();
        return view('admin.listcustomer', compact('listCustomers'));
    }
    public function removeCustomer($id)
    {
        $this->customer->deleteUser($id);
        return redirect()->route('listcustomer');
    }
    public function viewEditCustomer($id)
    {
        $user = $this->customer->detailCustomer($id);
        return view('admin.edit_customer', compact('user'));
    }
    public function editCustomer($id, Request $request)
    {
        $this->customer->editCustomer($id, $request);
        return redirect()->route('listcustomer');
    }
}
