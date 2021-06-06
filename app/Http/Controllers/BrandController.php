<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use Session;

class BrandController extends Controller
{
    public function index(){
    	$brand = Brand::where('status',1)->get();
    	return view('brand')->with(['brand'=>$brand]);
    }

    public function setBrand($id = 0){
    	if($id != 0){
    		$brand = Brand::find($id);
    		return view('set-brand')->with(['brand'=>$brand]);
    	}
    	return view('set-brand');
    }

    public function AddBrand(Request $request){
    	$brand = Brand::findOrNew($request->id);
    	$brand->brand_name = $request->brand_name;
    	$brand->save();
    	
    	Session::flash('success', 'Brand Updated Successfully!');
        return redirect('brand');
    }	

    public function deleteBrand($id){
    	$brand = Brand::find($id);
    	$brand->status = 0;
    	$brand->save();

    	Session::flash('success', 'Brand Deleted Successfully!');
        return redirect('brand');
    }
}
