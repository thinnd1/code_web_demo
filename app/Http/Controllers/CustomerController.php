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
    public function viewUserOrder($id)
    {
        $listCustomers = $this->customer->getUserorder($id);
        return view('admin.user_order_detail', compact('listCustomers'));
    }
    public function exportCsvCustomer(Request $request, Customer $customer)
    {
        $fileName = 'tasks.csv';
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

        return $data;
    }

    public function importCsvCustomer()
    {
        $file = public_path('upload/tasks1.csv');

        $customerArr = $this->csvToArray($file);

        for ($i = 0; $i < count($customerArr); $i ++)
        {
            Customer::firstOrCreate($customerArr[$i]);
        }
        return 'Jobi done or what ever';
    }
}
