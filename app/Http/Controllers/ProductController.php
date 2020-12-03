<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct(Request $request)
    {
        try {
            $search = trim($request->input('search_product'));
            $products = $this->product->getProduct($search);
            return view('admin.product', compact('products'));
        } catch  (\Exception $ex) {
            return redirect()->back()->with('error', 'ID không tồn tại')->withInput();
        }
    }
    public function createProduct(ProductRequest $request)
    {
        try {
            $this->product->createProduct($request);
            return redirect()->route('product');
        } catch  (\Exception $ex) {
            return redirect()->back()->with('error', 'ID không tồn tại')->withInput();
        }
    }
    public function viewCreateProduct()
    {
        return view('admin.create_product');
    }
    public function viewEditproduct($id)
    {
        try {
            $products = $this->product->getProductDetail($id);
            if (is_null($products)){
                return redirect()->route('404-notfound');
            }
            return view('admin.edit_product', compact('products'));
        } catch  (\Exception $ex) {
            return redirect()->back()->with('error', 'ID không tồn tại')->withInput();
        }
    }
    public function editProduct(ProductRequest $request, $id)
    {
        try {
            $this->product->editProduct($request, $id);
            return redirect()->route('product');
        } catch  (\Exception $ex) {
            return redirect()->back()->with('error', 'ID không tồn tại')->withInput();
        }
    }
    public function deleteProduct($id)
    {
        try {
            $this->product->deleteProduct($id);
            return redirect()->route('product');
        } catch  (\Exception $ex) {
            return redirect()->back()->with('error', 'ID không tồn tại')->withInput();
        }
    }
}
