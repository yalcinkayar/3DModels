<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('category.index',[
            'success'=>true,
            'categories'=>$categories
        ]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {

        $new_category = Category::create([
                'category_name'=>$request->category_name
        ]);
        
  
        return back()->with('success','Added');
              
    }


    public function edit($id)
    {
        $category = Category::where('id', '=', $id)->get();

        return view('category.edit',[
            'success'=>true,
            'category'=>$category
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $category = Category::where('id',$id)->first();
        
        if($category != NULL){
            
            $request_new = $request->except('_token','submit');
         
            $update = Category::whereId($id)->update($request_new);

            if($update){
                return redirect()->back()->with('status', 'Kategori Düzenlendi');
            }else{
                return redirect()->back()->with('status', 'Kategori Düzenlenemedi');
            }
        }
    }


    public function delete($id)
    {
        $category = Category::where('id', '=', $id)->delete();
        $subcategory = SubCategory::where('category_id', '=', $id)->delete();

        if($category){
            return redirect()->route('category.index')->with('status', 'Kategori Silindi');
        }else{
            return redirect()->route('category.index')->with('status', 'Kategori Silinemedi');
        }
    }

    public function categoryGetData(Request $request)
    {
        $x = Category::select('id', 'category_name');

        return Datatables($x)
        ->addColumn('edit', function($x){
            return '<a style="text-decoration:none;" href="'.route('category.edit', ['id' => $x->id]).'">Edit</a>';
        })
        ->addColumn('delete', function($x){
            return '<a style="text-decoration:none;" href="'.route('category.delete', ['id' => $x->id]).'">Delete</a>';
        })
        ->rawColumns(['edit','delete'])
        ->make(true);
    }
}
