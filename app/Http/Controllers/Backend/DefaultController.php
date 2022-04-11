<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function index(){
        return view('backend.default.index');
    }

    public function deneme() {
        $orderItem = OrderItems::find(1);
        $orderItems = Orders::find(1)->order_items;
        return $orderItems;
    }
}
