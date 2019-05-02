<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="active"><a href="{{url('/admin/dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Services</span> <span class="   label label-important"></span></a>
      <ul>
        <li><a href="{{url('/admin/categories/add_category')}}">Add Service</a></li>
        <li><a href="{{url('/admin/categories/view_category')}}">View Services</a></li>
        <li><a href="{{url('/admin/products/view_products_attributes')}}">View Service Attributes</a></li>
      </ul>
    </li>
 
     <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Packages</span> <span class="   label label-important"></span></a>
      <ul>
       
        <li><a href="{{url('/admin/jobs/view_packages')}}">View Packages</a></li>
      </ul>
    </li>   
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Testimonials</span> <span class="   label label-important"></span></a>
      <ul>
        <li><a href="{{url('/admin/add_testimonial')}}">Add Testimonial</a></li>       
        <li><a href="{{url('/admin/testimonials/view_testimonials')}}">View Testimonials</a></li>
      </ul>
    </li>
       <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Blogs</span> <span class="   label label-important"></span></a>
      <ul>
        <li><a href="{{url('/admin/create-blogs')}}">Add Blog</a></li>       
        <li><a href="{{url('/admin/blogs/view_blogs')}}">View Blogs</a></li>
      </ul>
    </li>
     <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Completed Jobs</span> <span class="   label label-important"></span></a>
      <ul>
       
        <li><a href="{{url('/admin/add_job')}}">Add Job</a></li>
        <li><a href="{{url('/admin/jobs/view_jobs')}}">View Jobs Done</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Project Upgrades</span> <span class="   label label-important"></span></a>
      <ul>
       
        <li><a href="{{url('/admin/add_upgrade')}}">Add an Upgrade</a></li>
        <li><a href="{{url('/admin/jobs/view_upgrades')}}">View Project Upgrades</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span> Sliders</span> <span class="   label label-important"></span></a>
      <ul>
         <li><a href="{{url('/admin/add_slider_images')}}">Add Slider Services</a></li>
        <li><a href="{{url('/admin/products/view_slider_products')}}">View Slider Services</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span> Manage Orders</span> <span class="   label label-important"></span></a>
      <ul>
        <li><a href="{{url('orders/pending')}}">Pending Orders</a></li>
        <li><a href="{{url('orders/delivered')}}">Delivered Orders</a></li>
        <li><a href="{{url('orders')}}">All Orders</a></li>
      </ul>
    </li>    
  </ul>
</div>
<!--sidebar-menu-->
