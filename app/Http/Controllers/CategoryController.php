<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use App\Category;
use App\Products_Attributes;
class CategoryController extends Controller
{
    public function addCategory(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		// echo "<pre>";print_r($data);die;

            if (empty($data['status'])) {
                $status = 0;
            }else{
                $status = 1;
            }

    		$category = new Category;
    		$category->category_name=$data['category_name'];
            $category->parent_id=$data['parent_id'];
    		$category->description=$data['description'];
    		$category->url=$data['url'];
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
                    $category->image = $filename;

                }
            }
            $category->status = $status;
            //echo "<pre>";print_r($category);die;
    		$category->save();
            return redirect('/admin/categories/view_category')->with('flash_message_success','Category Added Succesfully!!');
    	}
        $levels = Category::where(['parent_id'=>0])->get();
    	return view('/admin/categories.add_category')->with(compact('levels'));
    }

    public function editCategory(Request $request, $id = null){
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;

             if (empty($data['status'])) {
                $status = 0;
            }else{
                $status = 1;
            }

            Category::where(['id'=>$id])->update(['category_name'=>$data['category_name'],'description'=>$data['description'],'url'=>$data['url'],'status'=>$status]);
            return redirect('/admin/categories/view_category')->with('flash_message_success','Category updated Successfully!');
        }
        $categoryDetails = Category::where(['id'=>$id])->first();
        $levels = Category::where(['parent_id'=>0])->get();
        return view('admin/categories.edit_category')->with(compact('categoryDetails','levels'));
    }
   
    public function deleteCategory($id = null){
        if (!empty($id)) {
            Category::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Category deleted Successfully!');
        }
   }

    public function viewCategories(Request $request){
        $categories = Category::get();
        $categories = json_decode(json_encode($categories));
        return view('/admin/categories.view_categories')->with(compact('categories'));
    }
    public function addAttributes(Request $request, $category_name=null ){
        $productDetails = Category::with('attributes')->where(['category_name'=>$category_name])->first();
         $productDetails =json_decode(json_encode($productDetails));
        // echo "<pre>"; print_r($productDetails);die;
         $productsDetails = Category::with('attributes')->where(['category_name'=>$category_name])->get();
         $productsDetails = json_decode($productsDetails,true);
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;

            foreach ($data['designs'] as $key => $val) {
                if (!empty($val)) {

                    $attribute = new Products_Attributes;
                    $attribute->category_name = $category_name;
                    $attribute->designs = $val;
                    $attribute->designers = $data['designers'][$key];
                    $attribute->revisions = $data['revisions'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->guarantee = $data['guarantee'][$key];
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
                            $attribute->image = $filename;
                        }
                    }

                    $attribute->save();
                }
            }
            return redirect('admin/add_category_attributes/'.$category_name)->with('flash_message_success', 'Product Attributes have been updated Successfully!');
        }

        return view('admin/categories.add_attributes')->with(compact('productDetails','productsDetails'));
    }
}
