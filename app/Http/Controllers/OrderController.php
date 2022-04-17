<?php

namespace App\Http\Controllers;
use App\Models\Logs;
use App\Models\Products;
use App\Models\Orders;
use App\Models\CustomerDatas;
use App\Models\VehicleBrands;
use App\Models\VehicleModels;
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
        $products = Products::leftJoin('vehicle_models', 'model_id', 'vehicle_models.id')
            ->leftJoin('vehicle_brands', 'brand_id', 'vehicle_brands.id')
            ->withTrashed()
            ->whereNull('sold_date')
            ->get([
            'products.id',
            'vehicle_brands.name as brand_name',
            'vehicle_models.name as model_name',
            'price',
            ]);
        return view('order_add',compact('products'));
    }

    public function OrderAddPost(Request $request){


        $product = Products::find($request->product_id);

        $model_id = $product->model_id;

        $model = VehicleModels::where('id' ,'=', $model_id)->first();
        $brand = VehicleBrands::where('id' ,'=', $model->brand_id)->first();

         $product->update([
            'sold_date' => Carbon::now()
        ]);


         $customer = CustomerDatas::create([
            'full_name' => $request->full_name,
            'description' => $request->description
        ]);



         Orders::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'customer_data_id' => $customer->id
         ]);

         Logs::create([
             'IslemYapan' => Auth::user()->name,
             'YapilanIslem' => $brand->name." ".$model->name.' model araç satıldı'
         ]);

         return back();
    }

    public function OrderUpdate($id){
        $order = Products::where('id',$id)->first();
        return view('orderupdate',compact('order'));
    }

}
