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
use Illuminate\Support\Facades\Auth;
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
            $search = $request->input('search_user');
            $listCustomers = $this->customer->listCustomer($search);
            return view('admin.listcustomer', compact('listCustomers', 'search'));
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

    public function importCsv(ImportCsvRequest $request)
    {
        $this->customer->importCsvCustomer($request);
        return redirect()->route('listcustomer');
    }
    public function fileExport(Request $request)
    {
        $search = $request->input('search_user');
        $listCustomers = $this->customer->listCustomerExport($search);

        return Excel::download(new CustomersExport($listCustomers), 'customers-' . time() . '.xlsx');
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
        $id = uniqid();

        // read file excel

        foreach ($import[0] as $key => $value) {
            if (!isset($value['Tên đăng nhập']) )
                return redirect()->back()->with('error', 'File excel không đúng form mẫu')->withInput();
            else{
                $data[$key]['username']  = $value['Tên đăng nhập'];
                $data[$key]['full_name'] = $value['Họ tên'];
                $data[$key]['email']     = $value['Email'];
                $data[$key]['phone']     = $value['Số điện thoại'];
                $data[$key]['address']   = $value['Địa chỉ'];
                $data[$key]['job']       = $value['Nghề nghiệp'];
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
                $customer->id_file = $id;
                $customer->created_at = Carbon::parse($value['created_at']);

                $customer->save();
            }
        }
        return view('admin.import', compact('data', 'id'));
    }
    public function viewCheckData(Request $request)
    {
        try {
            $id_file = $request->input('id_file');
            $listExcel = $this->import->getAll($id_file);

            $listExcelObj = $listExcel->toArray();

            $listExcelObj = [
                [
                    "username" => "23",
                    "full_name" => "nguy345345en dang",
                    "email" => "thinnd1043.com",
                    "phone" => 865425129,
                 ]
            ];
//            dd($listExcel);

            if (!isset($listExcel)){
                return back();
            } else {
                $listExcels = [];
                foreach ($listExcelObj as $item) {
                    foreach (Customer::$list_field_import as $field=>$config)
                    {
                        $item['status_check'][$field]['status'] = Customer::checkFieldStatus($field, @$item[$field],$config);
                    }
                    $item['status_check_summary'] = Customer::checkItemStatus($item);

                    $listExcels[] = $item;
                }
            }
//        self::checkExcel($listExcels);
            return view('admin.check', compact('listExcel', 'listExcels'));

        } catch  (\Exception $ex) {
            return redirect()->back()->with('error', 'Lỗi hệ thống')->withInput();
        }
    }
    static function process_status_string($item)
    {
        $arr_status = [Customer::STATUS_TRUNG => 'Trùng', Customer::STATUS_EMPTY => 'Trống', Customer::STATUS_SAI => 'Sai', Customer::STATUS_OK => 'Mới'];
        $item['status_check'][$field]['status_str'] = $arr_status[$item['status_check'][$field]];
        return $item;
    }

    public function importExcelCustomer($id)
    {
        try {
            $listExcel = $this->import->getAll($id);
            $listExcels = [];
            foreach ($listExcel as $item) {
                $user = $this->customer->checkUser($item->username);
                $email = $this->customer->checkMail($item->email);
                $phone = $this->customer->checkPhone($item->phone);
                $item->statusemail = $email ? 1 : 2 ;
                $item->statusphone = $phone ? 1 : 2 ;
                $item->statususer = $user ? 1 : 2 ;
                $validatormail = Validator::make(['email' => $item->email],['email' => 'email']);
                $item->mailform = !$validatormail->passes() ? 1 : 2 ;
                $validatorphone = Validator::make(['phone' => $item->phone],['phone' => 'regex: /^\+?\d{9,11}$/i']);
                $item->phoneform = !$validatorphone->passes() ? 1 : 2 ;

                $listExcels[] = $item;
            }
            $excelcustomer = $this->customer->importExcelCustomer($listExcels, $id);
            return $excelcustomer;
//            return redirect()->route('listcustomer');
        }catch (\Exception $ex){
            return redirect()->back()->with('error', 'Mail không đúng định dạng')->withInput();
        }
    }

    public function deleteRecordExcel($id)
    {
        $this->import->deleteRecord($id);
//            return redirect()->back();
    }
}
