<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $shop;

    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }

    public function getShop()
    {
        $shops = $this->shop->getShop();
        return view('admin.shop', compact('shops'));
    }
    public function createShop()
    {
        return $this->shop->createShop();
    }
    public function deleteShop($id)
    {
        $this->shop->deleteShop($id);
        return redirect()->route('shop');
    }

}
