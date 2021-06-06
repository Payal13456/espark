@extends('layouts.admin_app')

@section('content')
	<div class="container-fluid">
		 <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Products</h1>
            @if(Auth::user()->role == 2)
             <a href="{{url('set-product')}}" class="d-none d-sm-inline-block btn  btn-primary shadow-sm"><i
                    class="fas fa-plustext-white-50"></i> Add Product</a>
            @endif
        </div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
      
        <div class="row">
        	<div class="col-xl-12 col-md-12 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                    	<h3>Product List</h3>
                    	<table class="table">
                    		<thead>
                    			<tr>
                    				<td>S.No.</td>
                    				<td>Name</td>
                    				<td>SKU</td>
                    				<td>Category</td>
                    				<td>Sub Category</td>
                    				<td>Brand</td>
                    				<td>Status</td>
                    				<td>Description</td>
                    				<td>Sell Type</td>
                    				<td>Price</td>
                    				<td>Stock</td>
                    				<td>Product Overview</td>
                    				<td>Specification</td>
                    				<td>Easy Returns</td>
                    				<td>Action</td>
                    			</tr>
                    		</thead>
                    		<tbody>
                    			@foreach($product as $k=>$c)
	                    			<tr>
	                    				<td>{{$k+1}}.</td>
	                    				<td>{{$c->name}}</td>
	                    				<td>{{$c->sku}}</td>
	                    				<td>{{$c->category->category_name}}</td>
	                    				<td>{{$c->subcategory->subcategory_name}}</td>
	                    				<td>{{$c->brand->brand_name}}</td>
	                    				<td>@if($c->status == 1) Active @else In-Active @endif</td>
	                    				<td>{{$c->description}}</td>
	                    				<td>Type - {{$c->price->sell_type}}</td>
	                    				<td>{{$c->price->price}}</td>
	                    				<td>{{$c->price->stock}}</td>
	                    				<td>{!! $c->details->overview !!}</td>
	                    				<td>{!! $c->details->specification !!}</td>
	                    				<td>{!! $c->details->easy_return !!}</td>
	                    				@if(Auth::user()->role == 2)
	                    				<td><a href="{{url('set-product')}}/{{$c->id}}" class="btn btn-sm btn-primary">Edit</a> <a href="{{url('delete-product')}}/{{$c->id}}" class="btn btn-sm btn-danger">Delete</a></td>
	                    				@else
	                    				<td></td>
	                    				@endif
	                    			</tr>
                    			@endforeach
                    			<!-- <tr>
                    				<td>1.</td>
                    				<td>Test</td>
                    				<td><a href="javascript:void(0);" class="btn btn-sm btn-primary">Edit</a> <a href="javascript:void(0);" class="btn btn-sm btn-danger">Delete</a></td>
                    			</tr> -->
                    		</tbody>
                    	</table>
                    </div>
                </div>
            </div>
        </div>
	</div>
@stop