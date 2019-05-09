<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Image;
use DB;
use App\SliderImages;
use App\Product;
use App\Category;
use App\Job;
use App\Start;
use App\Package;
use App\Testimonial;
use Session;
class PagesController extends Controller
{
    public function Index($id = null){


    	//In Ascending Order  (by Default)
    	$allServices = Category::where(['parent_id'=>0])->get();

    	//In Descending Order 
    	$allServices = Category::OrderBy('id','DESC')->where(['parent_id'=>0])->get();

        //Work Done In Random Order 
        $jobsdone = Job::inRandomOrder()->get();


        //Get Slider Images
        $sliderimages = SliderImages::get();
        $sliderimages = json_decode(json_encode($sliderimages));

        //Get Product Details
        $serviceDetails = Category::where('id',$id)->first();
        $serviceDetails = json_decode(json_encode($serviceDetails));

    	//Get all categories and subcategories
    	$categories = Category::with('categories')->where(['parent_id'=>0])->get();
        // $categories = json_decode(json_encode($categories));
        
        //Get client testimonials
        $testimonials = Testimonial::get();
        $testimonials = json_decode(json_encode($testimonials));

    	return view('index')->with(compact('allServices','sliderimages','categories_menu','productDetails','jobsdone','categories','testimonials'));
    }

    public function viewProducts($url = null){
        //Show error 404 if category does not exist
        $countCategory = Category::where(['url'=>$url,'status'=>1])->count();
        if ($countCategory==0) {
            abort(404);
        }
          // Get all Categories and Sub Categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $categoryDetails = Category::where(['url'=>$url])->first();

            if ($categoryDetails->parent_id==0) {
                //if its a main category url
                $subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();
                foreach ($subCategories as $subcat) {
                    $cat_ids[] = $subcat->id.",";
                }

                $productsAll = Category::whereIn('id',$cat_ids)->get();
                $productsAll = json_decode(json_encode($productsAll));
                
            }else{
                // if its a sub category url
                $productsAll = Category::where(['id'=>$categoryDetails->id])->get();
            }
        // echo "<pre>"; print_r($jobsdone); die;
        return view('products')->with(compact('categories','categoryDetails','productsAll'));
    }

    public function Start(Request $request, $category_name=null){
          //Show error 404 if category does not exist
        $countPackage = Product::where(['category_name'=>$category_name])->count();
        if ($countPackage==0) {
            abort(404);
        }
        $session_id = Session::get('session_id');
        if ( $request->isMethod('post')) {
            $data = $request->all();

            $starts = new Start;
            $starts->project = $data['project'];
            $starts->description = $data['description'];

            // Upload Image
               if ($request->hasFile('image')) {
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(650,480)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                    // Store image name in products table
                    $starts->image = $filename;
                }
            }
            $starts->session_id = str_random(40);
            Session::put('session_id',$session_id);
             // echo "<pre>";print_r($starts);die;
            $starts->save();
            $categories = Product::where(['category_name'=>$category_name])->first();
            $productDetails = Product::first();

            return redirect('package')->with(compact('productDetails'));
        }
        $categories = Product::where(['category_name'=>$category_name])->first();
        $packages = Product::where(['category_name'=>$category_name])->get();
        //$categories = json_decode(json_encode($categories));
        $productDetails = Product::first();

        return view('services.start')->with(compact('categories','productDetails','packages'));
    }

    public function Package(Request $request,$category_name=null){
         $session_id = Session::get('session_id');
        if ( $request->isMethod('post')) {
            $data = $request->all();

            $starts = new Start;
            $starts->project = $data['project'];
            $starts->description = $data['description'];

            // Upload Image
               if ($request->hasFile('image')) {
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(650,480)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                    // Store image name in products table
                    $starts->image = $filename;
                }
            }
            $starts->session_id = str_random(40);
            Session::put('session_id',$session_id);
             // echo "<pre>";print_r($starts);die;
            $starts->save();
            $categories = Product::where(['category_name'=>$category_name])->first();
            $productDetails = Product::first();

        }

        $packages = Product::where(['category_name'=>$category_name])->get();

        
        return view('package')->with(compact('packages'));
    }


}
