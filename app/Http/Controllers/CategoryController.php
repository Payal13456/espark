<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;

class CategoryController extends Controller
{
    public function index(){
    	$category = Category::where('status',1)->get();
    	return view('category')->with(['category'=>$category]);
    }

    public function setCategory($id = 0){
    	if($id != 0){
    		$category = Category::find($id);
    		return view('set-category')->with(['category'=>$category]);
    	}
    	return view('set-category');
    }

    public function AddCategory(Request $request){
    	$category = Category::findOrNew($request->id);
    	$category->category_name = $request->category_name;
    	$category->save();
    	
    	Session::flash('success', 'Category Updated Successfully!');
        return redirect('category');
    }	

    public function deleteCategory($id){
    	$category = Category::find($id);
    	$category->status = 0;
    	$category->save();

    	Session::flash('success', 'Category Deleted Successfully!');
        return redirect('category');
    }
}
