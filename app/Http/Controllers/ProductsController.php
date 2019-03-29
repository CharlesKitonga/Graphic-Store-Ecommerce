<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use Auth;
use Session;
use App\Job;
use App\Cart;
use App\Category;
use App\Products_Attributes;
use App\SliderProducts;
use App\Product;
use App\Package;
use App\Products_Images;
use DB;

class ProductsController extends Controller
{
    public function addProduct(Request $request){

    	if ($request->isMethod('post')) {
    		$data = $request->all();
    		// echo "<pre>";print_r($data); die;
    		if(empty($data['category_name'])){
    			return redirect()->back()->with('flash_message_error','Under Category is missing!');	
    		}
 			$product = new Product;

 			$product->category_name = $data['category_name'];
 			$product->product_name = $data['product_name'];
 			$product->product_code = $data['product_code'];
            if (!empty($data['description'])) {
                $product->description = $data['description'];
            }else{
                $product->description = ''; 
            }
 			$product->price =$data['price'];

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
    				$product->image = $filename;
 				}
 			}


 			$product->save();
 			return redirect()->back()->with('flash_message_success','Service Added Successfuly!');

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

    	return view('admin.products.add_products')->with(compact('categories_dropdown'));
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
    
    public function viewProducts(Request $request){

        $products = Product::get();
        $products = json_decode(json_encode($products));
        // foreach($products as $key => $val){
        //     $category_name = Category::where(['id'=>$val->category_id])->first();
        //     $products[$key]->category_name = $category_name->category_name;
        // }
        // echo "<pre>"; print_r($products); die;
        return view('admin.products.view_products')->with(compact('products'));
    }
    
    public function deleteProduct($id = null){
        Product::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Product has been Deleted Successfully!');
    }
    public function deleteSliderProduct($id = null){
        SliderProducts::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Service has been Deleted Successfully!');
    }

    public function deleteProductImage($id = null){
        
        //Get Product Image Name
        $productImage = Product::where(['id'=>$id])->first();

        //Get Product Image path
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

        //Delete Image from Products table
        Product::where(['id'=>$id])->update(['image'=>'']);
        return redirect()->back()->with('flash_message_success','Service Image has been Deleted!');
    }

    public function deleteAltImage($id = null){
        
        //Get Product Image Name
        $productImage = Products_Images::where(['id'=>$id])->first();

        //Get Product Image path
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

        //Delete Image from Products table
        Products_Images::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Service Alternate Image has been Deleted!');
    }
    public function addAttributes(Request $request, $id=null ){
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
        // $productDetails =json_decode(json_encode($productDetails));
        // echo "<pre>"; print_r($productDetails);die;

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;

            foreach ($data['sku'] as $key => $val) {
                if (!empty($val)) {
                    //Prevent SKU duplicate entry
                    $attrCountSKU = Products_Attributes::where('sku',$val)->count();
                    if ($attrCountSKU>0) {
                        return redirect('admin/add_attributes/'.$id)->with('flash_message_error', 'SKU already exists!Please add another SKU');
                    }
                    //Prevent Size duplicate entry
                    $attrCountSizes = Products_Attributes::where(['product_id'=>$id, 'size'=>$data['size'][$key]])->count();
                    if ($attrCountSizes>0) {
                        return redirect('admin/add_attributes/'.$id)->with('flash_message_error',      '"'.$data['size'][$key].'Size already exists for this product!Please add another size');
                    }

                    $attribute = new Products_Attributes;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->color = $data['color'][$key];
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }
            return redirect('admin/add_attributes/'.$id)->with('flash_message_success', 'Product Attributes have been updated Successfully!');
        }

        return view('admin/products.add_attributes')->with(compact('productDetails'));
    }

     public function addImages(Request $request, $id=null ){
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();

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

        $productsImages = Products_Images::where(['product_id'=>$id])->get();
          
        return view('admin/products.add_images')->with(compact('productDetails','productsImages'));
    }

    public function editAttributes(Request $request,$id=null){
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            foreach ($data['idAttr'] as $key => $attr) {
                Products_Attributes::where(['id'=>$data['idAttr'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
            }
            return redirect()->back()->with('flash_message_success', 'Price and Stock updated Successfuly!');
        }
    }

    public function deleteAttribute($id = null){
        Products_Attributes::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Attribute has been Deleted Successfully!');
    }

    public function service($id = null){
        //Get Product Details
        $serviceDetails = Package::where('id',$id)->get();
        $serviceDetails = json_decode(json_encode($serviceDetails));
        // echo "<pre>";print_r($serviceDetails);die;


        return view('single')->with(compact('serviceDetails'));
    }

    public function getProductPrice(Request $request){
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        $proArr = explode("-",$data['idSize']);
        $proAttr = Products_Attributes::where(['product_id'=>$proArr[0], 'size'=>$proArr[1]])->first();
        echo $proAttr->price;

        echo "#";
        echo $proAttr->stock;
    }
 
    public function addtocart(Request $request){
        $data = $request->all();
        //echo "<pre>";print_r($data);die;
      if (empty($data['user_email'])) {
            $data['user_email'] = '';
        }
        if (empty($data['session_id'])) {
            $data['session_id'] = '';
        } 

        $session_id = Session::get('session_id');
        if (empty($session_id)) {
            $session_id = str_random(40);
            Session::put('session_id',$session_id);
        }

        $countProducts = 
        DB::table('carts')->where(['product_id'=>$data['product_id'],'designs'=>$data['designs'],'session_id'=>$session_id])->count();
        if ($countProducts>0) {
            return redirect()->back()->with('flash_message_error','Service already exists in Cart!');
        }else{
             DB::table('carts')->insert(['product_id'=>$data['product_id'],'designs'=>$data['designs'],'designers'=>$data['designers'],'revisions'=>$data['revisions'],'price'=>$data['price'],'user_email'=>$data['user_email'],'session_id'=>$session_id]);
        }

        return redirect('cart')->with('flash_message_success', 'Service has been Added in Cart');

    }
    public function cart(){
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();

        foreach ($userCart as $key => $product) {
            $productDetails = Package::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
        //echo "<pre>";print_r($userCart);die;
        return view('cart')->with(compact('userCart'));
    } 
    public function updateCartQuantity($id=null,$quantity=null){
        DB::table('carts')->where('id',$id)->increment('quantity',$quantity);
        return redirect('cart')->with('flash_message_success', 'Product Quantity has been Updated Successfully!');   
    }

    public function deleteCart($id = null){
        Cart::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Service has been Deleted Successfully!');
    }
    public function search(Request $request){

        $request->validate([
            'query' =>'required|min:3',
        ]);
        $query = $request->input('query');

                // one way of searching for a product
        $products = Product::where('product_name', 'like', "%$query%")
                        ->orwhere('description', 'like', "%$query%")->paginate(10);
        //different way using the searchable trait
        // $products = Product::search($query)->paginate(10);

        return view('search-results')->with(compact('products'));
    }
}
