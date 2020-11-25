<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $order;
    protected $customer;

    public function __construct(Order $order, Customer $customer)
    {
        $this->order = $order;
        $this->customer = $customer;
    }

    public function index()
    {
        $orders = $this->order->getOrder();
        return view('admin.order', compact('orders'));
    }
    public function viewCreateOrder()
    {
        $customers = $this->customer->getAll();
        return view('admin.create_order', compact('customers'));
    }
    public function createOrder(Request $request)
    {
        $this->order->createOrder($request);
        return redirect()->route('order');
    }
    public function editOrder($id)
    {
        return view('admin.edit_order');
    }
    public function updateOrder(Request $request, $id)
    {
        $this->order->updateOrder($id, $request);
        return redirect()->route('order');
    }
    public function deleteOrder($id)
    {
        $this->order->deleteOrder($id);
        return redirect()->route('order');
    }

}
