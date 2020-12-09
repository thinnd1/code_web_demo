<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Http\Requests\OrderRequest;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    protected $order;
    protected $customer;

    public function __construct(Order $order, Customer $customer)
    {
        $this->order = $order;
        $this->customer = $customer;
    }

    public function index(Request $request)
    {
        try {
            $search = trim($request->input('search_order'));
            $orders = $this->order->getOrder($search);
            return view('admin.order', compact('orders'));
        } catch  (\Exception $ex) {
            return redirect()->back()->withInput();
        }
    }
    public function viewCreateOrder()
    {
        try {
            $customers = $this->customer->getAll();
            return view('admin.create_order', compact('customers'));
        } catch  (\Exception $ex) {
            return redirect()->back()->withInput();
        }
    }
    public function createOrder(OrderRequest $request)
    {
        try {
            $this->order->createOrder($request);
            return redirect()->route('order')->with('success', 'Tạo đơn hàng thành công');
        } catch  (\Exception $ex) {
            return redirect()->back()->withInput();
        }
    }
    public function editOrder($id)
    {
        try {
            $orderdetail = $this->order->getOrderDetail($id);
            $customers = $this->customer->getAll();
            if (is_null($orderdetail)){
                return redirect()->route('404-notfound');
            }
            return view('admin.edit_order', compact('orderdetail', 'customers'));
        } catch  (\Exception $ex) {
            return redirect()->back()->withInput();
        }
    }
    public function updateOrder(OrderRequest $request, $id)
    {
        try {
            $this->order->updateOrder($request, $id);
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch  (\Exception $ex) {
            return redirect()->back()->withInput();
        }
    }
    public function deleteOrder($id)
    {
        try {
            $this->order->deleteOrder($id);
            return redirect()->route('order');
        } catch  (\Exception $ex) {
            return redirect()->back()->withInput();
        }
    }
    public function exportCsvOrder()
    {
        return Excel::download(new OrderExport(), 'order-' . time() . '.xlsx');
    }
}
