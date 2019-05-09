	@extends('layouts.frontLayouts.front_design')
	@section('content')

   <div class="product-grids simpleCart_shelfItem wow fadeInUp animated" data-wow-delay=".8s"  style="margin-right: 10px; margin-top: 25px;">
      <div class="new-top">
       <h1>Thank you for <br> Your Order!</h1>
       <p>A confirmation email was sent</p>
      </div>
      <div class="new-bottom">
        <h5> <a href="{{ url('/') }}" class="button">Home Page</a></h5>
        <div class="rating">
          <span class="on">☆</span>
          <span class="on">☆</span>
          <span class="on">☆</span>
          <span class="on">☆</span>
          <span>☆</span>
        </div>
        
      </div>
    </div>
@endsection
