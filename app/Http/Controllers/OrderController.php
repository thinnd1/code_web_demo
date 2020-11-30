<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

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
            return redirect()->route('order');
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
    public function exportCsvOrder(Request $request, Order $order)
    {
        $fileName = 'order.csv';
        $orders = Order::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('Họ và tên', 'Sản phẩm', 'Tổng giá', 'Địa chỉ', 'Ngày đặt', 'Email', 'Trạng thái', 'Hình thức thanh toán');

        $callback = function() use($orders, $columns, $fileName) {

            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);

            foreach ($orders as $order) {
                $row['Họ và tên']            = $order->id_user;
                $row['Sản phẩm']             = $order->id_product;
                $row['Tổng giá']             = $order->total_price;
                $row['Địa chỉ']              = $order->address;
                $row['Ngày đặt']             = $order->orderdate;
                $row['Email']                = $order->email;
                $row['Trạng thái']           = $order->status;
                $row['Hình thức thanh toán'] = $order->payment;
                fputcsv($file, array($row['Họ và tên'], $row['Sản phẩm'], $row['Tổng giá'], $row['Địa chỉ'], $row['Ngày đặt'], $row['Email'],$row['Trạng thái'], $row['Hình thức thanh toán']));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
