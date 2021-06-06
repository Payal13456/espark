@extends('layouts.admin_app')

@section('content')
	<div class="container-fluid">
		 <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sub Category</h1>
            @if(Auth::user()->role == 2)
            <a href="{{url('set-subcategory')}}" class="d-none d-sm-inline-block btn  btn-primary shadow-sm"><i
                    class="fas fa-plustext-white-50"></i> Add SubCategory</a>
            @endif
        </div>
         @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
      
        <div class="row">
        	<div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                    	<h3>Sub Category List</h3>
                    	<table class="table">
                    		<thead>
                    			<tr>
                    				<td>S.No.</td>
                    				<td>Category Name</td>
                    				<td>SubCategory Name</td>
                    				<td>Action</td>
                    			</tr>
                    		</thead>
                    		<tbody>
                    			@if(count($subcategory) > 0)
	                    			@foreach($subcategory as $k=>$c)
		                    			<tr>
		                    				<td>{{$k+1}}.</td>
		                    				<td>{{$c->category->category_name}}</td>
		                    				<td>{{$c->subcategory_name}}</td>
                                            @if(Auth::user()->role == 2)
		                    				<td><a href="{{url('set-subcategory')}}/{{$c->id}}" class="btn btn-sm btn-primary">Edit</a> <a href="{{url('delete-subcategory')}}/{{$c->id}}" class="btn btn-sm btn-danger">Delete</a></td>
                                            @else
                                            <td></td>
                                            @endif
		                    			</tr>
	                    			@endforeach
	                    		@else
	                    			<td colspan="4" style="text-align: center;">No record Found</td>
	                    		@endif
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