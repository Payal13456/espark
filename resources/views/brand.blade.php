@extends('layouts.admin_app')

@section('content')
	<div class="container-fluid">
		 <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Brand</h1>
            @if(Auth::user()->role == 2)
             <a href="{{url('set-brand')}}" class="d-none d-sm-inline-block btn  btn-primary shadow-sm"><i
                    class="fas fa-plustext-white-50"></i> Add Brand</a>
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
                    	<h3>Brand List</h3>
                    	<table class="table">
                    		<thead>
                    			<tr>
                    				<td>S.No.</td>
                    				<td>Name</td>
                    				<td>Action</td>
                    			</tr>
                    		</thead>
                    		<tbody>
                    			@if(count($brand) > 0)
	                    			@foreach($brand as $k=>$c)
		                    			<tr>
		                    				<td>{{$k+1}}.</td>
		                    				<td>{{$c->brand_name}}</td>
                                            @if(Auth::user()->role == 2)
		                    				<td><a href="{{url('set-brand')}}/{{$c->id}}" class="btn btn-sm btn-primary">Edit</a> <a href="{{url('delete-brand')}}/{{$c->id}}" class="btn btn-sm btn-danger">Delete</a></td>
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