@extends('layouts.frontLayouts.front_design')
@section('content')
<!--breadcrumbs-->
<div class="breadcrumbs">
<div class="container">
	<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
		<li><a href="{{url('/')}}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
		<li class="active">Categories</li>
	</ol>
</div>
</div>
<!--//breadcrumbs-->
<!--products-->
<div class="products">	 
<div class="container">
	<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
	<!--gallery-->
<div style="margin-top: -70px;" class="gallery">
	<div class="container">
		<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
			<h3 class="title">Choose A<span> Package </span></h3>
			<p>Some of the Beautiful Designs We have Done </p>
		</div>
		<div class="gallery-info">
			@foreach($packages as $package)
			<div class="col-md-8 gallery-grid wow flipInY animated" data-wow-delay=".1.1s" style="margin-right: 10px; width: 300px; margin-top: 25px;">
				<a ><img style="width:110px; margin-bottom: 25px;" src="{{asset('images/backend_images/products/small/'.$package->image)}}" class="img-responsive" alt=""/></a>
				<div class="gallery-text simpleCart_shelfItem">
					<h1><a style="margin-top: 10px; font-family: Helvetica;font-size: 22px;text-align:justify;"  class="name" >{{$package->designs}} </a></h1>
					<h2 style="margin-top: 10px; font-family: Helvetica;text-align:justify;font-size: 16px;" class="name">{{$package->designers}}</h2>
					<h3 style="margin-top: 10px; font-family: Helvetica;text-align:justify;font-size: 16px;" class="name">{{$package->revisions}}</h3>
					<h4 style="margin-top: 10px; font-family: Helvetica;text-align:justify;font-size: 16px;" class="name">{{$package->gurantee}}</h4>
					<h5><a style="margin-top: 10px; font-family: Helvetica;text-align:justify; margin-right: 180px;" class="name" style="font-size: 13px;">$ {{$package->price}} </a></h5>
					<button style="font-size: 26px;font-family: Helvetica; margin-top: 10px; margin-right: 150px;" class="label label-success"><a href="{{url('/service/'.$package->id)}}" > Select</a></button> 
				</div>
			</div>
			@endforeach
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!--//gallery-->

	<div class="clearfix"> </div>
</div>
</div>
<!--//products-->		
<script>
function myFunction() {
  document.getElementById("").innerHTML = "Selected";
}
</script>
<!-- the jScrollPane script -->
<script type="text/javascript" src="{{asset('js/jquery.jscrollpane.min.js')}}">
	
</script>

	<script type="text/javascript" id="sourcecode">
		$(function()
		{
			$('.scroll-pane').jScrollPane();
		});
	</script>
<!-- //the jScrollPane script -->
<script type="text/javascript" src="{{asset('js/jquery.mousewheel.js')}}"></script>
<!-- the mousewheel plugin -->
@endsection