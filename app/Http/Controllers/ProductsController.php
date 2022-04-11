<?php

namespace App\Http\Controllers;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){//ürünlerin listelenmesi
        $products = Products::all();
        return view('product',compact('products'));
    }

    public function ProductAddValidate(Request $request){//Formdaki zorunlu alanların kontrolü
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
    }

    public function ProductAdd(){//ürün ekleme formuna gidiş
        return view('productadd');
    }

    public function ProductAddPost(Request $request){//ürün ekleme
        $this->UserAddValidate($request);
        $products = Products::create([
            'model_id' => $request->model_id,
            'name' => $request->name,
            'licence' => $request->licence,
            'licence_plate' => $request->licence_plate,
            'examination_date' => $request->examination_date,
            'credit_amount' => $request->credit_amount,
            'price' => $request->price,
            'status' => $request->status
        ]);
        if($products->create()){
            return 'kayıt başarılı';
        }else{
            return 'kayıt başarısız';
        }
    }


    //güncelleme işlemi için sayfa yönlendirilmesi ve id nin çekilmesi
    // çekilen id ye ait ürün verilerinin güncelleme formuna aktarımı
    public function ProductUpdate($id){
        $products = Products::where('id',$id)->first();
        return view('productupdate',compact('products'));
    }

    public function ProductUpdatePost(Request $request,$id){//çekilen id verisine ait ürün güncelleme işlemi yapıldı
        $this->ProductAddValidate($request);

        $product = Products::where('id',$id)->update([
            'model_id' => $request->model_id,
            'name' => $request->name,
            'licence' => $request->licence,
            'licence_plate' => $request->licence_plate,
            'examination_date' => $request->examination_date,
            'credit_amount' => $request->credit_amount,
            'price' => $request->price,
            'status' => $request->status
        ]);
    }

    public function ProductSoftDelete($id){//çekilen id ye ait ürün kaydının silinmesi
        $product = Products::where('id',$id)->delete();
        if($product){
            return 'kayıt silindi';
        }else{
            return 'kayıt silinemedi';
        }
    }
}
