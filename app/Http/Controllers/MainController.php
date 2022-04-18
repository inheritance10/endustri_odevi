<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(){//Admin panelinin ana sayfasına yönlendirilmesi sağlandı
        return view('backend.product.product_list');
    }

    public function Logs(){//logs tablosundan veriler çekildi.Sayfaya gönderildi
        // Giriş yetkisi yoksa hata veriyor
        if (Auth::user()->user_type != 0){
            abort(401);
        }

        $logs = Logs::all();
        return view('logs', compact('logs'));
    }
}
