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
			<h3 class="title">What Do<span> You Need </span></h3>
			<p>Select What You Need</p>
		</div>
	<div class="col-md-10 product-model-sec">
		@foreach($jobsdone as $cat)
		<div class="product-grids simpleCart_shelfItem wow fadeInUp animated" data-wow-delay=".8s"  style="margin-right: 10px; margin-top: 25px;">
			<div class="new-top">
				<a href="#"><img src="{{asset('images/backend_images/products/small/'.$cat->image)}}" class="img-responsive" alt=""/></a>
				<div class="new-text">
					<ul>
						<li><a href="{{url('/start/'.$cat->id)}}"> Continue </a></li>
					</ul>
				</div>
			</div>
			<div class="new-bottom">
				<h5><a class="name" href="{{url('/products')}}">{{$cat->category_name}} </a></h5>
				<div class="rating">
					<span class="on">☆</span>
					<span class="on">☆</span>
					<span class="on">☆</span>
					<span class="on">☆</span>
					<span>☆</span>
				</div>
				<div class="ofr">
					<p><span class="item_price">${{$cat->price}}</span></p>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	
	<div class="clearfix"> </div>
</div>
</div>
<!--//products-->		
<!-- the jScrollPane script -->
<script type="text/javascript" src="{{asset('js/jquery.jscrollpane.min.js')}}"></script>
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