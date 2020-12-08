<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\ImportCsvRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\CustomersImport;
use App\Models\Customer;
use App\Models\Import;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;


class CustomerController extends Controller
{
    //
    protected $customer;
    protected $import;

    public function __construct(Customer $customer,Import $import)
    {
        $this->customer = $customer;
        $this->import = $import;
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
    public function listCustomer(Request $request)
    {
        try {
            $search = trim($request->input('search_user'));
            $listCustomers = $this->customer->listCustomer($search);
            $totalcustomer = $this->customer->getAll();
            return view('admin.listcustomer', compact('listCustomers', 'totalcustomer'));
        } catch  (\Exception $ex) {
            return redirect()->back()->withInput();
        }
    }
    public function removeCustomer($id)
    {
        try {
            $this->customer->deleteUser($id);
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Lỗi hệ thống')->withInput();
        }
    }
    public function viewEditCustomer($id)
    {
        try {
            $user = $this->customer->detailCustomer($id);
            if (is_null($user)){
                return abort(404);
//                return redirect()->route('404-notfound');
            }
            return view('admin.edit_customer', compact('user'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Lỗi')->withInput();
        }
    }
    public function editCustomer($id, CustomerRequest $request)
    {
        try {
            $this->customer->editCustomer($id, $request);
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } catch (\Exception $ex){
            return redirect()->back()->with('error', 'ID không tồn tại')->withInput();
        }
    }
    public function viewUserOrder($id)
    {
        try {
            $listCustomers = $this->customer->getUserOrder($id);
            $customerDetail = $this->customer->getCustomerDetail($id);
            return view('admin.user_order_detail', compact('listCustomers', 'customerDetail'));
        } catch  (\Exception $ex) {
            return redirect()->back()->withInput();
        }
    }
    public function exportCsvCustomer(Request $request, Customer $customer)
    {
        $fileName = 'customer.csv';
        $tasks = Customer::all();

        $headers = array(
            "Content-Encoding" => "UTF-8",
            "Content-Type"        => "text/csv;charset=utf-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Content-Transfer-Encoding" => "binary",
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
                if (!$header){
                    $header = $row;
                } else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    public function importCsvCustomer()
    {
        $file = public_path('uploads/tasks1.csv');

        $customerArr = $this->csvToArray($file);
//        dd($customerArr);

        for ($i = 0; $i < count($customerArr); $i ++)
        {
            Customer::create([
                'username' => $customerArr[$i]['Username'],
                'full_name' => $customerArr[$i]['Họ và tên'],
                'email' => $customerArr[$i]['Email'],
                'age' => $customerArr[$i]['Tuổi'],
                'phone' => $customerArr[$i]['Số điện thoại'],
                'address' => $customerArr[$i]['Địa chỉ'],
                'job' => $customerArr[$i]['Nghề nghiệp'],
                'company' => $customerArr[$i]['Công ty'],
            ]);
        }
        return redirect()->route('listcustomer');
    }

    public function importCsv(ImportCsvRequest $request)
    {
        $this->customer->importCsvCustomer($request);
        return redirect()->route('listcustomer');
    }
    public function fileExport()
    {
        return Excel::download(new CustomersExport(), 'customers-' . time() . '.xlsx');
    }
    public function importCustomer(ImportRequest $request)
    {
        $import = Excel::toArray(new CustomersImport, request()->file('file'));
        $data = [];
//        $url = https://docs.google.com/spreadsheets/d/1tFbqR0LCjSuVWaxrKx4OQ76YuKxn61yQ/edit#gid=408539925;
//        if (isset($import)){
//            return redirect()->back()->with('error', 'Form excel sai định dạng, bạn có thể tải file mẫu')->withInput();
//        }
        foreach ($import[0] as $key => $value) {
            $data[$key]['username']  = $value['Tên đăng nhập'];
            $data[$key]['full_name'] = $value['Họ tên'];
            $data[$key]['email']        = $value['Email'];
            $data[$key]['phone']         = $value['Số điện thoại'];
            $data[$key]['address']     = $value['Địa chỉ'];
            $data[$key]['job']    =  $value['Nghề nghiệp'];
            $data[$key]['company']       = $value['Công ty'];
            $data[$key]['created_at']       = date('Y-m-d',strtotime($value['Ngày đăng ký']));
        }
        dd($data);
//        dd(sizeof($data));
        if (sizeof($data) == 0)
        {
            return redirect()->back()->with('error', 'File excel trống')->withInput();
        }
        if (sizeof($data)>0) {
            foreach ($data as $key => $value) {
//                dd($value);
                $email = Customer::where('email', 'like', '%' . $value['email'] . '%')->first();
//                dd($email['email']);
                $phone = Customer::where('phone', 'like', '%' . $value['phone'] . '%')->first();
                $username = Customer::where('username', 'like', '%' . $value['username'] . '%')->first();
                if ($value['email'] == '') {
                    redirect()->back()->with('error', 'Trường email trống')->withInput();
                    break;
                } elseif($value['phone'] == ''){
                    return redirect()->back()->with('error', 'Trường số điện thoại trống')->withInput();
                } elseif(isset($value['email']) ?? $email['email']){
                    return redirect()->back()->with('error', 'Trường email trùng')->withInput();
                } elseif($value['phone'] == $phone->phone){
                    return redirect()->back()->with('error', 'Trường số điện thoại trùng')->withInput();
                } elseif($value['username'] == $username->username ){
                    return redirect()->back()->with('error', 'Trường email trùng')->withInput();
                }else
                $customer = new Customer();
                $customer->username = $value['username'];
                $customer->full_name = $value['full_name'];
                $customer->email = $value['email'];
                $customer->phone = $value['phone'];
                $customer->address = $value['address'];
                $customer->job = $value['job'];
                $customer->company = $value['company'];
                $customer->created_at = Carbon::parse($value['created_at']);

                $customer->save();
            }
        }
        return redirect()->back()->with('success', 'Nhập file thành công')->withInput();
    }
    public function viewReadExcel()
    {
        return view('admin.import');
    }
    public function readExcel(ImportCsvRequest $request)
    {
        $path = $request->file('file');

        $import = \Excel::toArray(new CustomersImport, $path);
        $data = [];
        foreach ($import[0] as $key => $value) {
            if (!isset($value['Tên đăng nhập']) || !isset($value['Họ tên']) || !isset($value['Email']) || !isset($value['Số điện thoại']) || !isset($value['Địa chỉ']) || !isset($value['Nghề nghiệp']) || !isset($value['Công ty']) || !isset($value['Ngày đăng ký']))
                return redirect()->back()->with('error', 'File excel không đúng định dạng')->withInput();
            else{
                $data[$key]['username']  = $value['Tên đăng nhập'];
                $data[$key]['full_name'] = $value['Họ tên'];
                $data[$key]['email']     = $value['Email'];
                $data[$key]['phone']     = $value['Số điện thoại'];
                $data[$key]['address']   = $value['Địa chỉ'];
                $data[$key]['job']       =  $value['Nghề nghiệp'];
                $data[$key]['company']   = $value['Công ty'];
                $data[$key]['created_at'] = date('Y-m-d',strtotime($value['Ngày đăng ký']));
            }
        }
        if (sizeof($data) == 0)
        {
            return redirect()->back()->with('error', 'File excel trống')->withInput();
        }
        if (sizeof($data) > 0) {
            foreach ($data as $key => $value) {
                $customer = new Import();
                $customer->username = $value['username'];
                $customer->full_name = $value['full_name'];
                $customer->email = $value['email'];
                $customer->phone = $value['phone'];
                $customer->address = $value['address'];
                $customer->job = $value['job'];
                $customer->company = $value['company'];
                $customer->created_at = Carbon::parse($value['created_at']);

                $customer->save();
            }
        }
        return view('admin.import', compact('data'));
    }
    public function viewCheckData()
    {
        $listExcel = $this->import->getAll();
        $totalListExcel = $this->import->getCount();
        $listExcels = [];
        foreach ($listExcel as $item) {
            $email = $this->customer->checkMail($item->email);
            $phone = $this->customer->checkPhone($item->phone);
            $item->status = $email ? 1 : 2;
            $item->statusphone = $phone ? 1 : 2;

            $listExcels[] = $item;
        }
//        self::importExcelCustomer($listExcels);

        return view('admin.check', compact('listExcel','email','listExcels','totalListExcel'));
    }
    public function checkExcel()
    {
        $listExcel = $this->import->getCount();
        $listExcels = [];
        foreach ($listExcel as $item) {
            $email = $this->customer->checkMail($item->email);
            $phone = $this->customer->checkPhone($item->phone);
            $item->status = $email ? 1 : 2;
            $item->statusphone = $phone ? 1 : 2;

            $listExcels[] = $item;
        }
        return $listExcels;
    }
    public function importExcelCustomer()
    {
        $listExcels = $this->checkExcel();

        $this->customer->importExcelCustomer($listExcels);
        return redirect()->route('listcustomer');
    }

    public function deleteRecordExcel($id)
    {
        $this->import->deleteRecord($id);
        return redirect()->back();
    }
}
