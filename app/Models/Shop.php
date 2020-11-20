<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'name_shop', 'address', 'mail', 'phone', 'quantity_product'
    ];
    public function getShop()
    {
        return Shop::all();
    }
    public function createShop()
    {
        $data = [
            'name_company' => 'Iphone 6',
            'address' => '85 Vu Trong Phung',
            'mail' => 'hapulico@vccorp.com',
            'phone' => 987654321,
            'user_company' => "nguyenthin",
            'quantity_product' => 100,
        ];
        Shop::create($data);
    }
    public function deleteShop($id)
    {
        $removeShop = Shop::find($id);
        return $removeShop->delete();
    }
}
