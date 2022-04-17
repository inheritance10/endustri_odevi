<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\VehicleBrands;
use App\Models\VehicleModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Vehicle extends Controller
{
    public function index(){
        $vehicle_model = VehicleModels::all();
        $vehicle_brand = VehicleBrands::all();
        return view('backend.vehicle.vehicle',compact('vehicle_model','vehicle_brand'));
    }

    public function GetVehicleModels($id){
        $vehicle = VehicleModels::where('brand_id',$id)
            ->get(['id','name as text']);

        return response()->json($vehicle);
    }

    public function VehicleModelAddPost(Request $request){
        VehicleModels::create([
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'description' => $request->description,
            'year' => $request->year,
            'capacity' => $request->capacity
        ]);

        $brand = VehicleBrands::find($request->brand_id);

         Logs::create([
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' => $brand->name." marka ".$request ->name." modeli eklendi"
        ]);

        return back();

    }

    public function VehicleModelDelete($id){
        $vehicle = VehicleModels::find($id);

        VehicleModels::where('id',$id)
            ->delete();

        $brand = VehicleBrands::find($vehicle->brand_id);

        Logs::create([
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' => $brand->name." marka ".$vehicle->name." modeli silindi"
        ]);

        return back();

    }

    public function VehicleBrandAddPost(Request $request){
        VehicleBrands::create([
            'name' => $request->name
        ]);

       Logs::create([
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' =>  $request ->name." adlı marka eklendi"
        ]);

        return back();
    }

    public function VehicleBrandDelete($id){
        $vehicle = VehicleBrands::find($id);

         VehicleBrands::where('id',$id)
            ->delete();


        Logs::create([
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' =>  $vehicle->name." adlı marka silindi"
        ]);

        return back();
    }
}
