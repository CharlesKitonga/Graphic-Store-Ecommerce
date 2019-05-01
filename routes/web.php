<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'PagesController@Index');
Route::get('/subcats/{url}', 'PagesController@viewProducts');

//Get started Route
Route::match(['get'],'/start/{id}','PagesController@Start');
Route::match(['post'],'/start','PagesController@Start');

//Category/ Listing Page Routes
Route::get('/products/{url}','ProductsController@products');

//Package Route
Route::match(['get','post'],'/package/{category_name}', 'PagesController@Package');

//Get product details page
Route::get('/service/{id}','ProductsController@service');

//Cart Page Route
Route::match(['get','post'],'/cart','ProductsController@cart');
Route::match(['get','post'],'/cart/delete_cart/{id}','ProductsController@deleteCart');

//Add to Cart Route
Route::match(['get', 'post'],'/add-to-cart', 'ProductsController@addtocart');
//Register & Login Routes
Route::match(['get','post'], '/register', 'UserController@Register');
Route::match(['get','post'], '/user-login','UserController@Login');

//User Account Route with middleware
Route::group(['middleware'=>['frontLogin']],function(){
	
	Route::match(['get','post'], '/account', 'UserController@Account');
	//check current password
	Route::post('/check-user-pwd','UserController@CheckUserPwd');
	//Update current password in db
	Route::post('/update-user-pwd', 'UserController@updateUserPassword');

});
//Checkout Page Route
Route::match(['get','post'], '/checkout','CheckoutController@Checkout')->middleware('auth');
Route::get('/guest-checkout','CheckoutController@guestCheckout');

//billing info route
Route::match(['get','post'],'/billing','CheckoutController@billingInfo');

//User's logout
Route::get('/user-logout','UserController@logout');

//Check if user already exists
Route::match(['get','post'], '/check-email', 'UserController@checkEmail');


//contact page route
Route::match(['get','post'],'/contact', 'IndexController@Contact');

//admin login route
Route::match(['get', 'post'],'/admin', 'AdminController@login');
//Admin Routes
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/settings','AdminController@settings');
Route::get('/admin/check-pwd','AdminController@chkPassword');
Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');

//Categories Routes (Admin)
Route::match(['get','post'],'/admin/categories/add_category','CategoryController@addCategory');
Route::match(['get','post'],'/admin/edit_category/{id}','CategoryController@editCategory');
Route::match(['get','post'],'/admin/delete_category/{id}','CategoryController@deleteCategory');
Route::get('/admin/categories/view_category','CategoryController@viewCategories');

//Add Jobs Completed by Specific People Route
Route::match(['get','post'],'/admin/add_job','JobController@addJob');
Route::get('/admin/jobs/view_jobs','JobController@viewJobs');
Route::get('/admin/delete_job/{id}','TestimonialController@deleteJob');

//Add Testimonials Completed by Specific People Route
Route::match(['get','post'],'/admin/add_testimonial','TestimonialController@addTestimonial');
Route::get('/admin/testimonials/view_testimonials','TestimonialController@viewTestimonials');
Route::get('/admin/delete_job/{id}','TestimonialController@deleteJob');

//Add Project upgrades
Route::match(['get','post'],'/admin/add_upgrade','UpgradeController@addUpgrade');
Route::get('/admin/testimonials/view_upgrades','UpgradeController@viewUpgrades');
Route::get('/admin/delete_job/{id}','UpgradeController@deleteJob');

//Add Packages offered Route
Route::match(['get','post'],'/admin/add_package','PackageController@addPackage');
Route::get('/admin/jobs/view_packages','PackageController@viewPackages');
Route::get('/admin/delete_package/{id}','PackageController@deletePackage');

//Products route
Route::match(['get','post'],'/admin/add_products','ProductsController@addProduct');
Route::match(['get','post'],'/admin/add_slider_images','IndexController@addSliderImages');
Route::match(['get','post'],'/admin/edit_product/{id}','ProductsController@editProduct');
Route::get('/admin/products/view_products','ProductsController@viewProducts');
Route::match(['get','post'],'/admin/products/view_products_attributes','ProductsController@viewProductsAttributes');
Route::get('/admin/products/view_slider_products','IndexController@viewProducts');
Route::get('/admin/delete_product/{id}','ProductsController@deleteProduct');
Route::get('/admin/delete_slider_product/{id}','ProductsController@deleteSliderProduct');
Route::get('/admin/delete_product_image/{id}', 'ProductsController@deleteProductImage');
Route::get('/admin/delete_alt_image/{id}', 'ProductsController@deleteAltImage');

//Product Attributes routes
Route::match(['get', 'post'], 'admin/add_attributes/{id}', 'ProductsController@addAttributes');
Route::match(['get', 'post'], 'admin/edit_attributes/{id}', 'ProductsController@editAttributes');
Route::match(['get', 'post'], 'admin/add_images/{id}', 'ProductsController@addImages');
Route::get('/admin/delete_attribute/{id}','ProductsController@deleteAttribute');
//Category Attributes routes
Route::match(['get', 'post'], 'admin/add_category_attributes/{id}', 'CategoryController@addAttributes');
Route::match(['get', 'post'], 'admin/edit_attributes/{id}', 'CategoryController@editAttributes');
Route::match(['get', 'post'], 'admin/add_images/{id}', 'CategoryController@addImages');
Route::get('/admin/delete_attribute/{id}','ProductsController@deleteAttribute');


//Manage Orders Route in Admin
Route::post('toggledeliver/{orderId}', 'OrderController@toggledeliver')->name('toggle.deliver');
Route::get('orders/{type?}','OrderController@Orders');
Route::match(['get','post'],'/admin/delete_order/{id}','OrderController@deleteOrder');
Route::match(['get','post'],'/admin/edit_order/{id}','OrderController@editOrder');

Route::get('/logout', 'AdminController@logout');

//following routes deal with shopping cart
Route::resource('carts', 'CartController', ['only' => ['index', 'store', 'update', 'destroy']]);
Route::post('/cartpp', 'CartController@store')->name('cart.store');
Route::delete('emptyCart', 'CartController@emptyCart');
Route::post('switchToWishlist/{id}', 'CartController@switchToWishlist');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
