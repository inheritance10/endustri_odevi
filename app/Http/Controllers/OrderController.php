<?php

namespace App\Http\Controllers;
use App\Models\Logs;
use App\Models\Orders;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Satışlar Sayfası
    public function index(){
        // Giriş yetkisi yoksa hata veriyor
        if (Auth::user()->user_type != 0){
            abort(401);
        }

        //Tüm yapılan satışlar çekiliyor
        $orders = Products::leftJoin('vehicle_models', 'model_id', 'vehicle_models.id')
            ->leftJoin('vehicle_brands', 'brand_id', 'vehicle_brands.id')
            ->withTrashed()
            ->whereNotNull('sold_date')
            ->get(['products.id',
                'vehicle_brands.name as brand_name',
                'vehicle_models.name as model_name',
                'products.description',
                'credit_amount',
                'sold_date',
                'price',
            ]);

        //Yalnızca bu ay yapılan satışlar çekiliyor
        $ordersThisMonth = Products::leftJoin('vehicle_models', 'model_id', 'vehicle_models.id')
            ->leftJoin('vehicle_brands', 'brand_id', 'vehicle_brands.id')
            ->withTrashed()
            ->whereNotNull('sold_date')
            ->whereDate('sold_date', '>',Carbon::now()->startOfMonth())
            ->get();

        return view('order',compact('orders', 'ordersThisMonth'));
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
