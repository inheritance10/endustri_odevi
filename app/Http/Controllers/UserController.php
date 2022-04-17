<?php

namespace App\Http\Controllers;
use App\Models\Logs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('users',compact('users'));
    }

    public function UserAdd(){
        return view('useradd');
    }

    public function UserAddPost(Request $request){
        $user = User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'usertype' => $request->usertype,
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
                ]);
        return response()->json('basarili');
        }



    public function UserUpdate($id){
        $user = User::where('id',$id)->first();
        return view('userupdate',compact('user'));
    }

    public function UserUpdatePost(Request $request,$id){

        $user = User::where('id',$id)->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'usertype' => $request->usertype,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password

        ]);
        return response()->json('basarili');
    }

    public function UserDelete($id){
        $user = User::where('id',$id)->delete();
        if($user){
            return 'kayıt silindi';
        }else{
            return 'kayıt silinemedi';
        }

    }
}
