@extends('layouts.admin_app')

@section('content')
	<div class="container-fluid">
		 <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Set SubCategory</h1>
           <!--  <a href="#" class="d-none d-sm-inline-block btn  btn-primary shadow-sm"><i
                    class="fas fa-plustext-white-50"></i> Add Category</a> -->
        </div>
         @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
        	<div class="col-xl-12 col-md-12 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                    	<h3>@if(isset($subcategory)) Edit @else Add  @endif SubCategory</h3>
                    	<form method="post" action="{{url('add-subcategory')}}">
                    		@csrf
                            <div class="form-group col-md-3">
                                <label>Select Category</label>
                                <select class="form-control" name="category_id">
                                    @if(count($category) > 0)
                                        @foreach($category as $c)
                                            <option value="{{$c->id}}" @if(isset($subcategory) && $subcategory->category_id == $c->id)  selected @endif>{{$c->category_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                    		<div class="form-group col-md-3">
                    			<label for="name">SubCategory Name</label>
                    			<input type="text" name="subcategory_name" id="name" class="form-control" @if(isset($subcategory)) value="{{$subcategory->subcategory_name}}" @endif>
                                <input type="hidden" name="id" @if(isset($subcategory)) value="{{$subcategory->id}}"  @endif>
                    		</div>
                    		<div class="form-group col-md-3">
                    			<button type="submit" class="btn btn-primary">@if(isset($subcategory)) Edit @else Add  @endif SubCategory</button>
                    		</div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
	</div>
@stop