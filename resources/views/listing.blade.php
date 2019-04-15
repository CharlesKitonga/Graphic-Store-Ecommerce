@extends('layouts.frontLayouts.front_design')
@section('content')
	<section>
		<div class="container">
		@if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>        
        @endif
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
		@endif
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
				
				
				<div class="col-sm-12 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">{{$categoryDetails->category_name}}</h2>
					@foreach($productsAll as $product)
					<div class="product-grids simpleCart_shelfItem wow fadeInUp animated" data-wow-delay=".8s"  style="margin-right: 10px; margin-top: 25px; width: 300px;">
						<div class="new-top">
							<a href="#"><img src="{{asset('images/backend_images/products/small/'.$product->image)}}" class="img-responsive" alt=""/></a>
							<div class="new-text">
								<ul>
									<li><a href="{{url('/start/'.$product->id)}}"> Continue </a></li>
								</ul>
							</div>
						</div>
						<div class="new-bottom">
							<h5><a class="name" href="{{url('/products')}}">{{$product->category_name}} </a></h5>
							<div class="rating">
								<span class="on">☆</span>
								<span class="on">☆</span>
								<span class="on">☆</span>
								<span class="on">☆</span>
								<span>☆</span>
							</div>
						</div>
					</div>
					@endforeach						
					</div><!--features_items-->										
				</div>
			</div>
		</div>
	</section>
@endsection