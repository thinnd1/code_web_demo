<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Symfony\Component\Process\Process;

class Product extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'quantity', 'title' ,'description', 'price', 'id_shop', 'vote', 'type', 'status'
    ];

    public function getProduct()
    {
        return Product::paginate(10);
    }
    public function getProductDetail($id)
    {
        return Product::where('_id', $id)->first();
    }
    public function createProduct($request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'vote' => 5,
            'type' => $request->type,
            'status' => 1
        ];

        Product::create($data);
    }
    public function editProduct($request, $id)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'vote' => 5,
            'type' => $request->type,
            'status' => 1
        ];
        $this->where('_id', $id)->update($data);
    }
    public function deleteProduct($id)
    {
        $deleteProduct = Product::findOrFail($id);
        $deleteProduct->delete();
    }
}
