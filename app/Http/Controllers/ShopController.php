<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $shop;

    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }

    public function getShop(Request $request)
    {
        $search = trim($request->input('search_company'));
        $shops = $this->shop->getShop($search);
        return view('admin.shop', compact('shops'));
    }
    public function createShop(CompanyRequest $request)
    {
        $this->shop->createShop($request);
        return redirect()->route('shop');
    }
    public function viewCreateShop()
    {
        return view('admin.create_company');
    }
    public function editCompany($id)
    {
        $shopDetail = $this->shop->getShopDetail($id);
        return view('admin.edit_company', compact('shopDetail'));
    }
    public function updateCompany(CompanyRequest $request, $id)
    {
        $this->shop->updateCompany($request, $id);
        return redirect()->route('shop');
    }
    public function deleteShop($id)
    {
        $this->shop->deleteShop($id);
        return redirect()->route('shop');
    }

}
