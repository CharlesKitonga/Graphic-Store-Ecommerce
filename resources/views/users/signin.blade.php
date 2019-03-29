 	 	@extends('layouts.frontLayouts.front_design')
@section('content')
<!--login-->
<div class="login-page">
	<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
		<h3 class="title">SignIn<span> Form</span></h3>
@if(Session::has('flash_message_error'))
    <div class="alert alert-error alert-block" style="background-color: #f2dfd0">
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
	<div class="widget-shadow">
		<div class="login-top wow fadeInUp animated" data-wow-delay=".7s">
			<h4>Welcome back to Graphic Store! <br> Not a Member? <a href="{{url('/register')}}">  Register Now »</a> </h4>
		</div>
		<div class="login-body wow fadeInUp animated" data-wow-delay=".7s">
			<form 	id="loginForm" method="post" name="loginForm" action="{{url('/user-login')}}" enctype="multipart/form-data">{{csrf_field()}}
				<input type="text" class="user" name="email" placeholder="Enter your email" required="">
				<input type="password" name="password" class="lock" placeholder="Password">
				<input type="submit" name="Sign In" value="Sign In">
				<div class="forgot-grid">
					<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Remember me</label>
					<div class="forgot">
						<a href="#">Forgot Password?</a>
					</div>
					<div class="clearfix"> </div>
				</div>
			</form>
		</div>
	</div>

</div>
<!--//login-->
@endsection