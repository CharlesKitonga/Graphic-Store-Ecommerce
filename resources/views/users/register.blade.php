@extends('layouts.frontLayouts.front_design')
@section('content')
<!--breadcrumbs-->
<div class="breadcrumbs">
<div class="container">
	<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
		<li><a href="{{url('/')}}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
		<li class="active">Register</li>
	</ol>
</div>
</div>
<!--//breadcrumbs-->

<!--login-->
<div class="login-page">
<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
	<h3 class="title">Register<span> Form</span></h3>
</div>
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
<div class="widget-shadow">
	<div class="login-top wow fadeInUp animated" data-wow-delay=".7s">
		<h4>Already have an Account ?<a href="{{url('login')}}">  Sign In »</a> </h4>
	</div>
	<div class="login-body">
		<form method="POST" id="registerForm" action="{{url('/register')}}" enctype="multipart/form-data" class="wow fadeInUp animated" data-wow-delay=".7s">{{@csrf_field()}}
			<input type="text" id="name" name="name" placeholder="Full Name" required="">
			<input type="text" id="email" name="email" class="email" placeholder="Email Address" required="">
			<input type="password" id="password"  name="password" class="lock" placeholder="Password">
			<input type="submit" name="Register" value="Register">
		</form>
	</div>
</div>
</div>
<!--//login-->
@endsection