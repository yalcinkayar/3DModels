<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function index()
    {
        $sub_categories = SubCategory::all();

        return view('subcategory.index',[
            'success'=>true,
            'subcategories'=>$sub_categories
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('subcategory.create',[
            'success'=>true,
            'categories'=>$categories
        ]);
    }

    public function store(Request $request)
    {
        SubCategory::create([
                'category_id'=>$request->category_id,
                'name'=>$request->name
        ]);
        
        return back()->with('success','Added');    
    }


    public function edit($id, $category_id)
    {
        $sub_category = SubCategory::where('id', $id)->get();
        $categories = Category::all();
        //$category_id = Category::select('id')->where('id', $sub_category->category_id)->get();

        return view('subcategory.edit',[
            'success'=>true,
            'categories'=>$categories,
            'subcategory'=>$sub_category,
            'category_id'=>$category_id
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->route('subcategoryId');
        $subcategory = SubCategory::where('id',$id)->first();
        
        if($subcategory != NULL){
            
            $request_new = $request->except('_token','submit');
         
            $update = SubCategory::whereId($id)->update($request_new);

            if($update){
                return redirect()->route('subcategory.index');
            }else{
                return redirect()->route('subcategory.index');
            }
        }
    }


    public function delete($id)
    {
        $category = SubCategory::where('id', '=', $id)->delete();

        return redirect()->back('subcategory.index')->with('status', 'Alt Kategori Silindi');
    }


    public function subcategoryGetData(Request $request)
    {
        //$x = SubCategory::select('id', 'name');
        $x = SubCategory::select(
            'sub_categories.id as id', 'sub_categories.name as name', 'categories.category_name as category_name', 'categories.id as category_id'
        )
        ->leftJoin("categories", "categories.id", "=", "sub_categories.category_id")
        ->get();

        return  Datatables($x)
        ->addColumn('edit', function($x){
            return '<a style="text-decoration:none;" href="'.route('subcategory.edit', ['subcategoryId' => $x->id, 'category_id' => $x->category_id]).'">Edit</a>';
        })
        ->addColumn('delete', function($x){
            return '<a style="text-decoration:none;" href="'.route('subcategory.delete', ['subcategoryId' => $x->id, 'category_id' => $x->category_id]).'">Delete</a>';
        })
        ->rawColumns(['edit','delete'])
        ->make(true);
    }
}
