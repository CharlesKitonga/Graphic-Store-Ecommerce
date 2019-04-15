@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id=" content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="#" class="current">Add Category  Packages</a> </div>
    <h1>Categorie's Packages</h1>
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
            <h5>Add Category Packages</h5>
          </div>
          <div class="widget-content nopadding">
            <form  enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/add_category_attributes/'.$productDetails->category_name)}}" name="add_attributes" id="add_attributes">
              {{ csrf_field()}}
              <input type="hidden" name="product_id" value="{{$productDetails->id}}">
              <div class="control-group">
                <label class="control-label">Category Name</label>
                <label class="control-label"><strong >{{$productDetails->category_name}}</strong></label>
              </div>
                 <div class="control-group">
                <label class="control-label">Category Code</label>
                <label class="control-label" style="margin-left: -51px;"><strong>{{$productDetails->url}}</strong></label>
              </div>
              <div class="control-group">
                <label class="control-label"></label>
                <div class="field_wrapper">
                  <div>
                    <input required="" type="text" name="designs[]" id="designs" placeholder="Designs" style="width: 120px"  />
                    <input required="" type="text" name="designers[]" id="designers" placeholder="Designers" style="width: 120px"  />
                    <input required="" type="text" name="revisions[]" id="revisions" placeholder="Revisions" style="width: 120px"  />
                    <input required="" type="text" name="price[]" id="price" placeholder="Price" style="width: 120px"  />
                    <input required="" type="text" name="guarantee[]" id="guarantee" placeholder="Guarantee" style="width: 120px"  />
                    <input required="" type="file" name="image" id="image" placeholder="Image" style="width: 120px"  />

                    <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                  </div>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Attributes" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection