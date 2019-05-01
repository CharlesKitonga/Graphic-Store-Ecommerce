<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use App\Testimonial;
class TestimonialController extends Controller
{
    public function addTestimonial(Request $request){

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data); die;
            
            $testimonials = new Testimonial;

            $testimonials->customer_name = $data['customer_name'];
            if (!empty($data['description'])) {
                $testimonials->description = $data['description'];
            }else{
                $testimonials->description = ''; 
            }

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
                    $testimonials->image = $filename;
                }
            }
             //echo "<pre>";print_r($testimonials); die;
            $testimonials->save();
            return redirect()->back()->with('flash_message_success','Testimonial Added Successfuly!');

        }
        return view('admin.testimonials/add_testimonial');
    }
     public function viewTestimonials(Request $request){

        $testimonials = Testimonial::get();
        $testimonials = json_decode(json_encode($testimonials));
      
        // echo "<pre>"; print_r($testimonials); die;
        return view('admin.testimonials.view_testimonials')->with(compact('testimonials'));
    }
}
