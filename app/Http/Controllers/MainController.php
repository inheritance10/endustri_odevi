<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        return view('backend.default.index');
    }

    public function Logs(){
        $logs = Logs::all();
        return view('logs', compact('logs'));
    }
}
