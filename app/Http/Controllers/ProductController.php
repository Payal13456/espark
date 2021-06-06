<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\SubCategory;
use App\ProductPrice;
use App\ProductDetails;
use App\ProductAttachement;
use App\Brand;
use Session;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $product = Product::with(['category','subcategory','brand','price','details'])->where('status',1)->get();
        //echo '<pre>';print_r($product);die;
    	return view('product')->with(['product'=>$product]);
    }

    public function setProduct($id = 0){
    	if($id != 0){
            $product = Product::with(['category','subcategory','brand','price','details'])->where('status',1)->where('id',$id)->first();
    		$brand = Brand::where('status',1)->get();
            $category =Category::where('status',1)->get();
            return view('set-product')->with(['brand'=>$brand,'category'=>$category,'product'=>$product]);
    	}
        $category =Category::where('status',1)->get();
        $brand = Brand::where('status',1)->get();
    	return view('set-product')->with(['brand'=>$brand,'category'=>$category]);
    }

    public function getSubcategory($id){
        $subcategory = SubCategory::where('category_id',$id)->get();
        $res = "";
        $res .= "<option value=''>Select SubCategory</option>";
        if(count($subcategory) > 0){
            foreach ($subcategory as $key => $value) {
                $res .= "<option value='".$value->id."'>".$value->subcategory_name."</option>";
            }
        }

        return $res;
    }

    public function AddProduct(Request $request){
        if(empty($request->id)){
            DB::beginTransaction();
                $productData = [
                                'name'=> $request->product_name,
                                'sku'=> $request->sku,
                                'category_id'=> $request->category_id,
                                'subcategory_id'=> $request->subcategory_id,
                                'brand_id'=> $request->brand_id,
                                'description'=> $request->description
                            ];
                $product_id = Product::insertGetId($productData);

                $priceData = [
                        'sell_type'=> $request->sell_type,
                        'price'=> $request->price,
                        'stock'=> $request->stock,
                        'product_id' => $product_id
                    ];
                ProductPrice::insert($priceData);

                $descData = [
                        'overview'=>$request->overview,
                        'specification'=>$request->specification,
                        'easy_return'=>$request->easy_return,
                        'product_id'=>$product_id
                    ];
                ProductDetails::insert($descData);

            DB::commit();
        }else{
            DB::beginTransaction();
                $productData = [
                                'name'=> $request->product_name,
                                'sku'=> $request->sku,
                                'category_id'=> $request->category_id,
                                'subcategory_id'=> $request->subcategory_id,
                                'brand_id'=> $request->brand_id,
                                'description'=> $request->description
                            ];
                $product_id = Product::where('id',$request->id)->update($productData);

                $priceData = [
                        'sell_type'=> $request->sell_type,
                        'price'=> $request->price,
                        'stock'=> $request->stock,
                        'product_id' => $request->id
                    ];
                ProductPrice::where('product_id',$request->id)->update($priceData);

                $descData = [
                        'overview'=>$request->overview,
                        'specification'=>$request->specification,
                        'easy_return'=>$request->easy_return,
                        'product_id'=>$request->id
                    ];
                ProductDetails::where('product_id',$request->id)->update($descData);

            DB::commit();
        }

    	Session::flash('success', 'Product Updated Successfully!');
        return redirect('products');
    }	

    public function deleteProduct($id){
    	$product = Product::find($id);
    	$product->status = 0;
    	$product->save();

        $ProductPrice = ProductPrice::where('product_id',$id)->first();
        $ProductPrice->status = 0;
        $ProductPrice->save();

        $desc = ProductDetails::where('product_id',$id)->first();
        $desc->status = 0;
        $desc->save();

    	Session::flash('success', 'Product Deleted Successfully!');
        return redirect('products');
    }
}
