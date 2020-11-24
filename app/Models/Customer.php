<?php

namespace App\Models;

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

    public function listCustomer()
    {
        return Customer::with('order')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }
    public function getUserorder($id)
    {
        return Customer::with('order')
            ->orderBy('created_at', 'desc')
            ->where('_id', $id)
            ->get();
    }
    public function createCustomer($request)
    {
        $data = [
            'username' => $request->username,
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
        $deleteUser = Customer::find($id);
        return $deleteUser->delete();
    }
}
