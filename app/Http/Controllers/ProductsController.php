<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index(){//ürünlerin listelenmesi
        $products = Products::all();
        return view('backend.product.product_list',compact('products'));
    }

    public function ProductAdd(){//ürün ekleme formuna gidiş
        $products = Products::all();
        return view('backend.product.product_add');
    }

    public function ProductAddPost(Request $request){//ürün ekleme
        $request->validate([
            'model_id'=>'required',
            'name'=>'required',
            'licence'=>'required',
            'licence_plate'=>'required',
            'examination_date'=>'required',
            'credit_amount'=>'required',
            'price'=>'required',
            'status'=>'required'
        ]);

        $kayit = 2;
        $products = Products::create([
            'model_id' => $request->model_id,
            'name' => $request->name,
            'license' => $request->license,
            'license_plate' => $request->license_plate,
            'using_status' => $request->using_status,
            'examination_date' => $request->examination_date,
            'credit_amount' => $request->credit_amount,
            'price' => $request->price,
            'status' => $request->status

        ]);


        $logs = Logs::create([
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' => strval($request->model_id)." id'li yeni ürün eklendi"
        ]);


        return response()->json('basarili');

    }


    // Ürün güncelleme sayfasını açma işlemi yapılıyorr.
    public function ProductUpdate($id){
        // linkten ürünün idsini alınıyor
        $products = Products::where('id',$id)->first();
        return view('backend.product.product_update',compact('products'));
    }

    public function ProductUpdatePost(Request $request,$id){//çekilen id verisine ait ürün güncelleme işlemi yapıldı
        $request->validate([
            'model_id'=>'required',
            'name'=>'required',
            'license'=>'required',
            'license_plate'=>'required',
            'examination_date'=>'required',
            'credit_amount'=>'required',
            'price'=>'required',
            'status'=>'required'
        ]);

        $product = Products::where('id',$id)->update([
            'model_id' => $request->model_id,
            'name' => $request->name,
            'license' => $request->license,
            'license_plate' => $request->license_plate,
            'examination_date' => $request->examination_date,
            'credit_amount' => $request->credit_amount,
            'price' => $request->price,
            'status' => $request->status

        ]);

        $logs = Logs::create([
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' => strval($id)." id'li ürün güncellendi"
        ]);

        return response()->json('basarili');
    }

    public function ProductSoftDelete($id){//çekilen id ye ait ürün kaydının silinmesi

        $product = Products::where('id',$id)->delete();
        $logs = Logs::create([
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' => strval($id)." id'li ürün silindi"
        ]);

        if($product){
            return back()->with('status','Ürün kaydı başarıyla silindi');
        }else{
            return back()->with('status','Ürün kaydı silinemedi');
        }
    }


}
