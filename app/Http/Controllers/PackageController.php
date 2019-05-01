<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use Illuminate\Support\Facades\Input;
use App\Category;
use App\Products_Attributes;
use Image;  
use Auth;
use DB;

class PackageController extends Controller
{
    public function addPackage(Request $request, $category_name=null){

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data); die;
            $packages = new Package;
            $packages->category_name = $data['category_name'];
            $packages->designs = $data['designs'];
            $packages->designers = $data['designer'];
            $packages->revisions = $data['revisions'];
            $packages->gurantee = $data['gurantee'];
            $packages->price =$data['price'];

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
                    $packages->image = $filename;
                }
            }

            //echo "<pre>";print_r($packages);die;

            $packages->save();
            return redirect()->back()->with('flash_message_success','Package Added Successfuly!');

        }
        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach($categories as $cat){
            $categories_dropdown .= "<option value='".$cat->category_name."'>".$cat->category_name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->category_name])->get();
            foreach ($sub_categories as $sub_cat) {
                $categories_dropdown .= "<option value = '".$sub_cat->category_name."'>&nbsp;--&nbsp;".$sub_cat->category_name."</option>";
            }
        }


        return view('admin.packages.add_package')->with(compact('categories_dropdown'));
    }
       public function viewPackages(Request $request){
            
        $packages = Products_Attributes::get();
        $packages = json_decode(json_encode($packages));

        // foreach($products as $key => $val){
        //     $category_name = Category::where(['id'=>$val->category_id])->first();
        //     $products[$key]->category_name = $category_name->category_name;
        // }
        // echo "<pre>"; print_r($products); die;
        return view('admin.packages.view_packages')->with(compact('packages','package'));
    }
}
