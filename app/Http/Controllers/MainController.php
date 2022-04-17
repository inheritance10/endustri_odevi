<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){//Admin panelinin ana sayfasına yönlendirilmesi sağlandı
        return view('backend.product.product_list');
    }

    public function Logs(){//logs tablosundan veriler çekildi.Sayfaya gönderildi
        $logs = Logs::all();
        return view('logs', compact('logs'));
    }
}
