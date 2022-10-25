<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductsImage;
use Image;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::all();

        return view('product.index',[
            'success'=>true,
            'products'=>$products
        ]);
    }

    public function create()
    {
        return view('product.create');
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required',
            'price'=>'required'
        ]);

        $new_product = Product::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'price'=>$request->price
        ]);
        
  
        if($request->has('photo')){
            foreach($request->file('photo') as $image){
                $imageName = $data['title'].'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move(public_path('/uploads/products/images/'),$imageName);
                ProductsImage::create([
                    'products_id'=>$new_product->id,
                    'image'=>$imageName
                ]);
            }
        }
        return back()->with('success','Added');
              
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id',$id)->first();

        return view('product.show',[
            'success'=>true,
            'product'=>$product
        ]);
    }

    public function edit($id)
    {
        //$product = Product::where('id',$id)->first();
        $product = Product::where('id', '=', $id)->get();

        return view('product.edit',[
            'success'=>true,
            'product'=>$product
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->route('productId');
        $product = Product::where('id',$id)->first();
        
        if($product != NULL){
            //$all = $request->except('_token');
            //$all['selflink'] = mHelper::permalink($all);
            
            $request_new = $request->except('_token','submit');
         
            $update = Product::whereId($id)->update($request_new);

            if($update){
                return redirect()->back()->with('status', 'Ürün Düzenlendi');
            }else{
                return redirect()->back()->with('status', 'Ürün Düzenlenemedi');
            }
        }
    }

    public function delete($id)
    {
        $product = Product::where('id', '=', $id)->delete();

        return redirect()->route('product.index');
    }

    public function getData(Request $request)
    {
        $x = Product::select('id', 'title', 'description', 'price');

        return  Datatables($x)
        ->addColumn('edit', function($x){
            return '<a style="text-decoration:none;" href="'.route('product.edit', ['productId' => $x->id]).'">Edit</a>';
        })
        ->addColumn('delete', function($x){
            return '<a style="text-decoration:none;" href="'.route('product.delete', ['productId' => $x->id]).'">Delete</a>';
        })
        ->rawColumns(['edit','delete'])
        ->make(true);
    }
}

/* ->addColumn('edit', function($x){
            return '<a href="'.route('product.edit', ['id' => $x->id]).'">Düzenle</a>';
        })
        ->addColumn('delete', function($x){
            return '<a href="'.route('product.delete', ['id' => $x->id]).'">Sil</a>';
        })
        ->rowColumns(['edit','delete']) */