@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Pending Orders</a> <a href="#" class="current">View Orders</a> </div>
    <h1>Pending Orders</h1>
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
    <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Pending Orders</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Product</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Schedule for Delivery/Complete</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($orders as $order)
                <tr class="gradeX">
                <form method="post" action="{{url('/admin/edit_order/'.$order->id)}}">
                    {{csrf_field()}}
                    <td>{{$order->id}}</td>
                    @foreach($order->orderItems as $item)
                    <td>{{$item->product_name}}</td>   
                    <td>{{$item->pivot->quantity}}</td>
                    @endforeach
                    <td>{{$order->total}}</td>
                      <td align="center">
                        <input type="checkbox" style="margin-right: 10px;" name="status" id="status" @if($order->status=="0") checked @endif value= "0">Schedule For Delivery</input><br>
                        <input type="checkbox" style="margin-right: 10px;" name="status" id="status" @if($order->status=="1") checked @endif value= "1">Complete Order</input>
                        </td>
                    <td class="center">
                    <input type="submit" value="update" class="btn btn-primary btn-mini"> 
                      <a <?php /*id="delCat" href="{{url('/admin/delete_category/'.$category->id)}}" */?> rel ="{{$order->id}}" rel1 = "delete_order" href = "javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
                  </form>
                </tr> 
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection