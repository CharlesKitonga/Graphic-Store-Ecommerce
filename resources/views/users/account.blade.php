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
	<h3 class="title">Update<span>Password</span></h3>
</div>
<div class="widget-shadow">
	<div class="login-body">

	</div>
</div>
</div>
<div class="login-page" style="margin-left: 100px;margin-top: -300px; ">
	<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
		<h3 class="title">Update<span>Account </span></h3>
	</div>
	<div class="widget-shadow">
		<div class="login-body wow fadeInUp animated" data-wow-delay=".7s">

		</div>
	</div>

</div>
@endsection