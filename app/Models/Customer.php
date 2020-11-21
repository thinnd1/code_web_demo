<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Customer extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'customers';

    protected $fillable = [
        'full_name', 'username', 'email', 'password', 'age', 'gender', 'phone', 'address', 'job', 'role', 'company'
    ];

    public function listCustomer()
    {
        return Customer::orderBy('created_at', 'desc')->paginate(5);
    }
    public function createCustomer()
    {
        $data = [
            'username' => 'thinnd',
            'full_name' => 'The Fault in Our Stars',
            'gender' => 1,
            'email' => 'nguyendangthin@gmail.com',
            'age' => 30,
            'phone' => 123456789,
            'address' => '58 nguyen khanh toan, quan cau giay, ha noi',
            'job' => 'it',
            'company' => 'zalo',
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
        $deleteUser = User::find($id);
        return $deleteUser->delete();
    }
}
