@extends('layouts.frontLayouts.front_design')
@section('content')
<!--breadcrumbs-->
<div class="breadcrumbs">
	<div class="container">
		<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
			<li><a href="{{url('/')}}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
			<li class="active">Single page</li>
		</ol>
	</div>
</div>
<!--//breadcrumbs-->

@if(Session::has('flash_message_success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{!! session('flash_message_success') !!}</strong>
    </div>        
@endif
<!--single-page-->
<div class="single">
@if(Session::has('flash_message_error'))
    <div class="alert alert-error alert-block" style="background-color: #f2dfd0">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{!! session('flash_message_error') !!}</strong>
    </div>        
@endif
	<div class="container">
		<div class="single-info">		
			<div class="col-md-6 single-top wow fadeInLeft animated" data-wow-delay=".5s">	
						@foreach($serviceDetails as $detail)
						<li data-thumb="{{ asset('images/backend_images/products/medium/'.$detail->image)}}">
							<div class="thumb-image"> <img src="{{ asset('images/backend_images/products/medium/'.$detail->image)}}" data-imagezoom="true" class="img-responsive" alt=""> </div>
						</li>
						@endforeach 
			</div>
			<div style="margin-left: 100px;" class="col-md-6 single-top-left simpleCart_shelfItem wow fadeInRight animated" data-wow-delay=".5s">
				@foreach($serviceDetails as $service)
				<h3>{{$service->designs}}</h3>
				<div class="single-rating">
					<span class="starRating">
						<input id="rating5" type="radio" name="rating" value="5" checked>
						<label for="rating5">5</label>
						<input id="rating4" type="radio" name="rating" value="4">
						<label for="rating4">4</label>
						<input id="rating3" type="radio" name="rating" value="3">
						<label for="rating3">3</label>
						<input id="rating2" type="radio" name="rating" value="2">
						<label for="rating2">2</label>
						<input id="rating1" type="radio" name="rating" value="1">
						<label for="rating1">1</label>
					</span>
					<p>5.00 out of 5</p>
					<a href="#">Add Your Review</a>
				</div>
				<h6 class="item_price">${{$service->price}}</h6>			
				<p>{{$service->designers}}</p>
				<p>{{$service->revisions}}</p>
				<p>{{$service->guarantee}}</p>
				<div class="clearfix"> </div>
				<div class="btn_form">
					<form name="addtocartForm" id="addtocartForm" action="{{url('add-to-cart')}}" method="post">
						 {!! csrf_field() !!}
                        <input type="hidden" name="category_name" value="{{ $service->category_name }}">
                        <input type="hidden" name="designs" value="{{ $service->designs }}">
                        <input type="hidden" name="designers" value="{{ $service->designers }}">
                        <input type="hidden" name="revisions" value="{{ $service->revisions }}">
                        <input type="hidden" name="price" value="{{ $service->price }}">
					<button type="submit" style="font-size: 16px;" class="label label-info"><i  class="add-cart item_add">ADD TO CART</i></button>
					</form>	
				</div>
			@endforeach	
			</div>
		   <div class="clearfix"> </div>
		</div>
	</div>
</div>
<!--//single-page-->
<h3 style="margin-left: 500px;" class="hdg">Project Upgrades</h3>
	<h4 style=" margin-left: 450px; font-size: 25px;">You Can Choose to Upgrade Your Project</h4>
<div style="width: 990px; margin-left: 80px;" class="grid_3 grid_5 wow fadeInDown animated" data-wow-delay=".5s">
	
	<div class="well">
		There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
	</div>
</div>


@endsection