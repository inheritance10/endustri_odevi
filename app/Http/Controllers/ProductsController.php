<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Logs;
use App\Models\VehicleBrands;
use App\Models\VehicleModels;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    // Araçların listelenmesi
    public function index()
    {
        // giriş yapmış olan kullanıcıların bilgileri
        $user = Auth::user();
        // Listelenecek tüm araçlar
        $products = Products::leftJoin('vehicle_models', 'model_id', 'vehicle_models.id')
            ->leftJoin('vehicle_brands', 'brand_id', 'vehicle_brands.id');
        // Giriş yapan kişi yetkiliyse silinmiş araçlar da geliyor
        if (Auth::user()->user_type <= 0){
            $products = $products->withTrashed();
        }
        $products = $products->get(['products.id',
                'vehicle_brands.name as brand_name',
                'vehicle_models.name as model_name',
                'products.description',
                'license',
                'license_plate',
                'examination_date',
                'credit_amount',
                'price',
                'using_status',
                'deleted_at',
                'status',
            ]);
        return view('backend.product.product_list', compact('products', 'user'));
    }

    // Araç ekleme formu
    public function ProductAdd()
    {
        // Listelemek üzere araç markaları da alınıyor
        $brands = VehicleBrands::all();
        return view('backend.product.product_add', compact('brands'));
    }
    // Araç ekleme işlemi
    public function ProductAddPost(Request $request)
    {
        // Tarayıcıdan gelen veriler veritabanına kaydediliyor
        Products::create([
            'model_id' => $request->model_id,
            'name' => $request->name,
            'license' => $request->license,
            'license_plate' => $request->license_plate,
            'using_status' => $request->using_status,
            'examination_date' => date("Y-m-d h:i:s", strtotime($request->examination_date)),
            'credit_amount' => $request->credit_amount,
            'price' => $request->price,
            'status' => $request->status
        ]);

        // Yapılan işlem kayıt altına alınıyor.
        $model = VehicleModels::find($request->model_id);
        $brand = VehicleBrands::find($model->brand_id);
        Logs::create([
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' =>  $brand->name. " marka " . $model->name . " model yeni araç eklendi."
        ]);

        // İşlem olumlu sonuçlandığında dönüş yapılıyor
        return response()->json('basarili');

    }


    // Ürün güncelleme sayfasını açma işlemi yapılıyorr.
    public function ProductUpdate($id)
    {
        // linkten ürünün idsini alınıyor

        $brands = VehicleBrands::all();
        $models = VehicleModels::all();

        $products = Products::leftJoin('vehicle_models', 'model_id', 'vehicle_models.id')
            ->leftJoin('vehicle_brands', 'brand_id', 'vehicle_brands.id')
            ->where('products.id', $id)
            ->withTrashed()
            ->get(['products.id',
                'vehicle_brands.name as brand_name',
                'vehicle_models.name as model_name',
                'model_id',
                'products.description',
                'license',
                'license_plate',
                'examination_date',
                'credit_amount',
                'price',
                'using_status',
                'deleted_at',
                'status',
            ])[0];
        return view('backend.product.product_update', compact('products', 'brands','models'));
    }

    public function ProductUpdatePost(Request $request, $id)
    {//çekilen id verisine ait ürün güncelleme işlemi yapıldı

        $product = Products::where('id', $id)->first();

        $product->update([
            'model_id' => $request->model_id,
            'name' => $request->name,
            'license' => $request->license,
            'license_plate' => $request->license_plate,
            'examination_date' => $request->examination_date,
            'credit_amount' => $request->credit_amount,
            'price' => $request->price,
            'status' => $request->status
        ]);

        // Yapılan işlem kayıt altına alınıyor.
        $model = VehicleModels::find($request->model_id);
        $brand = VehicleBrands::find($model->brand_id);
        Logs::create([
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' =>  $brand->name. " marka " . $model->name . " model araç üzerinde düzenleme yaptı."
        ]);

        return redirect('product');
    }

    public function ProductSoftDelete($id)
    {//çekilen id ye ait araç kaydının silinmesi

        $product = Products::find($id);

        // Yapılan işlem kayıt altına alınıyor.
        $model = VehicleModels::find($product->model_id);
        $brand = VehicleBrands::find($model->brand_id);
        Logs::create([
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' =>  $brand->name. " marka " . $model->name . " model aracı sildi."
        ]);


        if ($product->delete()) {
            return back()->with('status', 'Ürün kaydı başarıyla silindi');
        } else {
            return back()->with('status', 'Ürün kaydı silinemedi');
        }
    }

    public function ProductRestore($id)
    {//çekilen id ye ait araç kaydının geri yüklenmesi

        $product = Products::withTrashed()->find($id);

        // Yapılan işlem kayıt altına alınıyor.
        $model = VehicleModels::find($product->model_id);
        $brand = VehicleBrands::find($model->brand_id);
        Logs::create([
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' =>  $brand->name. " marka " . $model->name . " model aracı geri yükledi."
        ]);


        if ($product->restore()) {
            return back()->with('status', 'Ürün kaydı başarıyla geri yüklendi');
        } else {
            return back()->with('status', 'Ürün kaydı geri yüklenemedi');
        }
    }


}
