@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id=" content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Package</a> <a href="#" class="current">Add A Package</a> </div>
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
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add A Package</h5>
          </div>
          <div class="widget-content nopadding">
            <form  enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/add_package')}}" name="add_package" id="add_package" novalidate="novalidate">
              {{ csrf_field()}}
              <div class="control-group">
                <label class="control-label">Under Category</label>
                <div class="controls">
                  <select name="category_name" id="category_name" style="width: 220px;">  
                    <?php echo $categories_dropdown; ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Number of Designs</label>
                <div class="controls">
                  <input type="text" name="designs" id="designs">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Number of Designers</label>
                <div class="controls">
                  <input type="text" name="designer" id="designer">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Revisions</label>
                <div class="controls">
                  <textarea name="revisions" id="revisions"></textarea>
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Gurantee</label>
                <div class="controls">
                  <textarea name="gurantee" id="gurantee"></textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Price</label>
                <div class="controls">
                  <input type="text" name="price" id="price">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                  <input type="file" name="image" id="image">
                </div>
              </div>
            
              <div class="form-actions">
                <input type="submit" value="Add Package" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection