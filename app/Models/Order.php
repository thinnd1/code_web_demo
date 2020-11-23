<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Order extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'orders';

    const ORDER_NEW = 1;
    const ORDER_PROCESS = 2;
    const ORDER_DONE = 3;
    const ORDER_CANCEL = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'id_product', 'total_price', 'address', 'orderdate', 'phone', 'email', 'status','payment'
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_custumor');
    }
    public function getOrder()
    {
        return Order::paginate(5);
    }
    public function createOrder()
    {
        $data = [
            'id_user' => '5fb4e7d5986a000045007362',
            'id_product' => 'The Fault in Our Stars',
            'total_price' => 150000,
            'address' => '58 nguyen khanh toan, quan cau giay, ha noi',
            'orderdate' => '',
            'phone' => 123456789,
            'email' => 'nguyendangthin@gmail.com',
            'payment' => 'zalo',
            'status' => 4
        ];
        Order::create($data);
    }
    public function editOrder($id, $request)
    {
        $data = [
            'id_user' => $request->id_user,
            'id_product' => $request->id_product,
            'total_price' => $request->total_price,
            'address' => $request->address,
            'orderdate' => $request->orderdate,
            'phone' => $request->phone,
            'email' => $request->email,
            'status' => $request->status,
            'payment' => $request->payment,
        ];
        $this->where('_id', $id)->update($data);
    }
    public function deleteOrder($id)
    {
        $deleteOrder = Order::find($id);
        $deleteOrder->delete();
    }
}
