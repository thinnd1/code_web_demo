<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

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

}
