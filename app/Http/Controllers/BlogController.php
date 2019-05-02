<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use DB;
use App\Blog;
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
    public function showDetails($id){

    	$blog = Blog::find($id);
    	//echo "<pre>";print_r($blog);die;
    	return view('blogs.show')->with(compact('blog'));
    }
}
