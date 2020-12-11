<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Customer extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'customers';

    protected $fillable = [
        'full_name', 'username', 'email', 'password', 'age', 'gender', 'phone', 'address', 'job', 'role', 'company', 'id_custumor'
    ];
    static $list_field_import_check_trung = [
         'username', 'email',  'phone'
    ];
    static $list_field_import_required = [
         'username', 'email', 'password'
    ];

    public function order()
    {
        return $this->hasMany(Order::class, 'id_user');
    }
    public function getAll()
    {
        return Customer::all();
    }

    public function listCustomer($search = null)
    {
        $listCustomer =  Customer::with('order')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        if ($search) {
            $listCustomer = Customer::where('full_name', 'like', '%' . $search . '%')
                ->orWhere('username', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->paginate(10);
            $listCustomer->appends(request()->input())->links();
        }
        return $listCustomer;
    }

    public function listCustomerExport($search = null)
    {
        $query = Customer::with('order')
            ->orderBy('created_at', 'desc');

        if ($search) {
            $listCustomer = $query->where('full_name', 'like', '%' . $search . '%')
                ->orWhere('username', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%');
        }

        return $query->get();
    }

    public function getCustomerDetail($id)
    {
        return Customer::where('_id', $id)->first();
    }
    public function getUserOrder($id)
    {
        $userOrder = Customer::with('order')
            ->orderBy('created_at', 'desc')
            ->where('_id', $id)
            ->get();
        return Order::where('id_user', $userOrder[0]->username)->paginate(10);

    }
    public function createCustomer($request)
    {
        $data = [
            'username' => $request->username,
            'password' => Hash::make($request['password']),
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'age' => (int)$request->age,
            'phone' => (int)$request->phone,
            'address' => $request->address,
            'job' => $request->job,
            'company' => $request->company,
        ];
        return Customer::create($data);
    }

    public function editCustomer($id, $request)
    {
        $data = [
            'username' => $request->username,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => (int)$request->phone,
            'age' => (int)$request->age,
            'gender' => $request->age,
            'address' => $request->address,
            'job' => $request->job,
            'company' => $request->company,
        ];
        return Customer::where('_id', $id)->update($data);
    }
    public function detailCustomer($id)
    {
        return Customer::where('_id', $id)->first();
    }
    public function deleteUser($id)
    {
        $deleteUser = Customer::findOrFail($id);
        return $deleteUser->delete();
    }
    public function importCsvCustomer($request)
    {
        if ($request->hasFile('file')) {
            $nameImage = Ultilities::uploadFile($request->file('file'));
        }
        $file = public_path($nameImage);
        $customerArr = Ultilities::csvToArray($file);
        if (count($customerArr) == 0) {
            return redirect()->back()->with('error', 'File không có dữ liệu')->withInput();
        } else {
//            dd($customerArr);
            for ($i = 0; $i < count($customerArr); $i ++) {
                if (isset($customerArr[$i]))
                {
                    return redirect()->back()->with('error', 'Không đúng định dạng mẫu form csv, bạn cần xem lại file csv')->withInput();
                } else
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
        }
    }
    public function checkUser($username)
    {
        $user = Customer::where('username', $username)->first();
        return $user;
    }
    public function checkMail($email)
    {
        $emails = Customer::where('email', $email)->first();
        return $emails;
    }
    public function checkField($field, $value)
    {
        $field = Customer::where('$field', $value)->first();
        return $field;
    }

    public function checkPhone($phone)
    {
        $phone = Customer::where('phone', $phone)->first();
        return $phone;
    }
    public function importExcelCustomer($listExcels, $id)
    {
        foreach ($listExcels as $item){
            $email = $this->checkMail($item->email);
            $phone = $this->checkPhone($item->phone);
            $user = $this->checkUser($item->username);

            $validator = Validator::make([
                'email' => $item->email,
                'phone' => $item->phone,
                ],[
                'email' => 'email',
                'phone' => 'regex: /^\+?\d{9,11}$/i',
            ]);
            if(!$validator->passes()){
                continue;
            }

            if ($item->statususer == 1 && $item->statusemail == 1 && $item->statusphone == 1) {
                $data = [
//                    'username' => $item->username,
                    'full_name' => $item->full_name,
//                    'email' => $item->email,
//                    'phone' => (int)$item->phone,
                    'address' => $item->address,
                    'job' => $item->job,
                    'company' => $item->company,
                    'updated_at' => Carbon::now(),
                ];
                $this->where('_id', $email->id)->update($data);

            } elseif ($item->statususer == 1 && $item->statusemail == 1 && $item->statusphone == 2 ) {
                $data = [
//                    'username' => $item->username,
                    'full_name' => $item->full_name,
//                    'email' => $item->email,
                    'phone' => (int)$item->phone,
                    'address' => $item->address,
                    'job' => $item->job,
                    'company' => $item->company,
                    'updated_at' => Carbon::now(),
                ];
                $this->where('_id', $email->id)->update($data);

            } elseif ($item->statususer == 1 && $item->statusemail == 2 && $item->statusphone == 2 ) {
                $data = [
//                    'username' => $item->username,
                    'full_name' => $item->full_name,
                    'email' => $item->email,
                    'phone' => (int)$item->phone,
                    'address' => $item->address,
                    'job' => $item->job,
                    'company' => $item->company,
                    'updated_at' => Carbon::now(),
                ];
                $this->where('_id', $user->id)->update($data);

            } elseif ($item->statususer == 2 && $item->statusemail == 1 && $item->statusphone == 1 ) {
                $data = [
//                    'username' => $item->username,
                    'full_name' => $item->full_name,
//                    'email' => $item->email,
//                    'phone' => (int)$item->phone,
                    'address' => $item->address,
                    'job' => $item->job,
                    'company' => $item->company,
                    'updated_at' => Carbon::now(),
                ];
                $this->where('_id', $email->id)->update($data);

            } elseif ($item->statususer == 2 && $item->statusemail == 2 && $item->statusphone == 1) {
                $data = [
                    'username' => $item->username,
                    'full_name' => $item->full_name,
                    'email' => $item->email,
//                    'phone' => (int)$item->phone,
                    'address' => $item->address,
                    'job' => $item->job,
                    'company' => $item->company,
                    'updated_at' => Carbon::now(),
                ];
                $this->where('_id', $phone->id)->update($data);

            } elseif ($item->statususer == 2 && $item->statusemail == 2 && $item->statusphone == 2) {
                $data = [
                    'username' => $item->username,
                    'full_name' => $item->full_name,
                    'email' => $item->email,
                    'phone' => (int)$item->phone,
                    'address' => $item->address,
                    'job' => $item->job,
                    'company' => $item->company,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                Customer::create($data);
            }
        }
        return $listExcels;
    }
    public static function checkFieldStatus($field, $value)
    {
        if (empty($value)){
            return 1;
        }

    }
    static function check_trung($field,$value)
    {
        $field = self::checkField($field, $value);
        return 2;
    }
}
