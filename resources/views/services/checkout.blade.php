@extends('layouts.frontLayouts.front_design')
@section('content')
<!--breadcrumbs-->
<div class="breadcrumbs">
<div class="container">
	<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
		<li><a href="{{url('/')}}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
	</ol>
</div>
</div>
<!--//breadcrumbs-->
<!--login-->
<div class="login-page" style="margin-right: 100px;">
	<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
		<h3 class="title">Order<span>  Summary</span></h3>
		<p class="text-muted">Here is a summary of your package and project details !!</p>
	</div>
	<div class="widget-shadow">
		<div class="login-body">
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
			<div class="list-group list-group-alternate"> 
				<p style="font-weight: bolder; font-size: 17px;">Project Details</p><br>
				<div class="alert alert-success" role="alert">
					<strong>{{$projects->project}}</strong>
				</div>
		 		<div style="margin-top: -10px;" class="alert alert-info" role="alert">
					<strong>{{$projects->description}}</strong> 
				</div>
				<br>
				@foreach (Cart::content() as $item)
				<a href="#" class="list-group-item"><span style="font-weight: bolder; font-size: 17px; margin-right: 150px;" >Category Name </span> <i class="ti ti-email"></i>{{$item->model->category_name}} </a> 

				<a href="#" class="list-group-item"><span style="font-weight: bolder; font-size: 17px; margin-right: 215px;"  >Designs</span> <i class="ti ti-email"></i>{{$item->designs}}  </a>
				<a href="#" class="list-group-item"><span style="font-weight: bolder; font-size: 17px; margin-right: 205px;"  >Designers</span> <i class="ti ti-email"></i>{{$item->model->designers}}  </a>
				@endforeach
				<a href="#" class="list-group-item"><span style="font-weight: bolder; font-size: 17px; margin-right: 240px;"  >Total</span> <i class="ti ti-email"></i>$ {{ Cart::total() }}</a>
			</div>
		</div>
	</div>
</div>
<div class="login-page" style="margin-left: 100px;margin-top: -710px; ">
	<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
		<h3 class="title">Billing<span>  Details </span></h3>

	</div>
	<div class="widget-shadow">
		@if(Session::has('flash_message_success'))
		    <div class="alert alert-success alert-block">
		        <button type="button" class="close" data-dismiss="alert">×</button> 
		        <strong>{!! session('flash_message_success') !!}</strong>
		    </div>        
		@endif
		<div class="login-body wow fadeInUp animated" data-wow-delay=".7s">
			<form method="POST" id="accountForm" action="{{url('/billing')}}" enctype="multipart/form-data" class="wow fadeInUp animated" data-wow-delay=".7s">{{csrf_field()}}
				@if(auth()->user())
				<label>Full Name</label>
				<input type="text" value="{{$userDetails->name}}"  id="name" name="name" placeholder="Full Name" required="">
				<label>Email</label>
				<input type="text" value="{{$userDetails->email}}"  id="email" name="email" placeholder="Email" required="">
				<label>Address</label>
				<input type="text" value="{{$userDetails->address}}" id="address" name="address" class="address" placeholder="Address" required="">	
				<label>Country</label>
				<select style="width: 455px; min-height: 50px;" id="country" name="country">
					<option value="">Select Country</option>
					@foreach($countries as $country)
						<option value="{{$country->country_name}}" @if($country->country_name == $userDetails->country) Selected @endif>{{$country->country_name}}</option>
					@endforeach		
				</select><br><br>	
				<label>Mobile</label>	
				<input type="text" value="{{$userDetails->mobile}}" id="mobile" name="mobile" placeholder="Mobile" required="">	
				@else
				<label>Full Name</label>
				<input type="text"  id="name" name="name" placeholder="Full Name" required="">
				<label>Email</label>
				<input type="text"  id="email" name="email" placeholder="Email" required="">
				<label>Address</label>
				<input type="text" id="address" name="address" class="address" placeholder="Address" required="">	
				<label>Country</label>
				<select style="width: 455px; min-height: 50px;" id="country" name="country">
					<option value="">Select Country</option>
					@foreach($countries as $country)
						<option value="{{$country->country_name}}" @if($country->country_name == $userDetails->country) Selected @endif>{{$country->country_name}}</option>
					@endforeach		
				</select><br><br>	
				<label>Mobile</label>	
				<input type="text" id="mobile" name="mobile" placeholder="Mobile" required="">	
				@endif

				<input type="submit" value="Go to Payment">
			</form>
		</div>
	</div>

</div>
@endsection