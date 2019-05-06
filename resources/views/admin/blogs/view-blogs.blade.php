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
                  <th>Blog ID</th>
                  <th>Author</th>
                  <th>Heading</th>
                  <th>Title</th>
                  <th>Content</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($blogs as $blog)
                <tr class="gradeX">
                  <td>{{$blog->id}}</td>
                  <td>{{$blog->author}}</td>
                  <td>{{$blog->heading}}</td>
                  <td>{{$blog->title}}</td>
                  <td>{{$blog->content}}</td>
                  <td>{{$blog->description}}</td>
                   <td>
                    @if(!empty($blog->image))
                      <img src="{{ asset('/images/backend_images/products/small/'.$blog->image) }}" style="width:60px;">
                    @endif
                  </td>   
                  <td class="center">
                     <a href="#myModal{{$blog->id}}" data-toggle="modal" class="btn btn-success btn-mini" title="View Product">View</a></div> 
                     <a href="{{url('/admin/edit_blog/'.$blog->id)}}" class="btn btn-primary btn-mini" title="Edit blog">Edit</a> 
                     <a href="{{url('/admin/add_blog_images/'.$blog->id)}}" class="btn btn-info btn-mini" title="Add Images">Add </a>
                      <a rel="{{$blog->id }}" rel1="delete_blog" <?php /* href="{{url('/admin/delete_category/'.$product->id)}}" */?> href ="javascript:" class="btn btn-danger btn-mini deleteRecord" title="Delete Product">Delete</a>
                  </td>
                </tr>
                    <div id="myModal{{$blog->id}}" class="modal hide">
                      <div class="modal-header">
                        <button data-dismiss="modal" class="close" type="button">×</button>
                        <h3>{{$blog->heading}} Full Details</h3>
                      </div>
                      <div class="modal-body">
                        <p>Blog ID: {{$blog->id}}</p>
                        <p>Author: {{$blog->author}}</p>
                        <p>Heading:{{$blog->heading}}</p>
                        <p>Title: {{$blog->title}}</p>
                        <p>Content: {{$blog->content}}</p>
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