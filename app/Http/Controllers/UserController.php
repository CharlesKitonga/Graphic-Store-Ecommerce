<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Country;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\Frontlogin;

class UserController extends Controller
{
    public function Register(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		//echo "<pre>";print_r($data);die;
    		$usersCount = User::where('email',$data['email'])->count();
    		if ($usersCount>0) {
    			return redirect()->back()->with('flash_message_error','Email has already been taken!');
    		}else{
                $users = new User;
                $users->name = $data['name'];
                $users->email = $data['email'];
                $users->password = bcrypt($data['password']);
                $users->save();
                if (Auth::Attempt(['email'=>$data['email'], 'password'=>$data['password']])) {
                    Session::put('frontSession',$data['email']); 
                    return redirect('/cart');
                }

            }
    	}

    	return view('users.register');
    }

    public function Login(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
            if (Auth::Attempt(['email'=>$data['email'],'password'=>$data['password']])) {
                Session::put('frontSession',$data['email']); 
                return redirect('/cart');   
            }else{
                return redirect()->back()->with('flash_message_error','Invalid Username or Password');
            }
        }

    	return view('users.signin');
    }

    public function Account(Request $request){
        $user_id = Auth::User()->id;
        $userDetails = User::find($user_id);
        //echo "<pre>";print_r($userDetails);die;
       
       if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
 
            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->mobile = $data['mobile'];
            $user->save();

            return redirect()->back()->with('flash_message_success','Your Account Details have been Updated Succesfully');
       }
        $countries = Country::get();
        return view('users.account')->with(compact('countries','userDetails'));
    }

    public function CheckUserPwd(Request $request){
        $data = $request->all();
        //echo "<pre>";print_r($data);die;
        $current_pwd = $data['current_pwd'];
        $user_id = Auth::User()->id;
        $check_password = User::where('id',$user_id)->first();
        if(Hash::check($current_pwd,$check_password->password)){
            echo "true";die;
        }else{
            echo "false";die;
        }
    }
    public function updateUserPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
            $old_password = User::where('id',Auth::User()->id)->first();
            $current_pwd = $data['current_pwd'];
            if (Hash::check($current_pwd,$old_password->password)) {
                 //update password
                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id', Auth::User()->id)->update(['password'=>$new_pwd]);
                 return redirect('/account')->with('flash_message_success','Password Updated Succesfully!');
            }else{
                return redirect('/account')->with('flash_message_error','Your Passwords do not Match!');
            }

        }
    }

    public function checkEmail(Request $request){
    	//check if user already exists
   		$data = $request->all();

    	$usersCount = User::where('email',$data['email'])->count();
    		if ($usersCount>0) {
    			echo "false";
    		}else{
    			echo "true";
    		}
    }

    public function logout(){
        Auth::logout();
        Session::forget('frontSession');
        return redirect('/');
    }
}
