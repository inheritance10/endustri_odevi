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

        //orders ,ordersThisMonth verileri sayfaya gönderildi
        return view('order',compact('orders', 'ordersThisMonth'));
    }

    public function OrderAdd(){//Tablolar birleştirilerek verilerin çekilme işlemi yapıldı.
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

        //products da ki verilerin order_add sayfasına gönderimi yapıldı
        return view('order_add',compact('products'));
    }

    public function OrderAddPost(Request $request){


        //Form üzerinde gelen product_id ye göre Araçlar tablosundan $product değişkenine veri çekildi.
        $product = Products::find($request->product_id);

        $model_id = $product->model_id; //Araçlar tablosundan gelen verilerin içerisinden model_id çekildi.

        //çekilen model_id ye göre where sorgusuyla gelen ilk veriyi $model değişkenine çekildi.
        $model = VehicleModels::where('id' ,'=', $model_id)->first();

        //Model değişkeni üzerinden marka id ye ulaşıp where sorgusu üzerinden gelen ilk veriyi $brand değişkenine çekildi.
        $brand = VehicleBrands::where('id' ,'=', $model->brand_id)->first();

         $product->update([//satış tarihi güncellenmesi yapıldı.
            'sold_date' => Carbon::now()
        ]);


         $customer = CustomerDatas::create([//Müşteri verileri tablosuna isim ve açıklama kaydı yapıldı.
            'full_name' => $request->full_name,
            'description' => $request->description
        ]);


         Orders::create([//Siparişler tablosuna siparişi gerçekleştiren user_id,Hangi araç olduğu product_id,hangi müşteriye ait olduğu customer_data_id alanına kaydı yapıldı.
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'customer_data_id' => $customer->id
         ]);

         Logs::create([//Bu işlemlerin Hangi kullanıcı tarafından yapıldığı ve yapılan işlemin ne olduğu Logs tablosuna kayıt edildi.
             'IslemYapan' => Auth::user()->name,
             'YapilanIslem' => $brand->name." ".$model->name.' model araç satıldı'
         ]);

         return back();//Sayfaya geri dönüş sağlandı.
    }


}
