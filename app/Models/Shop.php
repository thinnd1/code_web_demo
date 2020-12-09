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
    public function getShop($search = null)
    {
        $listCompany =  Shop::orderBy('created_at', 'desc')
            ->paginate(10);
        if ($search) {
            $listCompany = Shop::where('name_shop', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->paginate(10);
            $listCompany->appends(['search' => $search]);
        }
        return $listCompany;
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
        $removeShop = Shop::findOrFail($id);
        return $removeShop->delete();
    }
    public function getAll()
    {
        return Shop::all();
    }
}
