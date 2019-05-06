<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use DB;
use App\Blog;
use App\Products_Images;
class BlogController extends Controller
{
    public function index(){
    	$blogs = Blog::all();

    	return view('blogs.index')->with(compact('blogs'));
    }
    //admin function for adding blog 
    public function createBlog(Request $request){
    	if($request->isMethod('post')) {
    		$data = $request->all();

    		$blogs = new Blog;
    		$blogs->author = $data['author'];
    		$blogs->heading = $data['heading'];    		
    		$blogs->title = $data['title'];
            $blogs->content = $data['content'];
            $blogs->description = $data['description'];
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
                    Image::make($image_tmp)->resize(750,350)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                    // Store image name in products table
                    $blogs->image = $filename;
                }
            }
    		//echo "<pre>";print_r($blogs);die;
    		$blogs->save();
    		return redirect()->back()->with('flash_message_success','Blog Added Successfuly!');

    	}
    	return view('admin/blogs.create');
    }
    //admin function for viewing blogs
    public function viewBlogs(){
    	$blogs = Blog::get();
    	return view('admin/blogs.view-blogs')->with(compact('blogs'));
    }
     public function editBlog(Request $request, $id=null){

        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>";print_r($data);die;

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
                    Image::make($image_tmp)->resize(750,350)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path); 
                }
            }else{
                $filename = $data['current_image'];
            }

            if (empty($data['description'])) {
                $data['description'];
            }

           Blog::where(['id'=>$id])->update(['author'=>$data['author'],'heading'=>$data['heading'],'title'=>$data['title'],'content'=>$data['content'],'description'=>$data['description'], 'image'=>$filename]);
            return redirect('admin/blogs/view_blogs')->with('flash_message_success', 'Blog has been Updated Successfully!');

        }

        $blogDetails = Blog::where(['id'=>$id])->first();

        return view('/admin/blogs.edit-blog')->with(compact('blogDetails'));
    }
    public function deleteBlog($id = null){
        if (!empty($id)) {
            Blog::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Blog deleted Successfully!');
        }
   }
    public function addBlogImages(Request $request, $id=null ){
        $blogDetails = Blog::where(['id'=>$id])->first();

        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                foreach ($files as $file) {
                    //Upload Images afer Resize
                    $image = new Products_Images;
                    $extension = $file->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(650,480)->save($medium_image_path);
                    Image::make($file)->resize(300,300)->save($small_image_path);
                    // Store image name in products-image table
                    $image->image = $filename;
                    $image->product_id = $data['product_id'];
                    $image->save();                    
               }
                
            }                
        }

        $blogImages = Products_Images::where(['product_id'=>$id])->get();
          
        return view('admin/blogs.add_images')->with(compact('blogDetails','blogImages'));
    }
       public function deleteBlogImage($id = null){
        
        //Get Blog Image Name
        $productImage = Blog::where(['id'=>$id])->first();

        //Get Blog Image path
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        //Delete Large Image if not exist in large folder
        if (file_exists($large_image_path.$productImage->image)) {
            unlink($large_image_path.$productImage->image);
        }

        //Delete Large Image if not exist in large folder
        if (file_exists($medium_image_path.$productImage->image)) {
            unlink($medium_image_path.$productImage->image);
        }
        //Delete Small Image if not exist in large folder
        if (file_exists($small_image_path.$productImage->image)) {
            unlink($small_image_path.$productImage->image);
        }

        //Delete Image from Blogs table
        Blog::where(['id'=>$id])->update(['image'=>'']);
        return redirect()->back()->with('flash_message_success','Image Image has been Deleted!');
    }
    public function showDetails($id){

        $blogDetails = Blog::where(['id'=>$id])->first();
        $blogImages = Products_Images::where('product_id',$id)->get();
    	//echo "<pre>";print_r($blog);die;
    	return view('blogs.show')->with(compact('blogDetails', 'blogImages'));
    }
}
