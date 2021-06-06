@extends('layouts.admin_app')

@section('content')
	<div class="container-fluid">
		 <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Set Category</h1>
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
                    	<h3>@if(isset($category)) Edit @else Add  @endif Category</h3>
                    	<form method="post" action="{{url('add-category')}}">
                    		@csrf
                    		<div class="form-group col-md-3">
                    			<label for="name">Category Name</label>
                    			<input type="text" name="category_name" id="name" class="form-control" @if(isset($category)) value="{{$category->category_name}}" @endif>
                                <input type="hidden" name="id" @if(isset($category)) value="{{$category->id}}"  @endif>
                    		</div>
                    		<div class="form-group col-md-3">
                    			<button type="submit" class="btn btn-primary">@if(isset($category)) Edit @else Add  @endif Category</button>
                    		</div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
	</div>
@stop