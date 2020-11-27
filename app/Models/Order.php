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
        return Order::orderBy('created_at', 'desc')
            ->paginate(10);
    }
    public function getOrderDetail($id)
    {
        return Order::where('_id', $id)->first();
    }
    public function createOrder($request)
    {
        $data = [
            'id_user' => $request->id_user,
            'id_product' => $request->id_product,
            'total_price' => $request->total_price,
            'address' => $request->address,
            'orderdate' => $request->orderdate,
            'phone' => $request->phone,
            'email' => $request->email,
            'payment' => $request->payment,
            'status' => 1
        ];
        Order::create($data);
    }
    public function updateOrder($request, $id)
    {
        $data = [
            'id_user' => $request->id_user,
            'id_product' => $request->id_product,
            'total_price' => $request->total_price,
            'address' => $request->address,
            'orderdate' => $request->orderdate,
            'phone' => $request->phone,
            'email' => $request->email,
            'payment' => $request->payment,
            'status' => $request->order_status,
        ];
//        dd($data);
        $this->where('_id', $id)->update($data);
    }
    public function deleteOrder($id)
    {
        $deleteOrder = Order::findOrFail($id);
        $deleteOrder->delete();
    }
}
