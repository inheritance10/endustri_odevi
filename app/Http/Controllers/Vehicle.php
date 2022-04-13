<?php

namespace App\Http\Controllers;

use App\Models\VehicleBrands;
use App\Models\VehicleModels;
use Illuminate\Http\Request;

class Vehicle extends Controller
{
    public function VehicleModelIndex(){
        $vehicle = VehicleModels::all();
        return view('backend.vehicleModel.vehicle_model',compact('vehicle'));
    }


    public function VehicleModelAddPost(Request $request){
        $request->validate([
            'brand_id' => 'required',
            'name' => 'required',
            'year' => 'required',
            'capacity' => 'required'
        ]);
         VehicleModels::create([
            'brand_id' => $request->user_id,
            'name' => $request->customer_data_id,
            'description' => $request->status,
            'year' => $request->year,
            'capacity' => $request->capacity
        ]);
        return response()->json('basarili');

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

    public function VehicleBrandsIndex()
    {
        $vehicle = VehicleBrands::all();
        return view('backend.vehicleBrand.vehicle_brand', compact('vehicle'));
    }

    public function VehicleBrandAddPost(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $vehicle = VehicleBrands::create([
            'name' => $request->name
        ]);
        return response()->json('basarili');

    }

    public function VehicleBrandDelete($id){
        $vehicle = VehicleBrands::where('id',$id)
            ->delete();
        if($vehicle){
            return 'silinme tamamlandı';
        }else{
            return 'silme işlemi başarısız';
        }
    }
}
