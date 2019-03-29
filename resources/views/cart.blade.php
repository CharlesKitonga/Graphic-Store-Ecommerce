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
	<div class="cart-items">
		<div class="container">
			<h3 class="wow fadeInUp animated" data-wow-delay=".5s">My Cart</h3>
			@foreach($userCart as $cart)
			<div class="cart-header wow fadeInUp animated" data-wow-delay=".5s">
				<a class="alert-close" href="{{url('/cart/delete_cart/'.$cart->id)}}"></a>
				<div class="cart-sec simpleCart_shelfItem">
					<div class="cart-item cyc">
						<a href="single.html"><img src="{{ asset('images/backend_images/products/small/'.$cart->image)}}" class="img-responsive" alt=""></a>
					</div>
					<div class="cart-item-info">
						<h4><a href="single.html">{{$cart->designs}}</a></h4>
						<ul>
							<p>Designers :{{$cart->designers}}</p>
						</ul>
						<div class="delivery">
							<p style="font-size: 16px; font-family: sans-serif;">Revisions : {{$cart->revisions}}</p>
							<br><br><br>
							<p style=" font-size: 16px;font-family: sans-serif;">Price : $ {{$cart->price}}</p>
							<div class="clearfix"></div>
						</div>	
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<!--//cart-items-->	
@endsection