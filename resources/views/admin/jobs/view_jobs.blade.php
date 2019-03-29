@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Jobs</a> <a href="#" class="current">View Jobs</a> </div>
    <h1>Jobs</h1>
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
            <h5>View Jobs</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Job ID</th>
                  <th>Category ID</th>
                  <th>Job Name</th>
                  <th>Job Code</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($jobs as $job)
                <tr class="gradeX">
                  <td>{{$job->id}}</td>
                  <td>{{$job->category_name}}</td>
                  <td>{{$job->staff_name}}</td>
                  <td>{{$job->job_code}}</td>
                  <td>{{$job->price}}</td>
                   <td>
                    @if(!empty($job->image))
                      <img src="{{ asset('/images/backend_images/products/small/'.$job->image) }}" style="width:60px;">
                    @endif
                  </td>   
                  <td class="center">
                     <a href="#myModal{{$job->id}}" data-toggle="modal" class="btn btn-success btn-mini" title="View Product">View</a></div> 
                     <a href="{{url('/admin/edit_product/'.$job->id)}}" class="btn btn-primary btn-mini" title="Edit job">Edit</a> 
                     <a href="{{url('/admin/add_images/'.$job->id)}}" class="btn btn-info btn-mini" title="Add Images">Add </a>
                      <a rel="{{ $job->id }}" rel1="delete_job" <?php /* href="{{url('/admin/delete_category/'.$product->id)}}" */?> href ="javascript:" class="btn btn-danger btn-mini deleteRecord" title="Delete Product">Delete</a>
                  </td>
                </tr>
                    <div id="myModal{{$job->id}}" class="modal hide">
                      <div class="modal-header">
                        <button data-dismiss="modal" class="close" type="button">×</button>
                        <h3>{{$job->staff_name}} Full Details</h3>
                      </div>
                      <div class="modal-body">
                        <p>Job ID: {{$job->id}}</p>
                        <p>Category ID: {{$job->category_name}}</p>
                        <p>Job Code:{{$job->job_code}}</p>
                        <p>Price: {{$job->price}}</p>
                        <p>Description: {{$job->description}}</p>
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