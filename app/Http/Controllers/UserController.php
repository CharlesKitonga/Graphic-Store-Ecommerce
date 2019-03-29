<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
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

    public function Account(){
        return view('users.account');
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
        return redirect('/');
    }
}
