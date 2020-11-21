<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $orders = $this->order->getOrder();
        return view('admin.order', compact('orders'));
    }
    public function createOrder()
    {
        return $this->order->createOrder();
    }
    public function updateOrder(Request $request, $id)
    {
        $this->order->editOrder($id, $request);
        return redirect()->route('order');
    }
    public function deleteOrder($id)
    {
        $this->order->deleteOrder($id);
        return redirect()->route('order');
    }

}
