@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Packages</a> <a href="#" class="current">View Packages</a> </div>
    <h1>Packages</h1>
     @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{!! session('flash_message_error') !!}</strong>
            </div>        
        @endif
        @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>        
        @endif
  </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Packages</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Category Nmae</th>
                  <th>Designs</th>
                  <th>Designer(s)</th>
                  <th>Revisions</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
               
              	@foreach($packages as $package)
                <tr class="gradeX">
                  <td>{{$package->category_name}}</td>
                  <td>{{$package->designs}}</td>
                  <td>{{$package->designers}}</td>
                  <td>{{$package->revisions}}</td>
                  <td>{{$package->price}}</td>
                   <td>
                    @if(!empty($package->image))
                      <img src="{{ asset('/images/backend_images/products/small/'.$package->image) }}" style="width:60px;">
                    @endif
                  </td>   
                  <td class="center">
                     <a href="#myModal{{$package->id}}" data-toggle="modal" class="btn btn-success btn-mini" title="View Product">View</a></div> 
                     <a href="{{url('/admin/edit_product/'.$package->id)}}" class="btn btn-primary btn-mini" title="Edit package">Edit</a> 
                     <a href="{{url('/admin/add_images/'.$package->id)}}" class="btn btn-info btn-mini" title="Add Images">Add </a>
                      <a rel="{{ $package->id }}" rel1="delete_job" <?php /* href="{{url('/admin/delete_category/'.$product->id)}}" */?> href ="javascript:" class="btn btn-danger btn-mini deleteRecord" title="Delete Product">Delete</a>
                  </td>
                </tr>
                    <div id="myModal{{$package->id}}" class="modal hide">
                      <div class="modal-header">
                        <button data-dismiss="modal" class="close" type="button">×</button>
                        <h3>{{$package->designs}} Full Details</h3>
                      </div>
                      <div class="modal-body">
                        <p>Package ID: {{$package->id}}</p>
                        <p>Designers:{{$package->designers}}</p>
                        <p>Price: {{$package->price}}</p>
                        <p>Revisions: {{$package->revisions}}</p>
                      </div>
                    </div>

                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>

@endsection