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
        try {
            $search = trim($request->input('search_company'));
            $shops = $this->shop->getShop($search);
            $totalshops = $this->shop->getAll();
            return view('admin.shop', compact('shops','totalshops'));
        } catch (\Exception $ex){
            return redirect()->back()->with('error', 'ID không tồn tại')->withInput();
        }
    }
    public function createShop(CompanyRequest $request)
    {
        try {
            $this->shop->createShop($request);
            return redirect()->route('shop');
        } catch (\Exception $ex){
            return redirect()->back()->with('error', 'ID không tồn tại')->withInput();
        }
    }
    public function viewCreateShop()
    {
        return view('admin.create_company');
    }
    public function editCompany($id)
    {
        try {
            $shopDetail = $this->shop->getShopDetail($id);
            if (is_null($shopDetail)){
                return redirect()->route('404-notfound');
            }
            return view('admin.edit_company', compact('shopDetail'));
        } catch (\Exception $ex){
            return redirect()->back()->with('error', 'ID không tồn tại')->withInput();
        }
    }
    public function updateCompany(CompanyRequest $request, $id)
    {
        try {
            $this->shop->updateCompany($request, $id);
            return redirect()->back();
        } catch (\Exception $ex){
            return redirect()->back()->with('error', 'ID không tồn tại')->withInput();
        }
    }
    public function deleteShop($id)
    {
        try {
            $this->shop->deleteShop($id);
            return redirect()->route('shop');
        } catch (\Exception $ex){
            return redirect()->back()->with('error', 'ID không tồn tại')->withInput();
        }
    }

}
