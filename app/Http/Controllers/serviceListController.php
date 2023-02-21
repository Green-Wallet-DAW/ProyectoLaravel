<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;

class serviceListController extends Controller{


// Muestra los servicios usando toda la información 

    public function showAllServices(){
        $servicios = Servicio::all();
        return $servicios;
    }


public function showUserServices(){
    $userService = Servicio::where('rol_service', 'USER')->get();
    return $userService;
}

public function showCommunityServices(){
    $communityServices = Servicio::where('rol_service', 'COMMUNITY')->get();
    return $communityServices;
}

// Muestra los servicios usando toda la información 


    public function showServices(){
        
        $servicios = Servicio::all();

        return view('serviceList', ['servicios'=> $servicios]);
    }

// Permite encontrar el servicio para su edición, usando la id para modificar uno en específico


    public function editServices(Request $request){

        $item = Servicio::findOrFail($request->id);
        return view('editServices', compact('item'));
    }

    // Permite guardar los cambios de la edición

    public function updateService(Request $request)
    {   
        
        $validation = $request->validate([
            'name' => 'required|min:1',
            'description' => 'required',
            'link' => 'required',
            'precio' => 'required|min:1|max:999',
            'rol_service'=> 'required'
        ]);
        

         $item = Servicio::findOrFail($request->id);
         $item->name = $validation['name'];
         $item->description = $validation['description'];
         $item->link = $validation['link'];
         $item->precio = $validation['precio'];
         $item->rol_service = $validation['rol_service'];
         $item->update();

        return redirect()->route('serviceList');
}

    // permite eliminar un servicio usando la id para que no se elimine todo. Se usa request para que se genere un array. Esto es importante para la api

    public function deleteService(Request $request){

        $deleteItem = Servicio::findOrFail($request->id);
        $deleteItem->delete();

        return back();

    }

// Permite añadir servicios

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

    // Muestra los servicios usando la id

    public function showServicesById(Request $request){
        $service = Servicio::findOrFail($request->id);
        return $service->precio;
    }
    
}