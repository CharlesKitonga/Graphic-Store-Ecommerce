<?php
use App\Http\Controllers\Controller;
$mainCategories = Controller::mainCategories();
$categories = Controller::categories();

?>
<!--header-->
<div class="header">
   <div class="top-header navbar navbar-default"><!--header-one-->
      <div class="container">
         <div class="nav navbar-nav wow fadeInLeft animated" data-wow-delay=".5s">
            <p>
               Welcome to Graphic Design Store <a href="{{url('/register')}}">Register </a> Or 
               @if(empty(Auth::check()))
               <a href="{{url('/user-login')}}">Sign In </a>
               @else
               <li ><a href="{{url('/account')}}"><i class="fa fa-user"></i> Account</a></li>
               <li ><a href="{{url('/user-logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
               @endif

         </p>
         </div>
         <div class="nav navbar-nav navbar-right social-icons wow fadeInRight animated" data-wow-delay=".5s">
            <ul>
               <li><a href="#"> </a></li>
               <li><a href="#" class="pin"> </a></li>
               <li><a href="#" class="in"> </a></li>
               <li><a href="#" class="be"> </a></li>
               <li><a href="#" class="you"> </a></li>
               <li><a href="#" class="vimeo"> </a></li>
            </ul>
         </div>
         <div class="clearfix"> </div>
      </div>
   </div>
   <div class="header-two navbar navbar-default"><!--header-two-->
      <div class="container">
         <div class="nav navbar-nav header-two-left">
            <ul>
               <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+254 743 796 495</li>
               <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">mail@example.com</a></li>         
            </ul>
         </div>
         <div class="nav navbar-nav logo wow zoomIn animated" data-wow-delay=".7s">
            <h1><a href="{{url('/')}}">Graphic Design <b>Store</b><span class="tag">Every Single Design You Desire </span> </a></h1>
         </div>
         <div class="nav navbar-nav navbar-right header-two-right">
            <div class="header-right my-account">
               <a href="{{url('/contact')}}"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> CONTACT US</a>                 
            </div>
            <div class="header-right cart">
               <a href="{{url('/cart')}}"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a>
               <h4><a href="{{url('/cart')}}">
                     <span >$ {{ Cart::total() }}</span> <span > ({{ Cart::instance('default')->count(false) }})</span> 
               </a></h4>
               <div class="cart-box">
                  <p><a href="javascript:;" class="simpleCart_empty">Empty cart</a></p>
                  <div class="clearfix"> </div>
               </div>
            </div>
            <div class="clearfix"> </div>
         </div>
         <div class="clearfix"> </div>
      </div>
   </div>
   <div class="top-nav navbar navbar-default"><!--header-three-->
      <div class="container">
         <nav class="navbar" role="navigation">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
               </button>
            </div>
            <!--navbar-header-->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav top-nav-info">
                  <li><a href="{{url('/')}}" class="active">Home</a></li>
                  <li><a href="{{url('/blogs')}}" class="active">Blog</a></li>
                  @foreach($mainCategories as $cat)
                           @if($cat->status=="1")    
                   <li class="dropdown grid">
                          
                           <a href="#" class="dropdown-toggle list1" data-toggle="dropdown">{{$cat->category_name}}<b class="caret"></b></a>
                         
                           <ul class="dropdown-menu multi-column multi-column2">
                              <div class="row">

                                 <div class="col-sm-3 menu-grids">
                                    @foreach($cat->categories as $subcat)
                                    <ul class="multi-colum-dropdown">
                                       <li><a class="list" style="color: #322D2D; margin-top: 10px;" href="{{ asset('/subcats/'.$subcat->url)}}">{{$subcat->category_name}}</a></li>
                                    </ul>
                                    @endforeach
                                 </div>                                        
                                 <div class="clearfix"> </div>
                              </div>
                           </ul>
                  </li>
                         @endif
                 @endforeach
               </ul> 
               <div class="clearfix"> </div>
               <!--//navbar-collapse-->
               <header class="cd-main-header">
                  <ul class="cd-header-buttons">
                     <li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
                  </ul> <!-- cd-header-buttons -->
               </header>
   
            </div>
            <!--//navbar-header-->
         </nav>
         <div id="cd-search" class="cd-search">
            <form>
               <input type="search" placeholder="Search...">
            </form>
         </div>
      </div>
   </div>
</div>
<!--//header-->