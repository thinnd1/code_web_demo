<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Customer extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'customers';

    protected $fillable = [
        'full_name', 'username', 'email', 'password', 'age', 'gender', 'phone', 'address', 'job', 'role', 'company', 'id_custumor'
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
                ->paginate(10);
            $listCustomer->appends(['search' => $search]);
        }
        return $listCustomer;
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
            'age' => $request->age,
            'phone' => $request->phone,
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
            'phone' => $request->phone,
            'age' => $request->age,
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
}
