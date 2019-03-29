@extends('layouts.frontLayouts.front_design')
@section('content')
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
	<h3 class="title">Describe The {{$categories->category_name}}<span> You Need</span></h3>
	<p>Some Basic Information About Your Project</p>
</div>
<div class="widget-shadow">
	<div class="login-body">
		<form class="wow fadeInUp animated" data-wow-delay=".7s" method="post" action="{{url('/start')}}" enctype="multipart/form-data"> {{csrf_field()}}
			<label>Name of Your Project</label>
			<input type="text" name="project" placeholder="Name of Your Project" required=""><br>
			<label>Describe Your Project</label><br>
			<textarea rows="4" cols="65" name="description" placeholder="Describe Your Project A little bit More" required=""></textarea><br><br>
			<label>Upload Image Samples(optional)</label><br><br> 	
			<input type="file" name="image"  placeholder="Upload some samples(optional)"><br>
			<input type="submit" name="continue" value="Continue">
		</form>
	</div>
</div>
</div>
<!--//login-->			
@endsection