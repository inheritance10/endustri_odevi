<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function index(){//kullanıcıların listelenmesi
        $users = User::all();
        return view('users',compact('users'));
    }

    public function UserAddValidate(Request $request){//Formdaki zorunlu alanların kontrolü
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'usertype'=>'required',
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
    }

    public function UserAdd(){//kullanıcı ekleme formuna gidiş
        return view('useradd');
    }

    public function UserAddPost(Request $request){//kullanıcı ekleme
        $this->UserAddValidate($request);
        $user = User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'usertype' => $request->usertype,
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
                ]);
            if($user->create()){
                return 'kayıt başarılı';
            }else{
                return 'kayıt başarısız';
            }
        }


    //güncelleme işlemi için sayfa yönlendirilmesi ve id nin çekilmesi
    // çekilen id ye ait kullanıcının verilerinin güncelleme formuna aktarımı
    public function UserUpdate($id){
        $user = User::where('id',$id)->first();
        return view('userupdate',compact('user'));
    }

    public function UserUpdatePost(Request $request,$id){//çekilen id verisine ait kullanıcı güncelleme işlemi yapıldı
        $this->UserAddValidate($request);

        $user = User::where('id',$id)->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'usertype' => $request->usertype,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password

            /*'firstname' => 'ALİ',
            'lastname' => 'cebeci',
            'usertype' => 1,
            'name' => 'ali',
            'email' => 'agfg@gmail.com',
            'password' => 'abc123'*/
        ]);
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
