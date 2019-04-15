@extends('layouts.frontLayouts.front_design')
@section('content')
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="{{url('/')}}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Check Out page</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
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
	<!--cart-items-->
	@if (sizeof(Cart::content()) > 0)
		<br><br>
	            <h2 style="margin-left: 100px;">{{ Cart::count() }} item(s) in Shopping Cart</h2>

	<div class="cart-items">
		<div class="container">
			<h3 class="wow fadeInUp animated" data-wow-delay=".5s">My Cart</h3>
            @foreach(Cart::content() as $cartItem)
			<div class="cart-header wow fadeInUp animated" data-wow-delay=".5s">
				
				<form action="{{ url('cart', [$cartItem->rowId]) }}" method="POST">
	                {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <input  type="submit" class="alert-close" value="Remove">
	            </form>
				<div class="cart-sec simpleCart_shelfItem">
					<div class="cart-item cyc">
						<a href="single.html"><img src="{{ asset('images/backend_images/products/small/'.$cartItem->model->image)}}" class="img-responsive" alt=""></a>
					</div>
					<div class="cart-item-info">
						<h2><a href="{{url('/products')}}">{{$cartItem->model->category_name}}</a></h2><br>
						<h4><a href="{{url('/products')}}">{{$cartItem->designs}}</a></h4>
						<ul>
							<p>Designers :{{$cartItem->model->designers}}</p>
						</ul>
						<div class="delivery">
							<p style="font-size: 16px; font-family: sans-serif;">Revisions : {{$cartItem->model->revisions}}</p>
							<br><br><br>
							<p style=" font-size: 16px;font-family: sans-serif;">Price : $ {{$cartItem->price}}</p>
							<div class="clearfix"></div>
						</div>	
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			@endforeach
			<li style="margin-left: 700px; font-size: 20px; font-weight: bolder;">Grand Total <span>$ {{ Cart::total() }}</span></li>
			<a style="margin-left: 1000px;  font-weight: bolder;font-size: 30px;" href="{{url('/checkout')}}"><span style="margin-top: -300px;" class="label label-primary">Proceed To Checkout</span></a>
	<!--//cart-items-->	
	</div>
			
	</div>
	@else
	<br><br>
        <h3>You have no Services in your cart</h3><br>
         <a href="{{url('/')}}" class="btn btn-primary btn-lg">Click Here To Browse for Services</a>
    @endif
@endsection