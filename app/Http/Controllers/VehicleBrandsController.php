<?php

namespace App\Http\Controllers;

use App\Models\VehicleBrands;
use Illuminate\Http\Request;

class VehicleBrandsController extends Controller
{
    public function index(){
        $vehicle = VehicleBrands::all();
        return view('vehicle',compact('vehicle'));
    }

    public function VehicleBrandAdd(){
        return view('vehiclebrandadd');
    }

    public function VehicleBrandAddPost(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $vehicle = VehicleBrands::create([
            'name' => $request->name
        ]);
        if($vehicle){
            return 'kayıt başarılı';
        }else{
            return 'kayıt başarısız';
        }

    }

    public function VehicleBrandUpdate($id){
        $vehicle = VehicleBrands::where('id',$id)->first();
        return view('vehiclebrandupdate',compact('vehicle'));
    }

    public function VehicleBrandUpdatePost(Request $request,$id){
        $request->validate([
            'name' => 'required',
        ]);

        $vehicle = VehicleBrands::where('id',$id)->update([
            'name' => $request->name
        ]);
        if($vehicle){
            return 'güncelleme başarılı';
        }else{
            return 'güncelleme başarısız';
        }
    }

    public function VehicleModelDelete($id){
        $vehicle = VehicleBrands::where('id',$id)
            ->delete();
        if($vehicle){
            return 'silinme tamamlandı';
        }else{
            return 'silme işlemi başarısız';
        }
    }
}
