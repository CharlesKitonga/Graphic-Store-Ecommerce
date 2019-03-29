@extends('layouts.frontLayouts.front_design')
@section('content')
<!--breadcrumbs-->
<div class="breadcrumbs">
	<div class="container">
		<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
			<li><a href="{{url('/')}}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
			<li class="active">Contact Us</li>
		</ol>
	</div>
</div>
<!--//breadcrumbs-->
<!--contact-->
<div class="contact">
	<div class="container">
		<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
			<h3 class="title">How To <span> Find Us</span></h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit curabitur </p>
		</div>
		<iframe class="wow zoomIn animated animated" data-wow-delay=".5s" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57537.641430789925!2d-74.03215321337959!3d40.719122105634035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1456152197129" allowfullscreen=""></iframe>
	</div>	
</div>
<div class="address"><!--address-->
	<div class="container">
		<div class="address-row">
			<div class="col-md-6 address-left wow fadeInLeft animated" data-wow-delay=".5s">
				<div class="address-grid">
					@if(Session::has('flash_message_success'))
			            <div class="alert alert-success alert-block" style="background-color: #ffffff">
			                <button type="button" class="close" data-dismiss="alert">×</button> 
			                <strong>{!! session('flash_message_success') !!}</strong>
			            </div>        
       				@endif
					<h4 class="wow fadeIndown animated" data-wow-delay=".5s">DROP US A LINE </h4>
					<form method="post" enctype="multipart/form-data" action="{{url('/contact')}}" >{{csrf_field()}}
						<input class="wow fadeIndown animated" data-wow-delay=".6s" type="text" name="name" placeholder="Name" required="">
						<input class="wow fadeIndown animated" data-wow-delay=".7s" type="text" name="email" placeholder="Email" required="">
						<input class="wow fadeIndown animated" data-wow-delay=".8s" type="text" name="subject" placeholder="Subject" required="">
						<textarea class="wow fadeIndown animated" name="message" data-wow-delay=".8s" name="message" placeholder="Message" required=""></textarea>
						<input class="wow fadeIndown animated" data-wow-delay=".9s" type="submit" value="SEND">
					</form>
				</div>
			</div>
			<div class="col-md-6 address-right">
				<div class="address-info wow fadeInRight animated" data-wow-delay=".5s">
					<h4>ADDRESS</h4>
					<p>123 San Sebastian, CG 09-123 Ba,Block(#456),Hill Towers 4567 New York City USA.</p>
				</div>
				<div class="address-info address-mdl wow fadeInRight animated" data-wow-delay=".7s">
					<h4>PHONE </h4>
					<p>+222 111 333 4444</p>
					<p>+222 111 333 5555</p>
				</div>
				<div class="address-info wow fadeInRight animated" data-wow-delay=".6s">
					<h4>MAIL</h4>
					<p><a href="mailto:example@mail.com"> mail@example.com</a></p>
					<p><a href="mailto:example@mail.com"> mail2@example.com</a></p>
				</div>
			</div>
		</div>	
	</div>	
</div>
<!--//contact-->	
@endsection