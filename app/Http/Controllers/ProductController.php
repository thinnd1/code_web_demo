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

    public function getProduct()
    {
        $products = $this->product->getProduct();
        return view('admin.product', compact('products'));
    }
    public function createProduct(ProductRequest $request)
    {
        $this->product->createProduct($request);
        return redirect()->route('product');
    }
    public function viewCreateProduct()
    {
        return view('admin.create_product');
    }
    public function viewEditproduct($id)
    {
        $products = $this->product->getProductDetail($id);
        return view('admin.edit_product', compact('products'));
    }
    public function editProduct(ProductRequest $request, $id)
    {
        $this->product->editProduct($request, $id);
        return redirect()->route('product');
    }
    public function deleteProduct($id)
    {
        $this->product->deleteProduct($id);
        return redirect()->route('product');
    }
}
