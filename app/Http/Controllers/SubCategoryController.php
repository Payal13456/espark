<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;
use App\SubCategory;

class SubCategoryController extends Controller
{
    public function index(){
    	$category = Category::where('status',1)->get();
    	$subcategory = SubCategory::with('category')->where('status',1)->get();
    	// echo '<pre>';print_r($subcategory[0]->category->category_name);die;
    	return view('sub-category')->with(['category'=>$category,'subcategory'=>$subcategory]);
    }

    public function setSubCategory($id = 0){
    	if($id != 0){
    		$subcategory = SubCategory::find($id);
    		$category = Category::where('status',1)->get();
    		return view('set-subcategory')->with(['category'=>$category,'subcategory'=>$subcategory]);
    	}
    	$category = Category::where('status',1)->get();
    		return view('set-subcategory')->with(['category'=>$category]);
    }

    public function AddSubCategory(Request $request){
    	$category = SubCategory::findOrNew($request->id);
    	$category->subcategory_name = $request->subcategory_name;
    	$category->category_id = $request->category_id;
    	$category->save();
    	
    	Session::flash('success', 'SubCategory Updated Successfully!');
        return redirect('sub-category');
    }	

    public function deleteSubCategory($id){
    	$category = SubCategory::find($id);
    	$category->status = 0;
    	$category->save();

    	Session::flash('success', 'SubCategory Deleted Successfully!');
        return redirect('sub-category');
    }
}
