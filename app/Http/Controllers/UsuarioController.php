<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use DataTables;

class UsuarioController extends Controller
{

    // public function indexUsers()
    // {
    //     return view('usuarios');
    // }

    public function indexUsers()
    {
        $usuarios = Usuario::all();
        return view('usuarios',['usuarios'=>$usuarios]);
        //Esta función nos devolvera todas las tareas que tenemos en nuestra BD
    }

    // public function getUsers(Request $request)
    // {

    //     if ($request->ajax()) {
    //         $data = Usuario::latest()->get();
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){
    //                 $actionBtn = "<a href='' class='btn btn-info' data-bs-toggle='tooltip' title='User  details'><i class='bi bi-eye'></i></a> 
    //                 <a href='' class='btn btn-warning mx-1' data-bs-toggle='tooltip' title='Edit user '><i class='bi bi-pencil'></i></a>
    //                 <form id='ppp' action='' method='post'>
    //                     @csrf
    //                     @method('DELETE')
    //                     <button type='submit' class='btn btn-danger' data-bs-toggle='tooltip' title='Delete user'>
    //                         <i class='bi bi-trash'></i>
    //                     </button>
    //                 </form>";
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }

    // }

    public function addUser(Request $request)
    {

        $request->validate([
            'name'=>'required|max:40|min:5|unique:usuarios,name',
            'password'=>'required|max:255|min:10',
            'email'=>'required|max:100|unique:usuarios,email',
            'phone_number'=>'required|unique:usuarios,phone_number'
        ]);

        $task = new Usuario();
        $task->name = $request->name;
        $task->password = password_hash($request->password,PASSWORD_DEFAULT);
        $task->email = $request->email;
        $task->cumn = $request->cumn;
        $task->phone_number = $request->phone_number;
        $task->rol = $request->role;
        if($request->has('newsletter')){
            $task->newsletter = 1;
        }else{
            $task->newsletter = 0;
        };

        $task->save();
        return redirect()->route('usuarios');
    }
    public function showUser(Request $request)
    {
        $task = Usuario::findOrFail($request->id);
        return view('showUser',['task'=>$task]);
        //Esta función devolverá los datos de una tarea que hayamos seleccionado para cargar el formulario con sus datos
    }

    public function editUser($id)
    {
        $task = $task = Usuario::findOrFail($id);
        return view('editUser',['task'=>$task]);
    }

    public function updateUser(Request $request)
    {

        $request->validate([
            'name'=>'required|max:40|min:5',
            'email'=>'required|max:100',
            'phone_number'=>'required'
        ]);

        $task = Usuario::findOrFail($request->id);

        $task->name = $request->name;
        $task->email = $request->email;
        $task->cumn = $request->cumn;
        $task->phone_number = $request->phone_number;
        $task->rol = $request->role;
        if($request->has('newsletter')){
            $task->newsletter = 1;
        }else{
            $task->newsletter = 0;
        };
        $task->update();
       
        return redirect()->route('usuarios');
        //Esta función actualizará la tarea que hayamos seleccionado
       
    }

     public function deleteUser(Request $request)
    {
        $task = Usuario::findOrFail($request->id);
        $task->delete(); 

        return redirect()->route('usuarios');
    }

    ///////// FUNCIONES API

    public function show(Request $request)
    {
        $task = Usuario::findOrFail($request->id);
        return $task;
        //Esta función devolverá los datos de una tarea que hayamos seleccionado para cargar el formulario con sus datos
    }

    public function update(Request $request)
    {

        $request->validate([
            'name'=>'required|max:40|min:5',
            'password'=>'required|max:255|min:10',
            'email'=>'required|max:100',
            'phone_number'=>'required'
        ]);
        $task = Usuario::findOrFail($request->id);

        $task->name = $request->name;
        $task->password = password_hash($request->password,PASSWORD_DEFAULT);
        $task->email = $request->email;
        $task->cumn = $request->cumn;
        $task->phone_number = $request->phone_number;
        // $task->rol = $request->role;
        // if($request->has('newsletter')){
        //     $task->newsletter = 1;
        // }else{
        //     $task->newsletter = 0;
        // };

        $task->save();
       
        return $task;
        //Esta función actualizará la tarea que hayamos seleccionado
       
    }

    public function destroy(Request $request)
    {
        $task = Usuario::destroy($request->id);  //task tienen el id que se ha borrado

        return response()->json([
            "message" => "Tarea con id =" . $task . " ha sido borrado con éxito"
        ], 201);
        //Esta función obtendra el id de la tarea que hayamos seleccionado y la borrará de nuestra BD
    }



}
