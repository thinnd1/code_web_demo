<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Exception;


class CustomerController extends Controller
{
    //
    protected $customer;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    public function viewCreateCustomer()
    {
        return view('admin.create_customer');
    }
    public function createCustomer(CustomerRequest $request)
    {
        try {
            $this->customer->createCustomer($request);
            return redirect()->route('listcustomer');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Lỗi hệ thống')->withInput();
        }
    }
    public function listCustomer()
    {
        $listCustomers = $this->customer->listCustomer();
        $totalcustomer = $this->customer->getAll();
        return view('admin.listcustomer', compact('listCustomers', 'totalcustomer'));
    }
    public function removeCustomer($id)
    {
        try {
            $this->customer->deleteUser($id);
            return redirect()->route('listcustomer');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Lỗi hệ thống')->withInput();
        }
    }
    public function viewEditCustomer($id)
    {
        try {
            $user = $this->customer->detailCustomer($id);
            return view('admin.edit_customer', compact('user'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Lỗi hệ thống')->withInput();
        }
    }
    public function editCustomer($id, CustomerRequest $request)
    {
        try {
            $this->customer->editCustomer($id, $request);
            return redirect()->route('listcustomer');
        } catch (\Exception $ex){
            return redirect()->back()->with('error', 'ID không tồn tại')->withInput();
        }
    }
    public function viewUserOrder($id)
    {
        $listCustomers = $this->customer->getUserOrder($id);
        $customerDeatail = $this->customer->getCustomerDetail($id);
        return view('admin.user_order_detail', compact('listCustomers', 'customerDeatail'));
    }
    public function exportCsvCustomer(Request $request, Customer $customer)
    {
        $fileName = 'customer.csv';
        $tasks = Customer::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Họ và tên', 'Username', 'Email', 'Tuổi', 'Số điện thoại', 'Địa chỉ', 'Nghề nghiệp', 'Công ty');

        $callback = function() use($tasks, $columns, $fileName) {

            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Họ và tên']     = $task->full_name;
                $row['Username']      = $task->username;
                $row['Email']         = $task->email;
                $row['Tuổi']          = $task->age;
                $row['Số điện thoại'] = $task->phone;
                $row['Địa chỉ']       = $task->address;
                $row['Nghề nghiệp']   = $task->job;
                $row['Công ty']       = $task->company;
                fputcsv($file, array($row['Họ và tên'], $row['Username'], $row['Email'], $row['Tuổi'], $row['Số điện thoại'], $row['Địa chỉ'],$row['Nghề nghiệp'], $row['Công ty']));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
    public function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
//        dd($data);

        return $data;
    }

    public function importCsvCustomer()
    {
        $file = public_path('upload/tasks1.csv');

        $customerArr = $this->csvToArray($file);
//        dd($customerArr);

        for ($i = 0; $i < count($customerArr); $i ++)
        {
            Customer::firstOrCreate($customerArr[$i]);
        }
        return 'Jobi done or what ever';
    }
}
