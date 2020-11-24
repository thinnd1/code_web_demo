<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Shop extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'shops';

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_shop', 'address', 'email', 'phone', 'quantity_product'
    ];
    public function getShop()
    {
        return Shop::paginate(5);
    }
    public function getShopDetail($id)
    {
        return Shop::where('_id', $id)->first();
    }
    public function createShop($request)
    {
        $data = [
            'name_shop' => $request->name_shop,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'quantity_product' => $request->quantity_product,
        ];
        Shop::create($data);
    }
    public function updateCompany($request, $id)
    {
        $data = [
            'name_shop' => $request->name_shop,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'quantity_product' => $request->quantity_product,
        ];
        return Shop::where('_id', $id)->update($data);
    }
    public function deleteShop($id)
    {
        $removeShop = Shop::find($id);
        return $removeShop->delete();
    }
}
