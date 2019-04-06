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
	<h3 class="title">Update<span>  Password</span></h3>

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
			<form 	id="passwordForm" method="post" name="passwordForm" action="{{url('/update-user-pwd')}}" enctype="multipart/form-data">{{@csrf_field()}}
				<span id="chkPwd"></span>
				<input type="password" id="current_pwd" name="current_pwd" class="lock" placeholder="Current Password">
				<input type="password" id="new_pwd" name="new_pwd" class="lock" placeholder="New Password">
				<input type="password" id="confirm_pwd" name="confirm_password" class="lock" placeholder="Confirm Password">
				<input type="submit" name="Update Password" value="Update Password">
			</form>
	</div>
</div>
</div>
<div class="login-page" style="margin-left: 100px;margin-top: -540px; ">
	<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
		<h3 class="title">Update<span>  Account </span></h3>

	</div>
	<div class="widget-shadow">
		@if(Session::has('flash_message_success'))
		    <div class="alert alert-success alert-block">
		        <button type="button" class="close" data-dismiss="alert">×</button> 
		        <strong>{!! session('flash_message_success') !!}</strong>
		    </div>        
		@endif
		<div class="login-body wow fadeInUp animated" data-wow-delay=".7s">
			<form method="POST" id="accountForm" action="{{url('/account')}}" enctype="multipart/form-data" class="wow fadeInUp animated" data-wow-delay=".7s">{{csrf_field()}}
				<label>Full Name</label>
				<input type="text" value="{{$userDetails->name}}"  id="name" name="name" placeholder="Full Name" required="">
				<label>Address</label>
				<input type="text" value="{{$userDetails->address}}" id="address" name="address" class="address" placeholder="Address" required="">
				<label>City</label>
				<input type="text" value="{{$userDetails->city}}" id="city" name="city" placeholder="City" required="">	
				<label>State (Optional for Countries without States)</label>	
				<input type="text" value="{{$userDetails->state}}" id="state" name="state" placeholder="State (optional for countries without states)" >
				<label>Country</label>	
				<select style="width: 455px; min-height: 50px;" id="country" name="country">
					<option value="">Select Country</option>
					@foreach($countries as $country)
						<option value="{{$country->country_name}}" @if($country->country_name == $userDetails->country) Selected @endif>{{$country->country_name}}</option>
					@endforeach		
				</select><br><br>
				<label>Mobile</label>	
				<input type="text" value="{{$userDetails->mobile}}" id="mobile" name="mobile" placeholder="Mobile" required="">			
				<input type="submit" value="Update Info">
		</form>
		</div>
	</div>

</div>
@endsection