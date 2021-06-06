@extends('layouts.admin_app')

@section('content')
	<div class="container-fluid">
		 <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Set Brand</h1>
           <!--  <a href="#" class="d-none d-sm-inline-block btn  btn-primary shadow-sm"><i
                    class="fas fa-plustext-white-50"></i> Add brand</a> -->
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
                    	<h3>@if(isset($brand)) Edit @else Add  @endif Brand</h3>
                    	<form method="post" action="{{url('add-brand')}}">
                    		@csrf
                    		<div class="form-group col-md-3">
                    			<label for="name">brand Name</label>
                    			<input type="text" name="brand_name" id="name" class="form-control" @if(isset($brand)) value="{{$brand->brand_name}}" @endif>
                                <input type="hidden" name="id" @if(isset($brand)) value="{{$brand->id}}"  @endif>
                    		</div>
                    		<div class="form-group col-md-3">
                    			<button type="submit" class="btn btn-primary">@if(isset($brand)) Edit @else Add  @endif Brand</button>
                    		</div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
	</div>
@stop