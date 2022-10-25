<?php

namespace App\Http\Controllers\api\product;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductsImage;

class indexController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->get();;

        //if($products->images){
        //dd($products);
        //}

      
        /*Product::select(
            'products.id as id', 'products.title as title', 'products.price as price', 'products.description as description'
        )
        ->get();//Product::all();

        $images = ProductsImage::select(
            'products_images.id as images_id', 'products_images.products_id as products_id', 'products_images.image as image_path'
        )
        ->get();*/

        return response()->json([
            'success'=>true,
            'data'=>$products
        ]);
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        
        return response()->json([
            'success'=>true,
            'product'=>$product
        ]);
    }
}
