<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;

class serviceListController extends Controller{
    public function showServices(){
        
        $servicios = Servicio::all();

        return view('serviceList', ['servicios'=> $servicios]);
    }

    public function editServices($id){

        $item = Servicio::findOrFail($id);
        return view('editServices', compact('item'));
    }

    public function updateService(Request $request, $id)
    {   
        
        $validation = $request->validate([
            'name' => 'required|min:1',
            'description' => 'required',
            'link' => 'required',
            'precio' => 'required|min:1|max:999',
            
        ]);
        

         $item = Servicio::findOrFail($id);
         $item->name = $validation['name'];
         $item->description = $validation['description'];
         $item->link = $validation['link'];
         $item->precio = $validation['precio'];
         $item->update();

        return redirect()->route('serviceList');
}
    public function deleteService($id){

        $deleteItem = Servicio::findOrFail($id);
        $deleteItem->delete();

        return back();

    }


    public function addService(Request $request){

        $validation = $request->validate([
            'name' => 'required|min:1',
            'description' => 'required',
            'link' => 'required',
            'precio' => 'required|min:1|max:999',
        ]);
        $newItem = new Servicio();
        $newItem->name = $validation['name'];
        $newItem->description = $validation['description'];
        $newItem->link = $validation['link'];
        $newItem->precio = $validation['precio'];

        $newItem->save();
        // $validation->save();

        return redirect()->route('serviceList');
    }
}
