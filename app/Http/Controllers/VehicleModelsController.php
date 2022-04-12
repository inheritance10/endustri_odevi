<?php

namespace App\Http\Controllers;

use App\Models\VehicleModels;
use Illuminate\Http\Request;

class VehicleModelsController extends Controller
{
    public function index(){
        $vehicle = VehicleModels::all();
        return view('vehicle',compact('vehicle'));
    }

    public function VehicleModelAdd(){
        return view('vehiclemodeladd');
    }

    public function VehicleModelAddPost(Request $request){
        $request->validate([
            'brand_id' => 'required',
            'name' => 'required',
            'year' => 'required',
            'capacity' => 'required'
        ]);
        $vehicle = VehicleModels::create([
            'brand_id' => $request->user_id,
            'name' => $request->customer_data_id,
            'description' => $request->status,
            'year' => $request->year,
            'capacity' => $request->capacity
        ]);
        if($vehicle){
            return 'kayıt başarılı';
        }else{
            return 'kayıt başarısız';
        }

    }

    public function VehicleModelUpdate($id){
        $vehicle = VehicleModels::where('id',$id)->first();
        return view('vehiclemodelupdate',compact('vehicle'));
    }

    public function VehicleModelUpdatePost(Request $request,$id){
        $request->validate([
            'brand_id' => 'required',
            'name' => 'required',
            'year' => 'required',
            'capacity' => 'required'
        ]);

        $vehicle = VehicleModels::where('id',$id)->update([
            'brand_id' => $request->user_id,
            'name' => $request->customer_data_id,
            'description' => $request->status,
            'year' => $request->year,
            'capacity' => $request->capacity
        ]);
        if($vehicle){
            return 'güncelleme başarılı';
        }else{
            return 'güncelleme başarısız';
        }
    }

    public function VehicleModelDelete($id){
        $vehicle = VehicleModels::where('id',$id)
            ->delete();
        if($vehicle){
            return 'silinme tamamlandı';
        }else{
            return 'silme işlemi başarısız';
        }
    }
}
