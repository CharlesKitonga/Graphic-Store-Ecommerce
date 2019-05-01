@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Testimonials</a> <a href="#" class="current">View Testimonials</a> </div>
    <h1>Testimonials</h1>
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
            <h5>View Testimonials</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Customer ID</th>
                  <th>Customer Name</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($testimonials as $testimonial)
                <tr class="gradeX">
                  <td>{{$testimonial->id}}</td>
                  <td>{{$testimonial->customer_name}}</td>
                  <td>{{$testimonial->description}}</td>
                   <td>
                    @if(!empty($testimonial->image))
                      <img src="{{ asset('/images/backend_images/products/small/'.$testimonial->image) }}" style="width:60px;">
                    @endif
                  </td>   
                  <td class="center">
                     <a href="#myModal{{$testimonial->id}}" data-toggle="modal" class="btn btn-success btn-mini" title="View Product">View</a></div>  
                      <a rel="{{ $testimonial->id }}" rel1="delete_testimonial" <?php /* href="{{url('/admin/delete_category/'.$product->id)}}" */?> href ="javascript:" class="btn btn-danger btn-mini deleteRecord" title="Delete Product">Delete</a>
                  </td>
                </tr>
                    <div id="myModal{{$testimonial->id}}" class="modal hide">
                      <div class="modal-header">
                        <button data-dismiss="modal" class="close" type="button">×</button>
                        <h3>{{$testimonial->customer_name}} Full Details</h3>
                      </div>
                      <div class="modal-body">
                        <p>Customer ID: {{$testimonial->id}}</p>
                        <p>Customer Name:{{$testimonial->customer_name}}</p>
                        <p>Description: {{$testimonial->description}}</p>
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