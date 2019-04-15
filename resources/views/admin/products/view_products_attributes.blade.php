@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id=" content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Service</a> <a href="#" class="current"> Packages</a> </div>
    <h1>Service Packages</h1>
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
          <div class="widget-title"> 
          <div class="row-fluid">
            <div class="span12">
              <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                  <h5>View Services Attributes</h5>
                </div>
                <div class="widget-content nopadding">
                  <form action="" method="post">
                    {{csrf_field()}}
                      <table class="table table-bordered data-table">
                        <thead>
                          <tr>
                            <th>Attribute ID</th>
                            <th>Category</th>
                            <th>Designs</th>
                            <th>Designers</th>
                            <th>Revisions</th>
                            <th>Price</th>
                            <th>Guarantee</th>
                             <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($productsattributes as $attribute)
                          <tr class="gradeX">
                            <td><input type="hidden" name="idAttr[]" value="{{$attribute->id}}">{{$attribute->id}}</td>
                            <td>{{$attribute->category_name}}</td>
                            <td>{{$attribute->designs}}</td>
                            <td>{{$attribute->designers}}</td>
                            <td>{{$attribute->revisions}}</td>
                            <td><input type="text" name="price[]" value="{{$attribute->price}}"></td>
                            <td><input type="text" name="guarantee[]" value="{{$attribute->guarantee}}"></td>
                            <td class="center">
                                <input type="submit" value="update" class="btn btn-primary btn-mini">
                                <a rel="{{ $attribute->id }}" rel1="delete_attribute" href ="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                            </td>
                          </tr>   
                        </div>
                        @endforeach
                        </tbody>
                      </table>
                  </form> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection