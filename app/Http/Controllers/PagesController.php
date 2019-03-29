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
class PagesController extends Controller
{
    public function Index($id = null){


    	//In Ascending Order  (by Default)
    	$allServices = Product::get();

    	//In Descending Order 
    	$allServices = Product::OrderBy('id','DESC')->get();

    	//In Random Order 
    	$allServices = Product::inRandomOrder()->get();


        //Work Done In Random Order 
        $jobsdone = Job::inRandomOrder()->get();


        //Get Slider Images
        $sliderimages = SliderImages::get();
        $sliderimages = json_decode(json_encode($sliderimages));

        //Get Product Details
        $serviceDetails = Product::where('id',$id)->first();
        $serviceDetails = json_decode(json_encode($serviceDetails));

    	//Get all categories and subcategories
    	$categories = Category::with('categories')->where(['parent_id'=>0])->get();
        // $categories = json_decode(json_encode($categories));
        

    	return view('index')->with(compact('allServices','sliderimages','categories_menu','productDetails','jobsdone','categories'));
    }

    public function viewProducts(Request $request){

        
        //Work Done In Random Order 
        $jobsdone = Job::inRandomOrder()->get();
        // echo "<pre>"; print_r($jobsdone); die;
        return view('products')->with(compact('jobsdone'));
    }

    public function Start(Request $request, $id=null){
        if ($request->isMethod('post')) {
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
             // echo "<pre>";print_r($starts);die;
            $starts->save();
            $categories = Job::where(['id'=>$id])->first();

            return redirect('package')->with(compact('categories'));
        }
        $categories = Job::where(['id'=>$id])->first();
        //$categories = json_decode(json_encode($categories));
        return view('start')->with(compact('categories'));
    }

    public function Package(){

        $packages = Package::get();

        
        return view('package')->with(compact('packages'));
    }


}
