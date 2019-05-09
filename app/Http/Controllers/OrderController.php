<?php

namespace App\Http\Controllers;
use App\Order;
use Carbon\Carbon;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Session;
use DB;

class OrderController extends Controller
{
     public function Orders($type='')
    {
        if($type =='pending'){
            $orders=Order::where('status','0')->get();
            return view('admin.orders.pending', compact('orders'));
        }elseif ($type == 'delivered'){
            $orders=Order::where('status','1')->get();
            return view('admin.orders.delivered',compact('orders'));
        }else{
            $orders=Order::all();        
            return view('admin.orders.orders',compact('orders'));
        }
    }
     public function toggledeliver(Request $request,$orderId)
    {
        $order=Order::find($orderId);

        if($request->has('delivered')){
            $time=Carbon::now()->addMinute(1);

            Mail::to($order->user)->later($time,new OrderShipped($order));

            $order->delivered=$request->delivered;
        }else{
            $order->delivered="0";
        }
        $order->save();

        return back();
    }

    public function editOrder(Request $request, $id = null){
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;

             if (empty($data['status'])) {
                $status = 0;
            }else{
                $status = 1;
            }

            Order::where(['id'=>$id])->update(['status'=>$status]);
            return redirect('/orders/pending')->with('flash_message_success','Order updated Successfully!');
        }
        $orders=Order::where(['id'=>$id])->get();
        return view('admin/orders.edit_order')->with(compact('orders'));
    }
   
     public function deleteOrder($id = null){
        if (!empty($id)) {
            Order::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Order deleted Successfully!');
        }
   }
}
