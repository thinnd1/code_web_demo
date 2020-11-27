<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Customer;
use App\Models\Order;

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
    public function createOrder(OrderRequest $request)
    {
        $this->order->createOrder($request);
        return redirect()->route('order');
    }
    public function editOrder($id)
    {
        $orderdetail = $this->order->getOrderDetail($id);
        $customers = $this->customer->getAll();

        return view('admin.edit_order', compact('orderdetail', 'customers'));
    }
    public function updateOrder(OrderRequest $request, $id)
    {
        $this->order->updateOrder($request, $id);
        return redirect()->route('order');
    }
    public function deleteOrder($id)
    {
        $this->order->deleteOrder($id);
        return redirect()->route('order');
    }

}
