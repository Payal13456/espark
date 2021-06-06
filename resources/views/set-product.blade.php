@extends('layouts.admin_app')

@section('content')
	<div class="container-fluid">
		 <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Set Product</h1>
           <!--  <a href="#" class="d-none d-sm-inline-block btn  btn-primary shadow-sm"><i
                    class="fas fa-plustext-white-50"></i> Add product</a> -->
        </div>
         @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
        	<div class="col-xl-12 col-md-12 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                    	<h3>@if(isset($product)) Edit @else Add  @endif Product</h3>
                        <hr>
                    	<form method="post" action="{{url('add-product')}}" enctype="multipart/form-data">
                    		@csrf
                            <div class="heading">
                                <h5><b>Basic Detail</b></h5>
                            </div>
                            <hr>
                            <div class="row">
                        		<div class="form-group col-md-6">
                        			<label for="name">Name</label>
                        			<input type="text" name="product_name" id="name" class="form-control" @if(isset($product)) value="{{$product->name}}" @endif required>
                                    <input type="hidden" name="id" @if(isset($product)) value="{{$product->id}}"  @endif>
                        		</div>
                                <div class="form-group col-md-6">
                                    <label for="sku">SKU</label>
                                    <input type="text" name="sku" id="sku" class="form-control" @if(isset($product)) value="{{$product->sku}}" @endif required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="category">Category</label>
                                    <select id="category" name="category_id" class="form-control" onchange="getSubcategory(this.value);" required >
                                        <option value="">Select Category</option>
                                        @foreach($category as $c)
                                            <option value="{{$c->id}}" @if(isset($product) && $product->category_id == $c->id)  selected @endif>{{$c->category_name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="subcategory">Sub Category</label>
                                    <select id="subcategory" name="subcategory_id" class="form-control" required>
                                        <option value="">Select Subcategory</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="brand">Brand</label>
                                    <select id="brand" name="brand_id" class="form-control" required>
                                        <option value="">Select Brand</option>
                                        @foreach($brand as $c)
                                            <option value="{{$c->id}}" @if(isset($product) && $product->brand_id == $c->id)  selected @endif>{{$c->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control" required>
                                        <option value="1" @if(isset($product) && $product->status == 1)  selected @endif> Active</option>
                                        <option value="0" @if(isset($product) && $product->status == 0)  selected @endif>In-Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" id="description" required>@if(isset($product)) {{$product->description}} @endif</textarea>
                                </div>
                            </div>
                           
                            <hr>
                            <div class="heading">
                                <h5><b>Product Price Detail</b></h5>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="sell_type">Sell Type</label>
                                    <select id="sell_type" name="sell_type" class="form-control" required>
                                        <option value="">Select Sell Type</option>
                                        <option value="1" @if(isset($product) && $product->price->sell_type == 1)  selected @endif>Type - 1</option>
                                        <option value="2" @if(isset($product) && $product->price->sell_type == 2)  selected @endif>Type - 2</option>
                                        <option value="3" @if(isset($product) && $product->price->sell_type == 3)  selected @endif>Type - 3</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" id="price" class="form-control" @if(isset($product)) value="{{$product->price->price}}" @endif required >
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="stock">Stock</label>
                                    <input type="text" name="stock" id="stock" class="form-control" @if(isset($product)) value="{{$product->price->stock}}" @endif required>
                                </div>
                            </div>

                            <hr>
                            <div class="heading">
                                <h5><b>Other Detail</b></h5>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="overview">Product Overview</label>
                                    <textarea name="overview" class="form-control" id="overview" required>@if(isset($product)) {{$product->details->overview }} @endif</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="specification">Specification</label>
                                    <textarea name="specification" class="form-control" id="specification" required>@if(isset($product)) {{$product->details->specification }} @endif</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="easy_return">Easy Returns</label>
                                    <textarea name="easy_return" class="form-control" id="easy_return" required>@if(isset($product)) {{$product->details->easy_return }} @endif</textarea>
                                </div>
                            </div>

                            <hr>
                            <div class="heading">
                                <h5><b>Images</b></h5>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="image">Images</label>
                                    <div class="flex" style="display: flex;">
                                        <input type="file" name="image" class="form-control">
                                        <button class="btn btn-success" type="button">+</button>
                                    </div>
                                </div>
                                
                            </div>

                    		<div class="form-group col-md-3">
                    			<button type="submit" class="btn btn-success">@if(isset($product)) Edit @else Add  @endif Product</button>
                    		</div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
	</div>
@stop
@section('script')
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'overview' );
    CKEDITOR.replace( 'specification' );

    CKEDITOR.replace( 'easy_return' );

    function getSubcategory(id){
        $.ajax({
            method : "GET",
            url : "{{url('get-subcategory')}}/"+id,
            success : function (res){
                $("#subcategory").html('');
                $("#subcategory").html(res);
            }
        })
    }

    
</script>
@stop