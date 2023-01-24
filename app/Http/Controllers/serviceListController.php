<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicio;

class serviceListController extends Controller{
    public function showServices(Request $request){
        
        $servicios = Servicio::all();

        return view('serviceList', ['servicios'=> $servicios]);
    }
}
