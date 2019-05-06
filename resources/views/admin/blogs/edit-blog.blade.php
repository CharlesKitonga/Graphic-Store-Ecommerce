@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id=" content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Blogs</a> <a href="#" class="current">Edit Blog</a> </div>
    <h1>Blogs</h1>
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
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Blog</h5>
          </div>
          <div class="widget-content nopadding">
            <form  enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/edit_blog/'.$blogDetails->id)}}" name="edit_blog" id="edit_blog" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">Author</label>
                <div class="controls">
                  <input type="text" name="author" id="author" value="
                  {{$blogDetails->author}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Heading</label>
                <div class="controls">
                  <input type="text" name="heading" id="heading" value="
                  {{$blogDetails->heading}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" value="
                  {{$blogDetails->title}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Content</label>
                <div class="controls">
                  <textarea name="content" id="content"> {{$blogDetails->content}}  </textarea>
                </div>   
              </div>
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea name="description" id="description"> {{$blogDetails->description}}  </textarea>
                </div>   
              </div>
            
              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                  <input type="file" name="image" id="image">
                  <input type="hidden" name="current_image" value="{{$blogDetails->image}}">
                  @if(!empty($blogDetails->image))
                  <img style="width::40px;" src="{{ asset('/images/backend_images/products/small/'.$blogDetails->image) }}"><a href="{{url('/admin/delete_blog_image/'.$blogDetails->id)}}">Delete</a>
                  @endif
                </div>
              </div>
            
              <div class="form-actions">
                <input type="submit" value="Edit Blog" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection 