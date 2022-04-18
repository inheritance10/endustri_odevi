<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\VehicleBrands;
use App\Models\VehicleModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Vehicle extends Controller
{
    public function index(){//Modeller ve markalar tablosundan veriler çekilip sayfaya gönderildi.
        $vehicle_model = VehicleModels::all();
        $vehicle_brand = VehicleBrands::all();
        return view('backend.vehicle.vehicle',compact('vehicle_model','vehicle_brand'));
    }

    public function GetVehicleModels($id){//Seçilen markaya ait model verileri geliyor
        $vehicle = VehicleModels::where('brand_id',$id)
            ->get(['id','name as text']);

        return response()->json($vehicle);
    }

    public function VehicleModelAddPost(Request $request){//Araç modeli eklenmesi işlemi yapıldı.
        VehicleModels::create([
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'year' => $request->year,
        ]);

        $brand = VehicleBrands::find($request->brand_id);//Form üzerinden gelen brand_id alanına göre marka verisi çekildi.

         Logs::create([//yapılan işlem kayıt altına alındı.
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' => $brand->name." marka ".$request ->name." modeli eklendi"
        ]);

        return back();//Bulunulan sayfaya geri dönüldü.

    }

    public function VehicleModelDelete($id){

        //Adres üzerinden gelen id alanına göre model verisi çekildi
        $vehicle = VehicleModels::find($id);

        VehicleModels::where('id',$id)//Adres üzerinden gelen id alanına göre Model silme işlemi yapıldı.
            ->delete();

        $brand = VehicleBrands::find($vehicle->brand_id);//Çekilen model verisine göre marka verisi çekildi.

        Logs::create([//Yapılan silme işlemi kayıt altına alındı.
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' => $brand->name." marka ".$vehicle->name." modeli silindi"
        ]);

        return back();//Bulunulan sayfaya geri dönüldü.

    }

    public function VehicleBrandAddPost(Request $request){
        VehicleBrands::create([//Araç markası eklenmesi işlemi yapıldı.
            'name' => $request->name
        ]);

       Logs::create([//Yapılan ekleme işlemi kayıt altına alındı.
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' =>  $request ->name." adlı marka eklendi"
        ]);

        return back();//Bulunulan sayfaya geri dönüldü.
    }

    public function VehicleBrandDelete($id){
        $vehicle = VehicleBrands::find($id);//Adres üzerinden gelen id alanına göre marka verisi çekildi

         VehicleBrands::where('id',$id)//Adres üzerinden gelen id alanına göre marka silme işlemi yapıldı.
            ->delete();


        Logs::create([//Yapılan silme işlemi kayıt altına alındı.
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' =>  $vehicle->name." adlı marka silindi"
        ]);

        return back();//Bulunulan sayfaya geri dönüldü.
    }
}
