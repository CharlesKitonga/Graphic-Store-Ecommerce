<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use App\Job;
use App\Category;
use App\Product;
use DB;
use App\Package;

class JobController extends Controller
{
     public function addJob(Request $request){

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data); die;
            if(empty($data['category_name'])){
                return redirect()->back()->with('flash_message_error','Under Category is missing!');    
            }
            $jobs = new Job;

            $jobs->category_name = $data['category_name'];
            $jobs->staff_name = $data['staff_name'];
            $jobs->job_code = $data['job_code'];
            if (!empty($data['description'])) {
                $jobs->description = $data['description'];
            }else{
                $jobs->description = ''; 
            }
            $jobs->price =$data['price'];

            //Upload Image
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
                    $jobs->image = $filename;
                }
            }


            $jobs->save();
            return redirect()->back()->with('flash_message_success','Job Added Successfuly!');

        }

        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach($categories as $cat){
            $categories_dropdown .= "<option value='".$cat->category_name."'>".$cat->category_name."</option>";
            
        }

        return view('admin.jobs.add_jobs')->with(compact('categories_dropdown'));
    }
    public function editProduct(Request $request, $id=null){

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;

            //Upload Image
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
                }
            }else{
                $filename = $data['current_image'];
            }

            if (empty($data['description'])) {
                $data['description'];
            }

            Product::where(['id'=>$id])->update(['category_id'=>$data['category_id']],['product_name'=>$data['product_name']],['product_code'=>$data['product_code']],['description'=>$data['description']],['price'=>$data['price'], 'image'=>$filename]);

            return redirect()->back()->with('flash_message_success', 'Service has been Updated Successfully!');

        }

        $productDetails = Product::where(['id'=>$id])->first();
        //categories dropdown start
        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach($categories as $cat){
            if ($cat->id==$productDetails->category_id) {
                $selected = "selected";
            }else{
                $selected = "";
            }
            $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">".$cat->category_name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
            if ($cat->id==$productDetails->category_id) {
                $selected = "selected";
            }else{
                $selected = "";
            }
                $categories_dropdown .= "<option value = '".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->category_name."</option>";
            }
        }

        return view('/admin/products.edit_product')->with(compact('productDetails','categories_dropdown'));
    }
    
    public function viewJobs(Request $request){

        $jobs = Job::get();
        $jobs = json_decode(json_encode($jobs));
        // foreach($products as $key => $val){
        //     $category_name = Category::where(['id'=>$val->category_id])->first();
        //     $products[$key]->category_name = $category_name->category_name;
        // }
        // echo "<pre>"; print_r($products); die;
        return view('admin.jobs.view_jobs')->with(compact('jobs'));
    }

    public function deleteJob($id = null){
        Job::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Job has been Deleted Successfully!');
    }


}
