<?php

namespace App\Http\Controllers;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Orders::all();
        return view('order',compact('orders'));
    }

    public function OrderAdd(){
        return view('orderadd');
    }

    public function OrderAddPost(Request $request){
        $request->validate([
            'user_id' => 'required',
            'customer_data_id' => 'required'
        ]);
         $order = Orders::create([
            'user_id' => $request->user_id,
            'customer_data_id' => $request->customer_data_id,
            'status' => $request->status
         ]);

         return response()->json("basarili");
    }

    public function OrderUpdate($id){
        $order = Products::where('id',$id)->first();
        return view('orderupdate',compact('order'));
    }

    public function OrderUpdatePost(Request $request,$id){
        $request->validate([
            'user_id' => 'required',
            'customer_data_id' => 'required'
        ]);

        $order = Orders::where('id',$id)->update([
            'user_id' => $request->user_id,
            'customer_data_id' => $request->customer_data_id,
            'status' => $request->status
        ]);
       return response()->json('basarili');
    }

    public function OrderDelete($id){
        $order = Orders::where('id',$id)
            ->delete();
        if($order){
            return 'silinme tamamlandı';
        }else{
            return 'silme işlemi başarısız';
        }
    }
}
