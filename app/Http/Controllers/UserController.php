<?php

namespace App\Http\Controllers;
use App\Models\Logs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        // Giriş yetkisi yoksa hata veriyor
        if (Auth::user()->user_type != 0){
            abort(401);
        }

        $users = User::all();
        return view('user',compact('users'));
    }

    public function UserAdd(){
        // Giriş yetkisi yoksa hata veriyor
        if (Auth::user()->user_type != 0){
            abort(401);
        }

        return view('user_add');
    }

    public function UserAddPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'user_type' => 'required',
            'password' => 'required',
        ]);

        User::create([
                'name' => $request->name,
                'email' => $request->email,
                'user_type' => $request->user_type,
                'password' => Hash::make($request->password)
                ]);

        Logs::create([
           'IslemYapan' => Auth::user()->name,
           'YapilanIslem' => $request->name." adlı kullanıcı kaydı yapıldı."
        ]);
        return redirect()->route('user');
        }



    public function UserUpdate($id){
        // Giriş yetkisi yoksa hata veriyor
        if (Auth::user()->user_type != 0){
            abort(401);
        }

        $user = User::where('id',$id)->first();
        return view('user_update',compact('user'));
    }

    public function UserUpdatePost(Request $request,$id){

        $user = User::where('id', $id)->first();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->user_type,
            'password' => Hash::make($request->password)
        ]);

        Logs::create([
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' => $request->name." adlı kullanıcı güncellendi."
        ]);

        return redirect()->route('user');
    }

    public function UserDelete($id){
        $user = User::where('id', $id)->first();
        $user->delete();
        Logs::create([
            'IslemYapan' => Auth::user()->name,
            'YapilanIslem' => $user->name." adlı kullanıcı silindi."
        ]);
        if($user){
            return back()->with('status', 'Kullanıcı kaydı başarıyla silindi');
        }else{
            return back()->with('status', 'Kullanıcı kaydı silinemedi');
        }

    }
}
