<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{

    public function registro(Request $request)
    {
        $request->validate([
            'name'=>'required|max:40|min:5|unique:usuarios,name',
            'password'=>'required|confirmed|max:255|min:10',
            'email'=>'required|max:100|unique:usuarios,email',
            'phone_number'=>'required|unique:usuarios,phone_number',
            'terms'=>'accepted'
        ]);

        $task = new Usuario();
        $task->name = $request->name;
        $task->password = password_hash($request->password,PASSWORD_DEFAULT);
        $task->email = $request->email;
        $task->cumn = $request->cumn;
        $task->phone_number = $request->phone_number;
        $task->rol = "admin";
        if($request->has('news')){
            $task->newsletter = 1;
        }else{
            $task->newsletter = 0;
        };

        $task->save();

        return redirect()->route('login');   //te redirije al menú admin o podría ser paciente...
    }


    public function login_usuario(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);  //no cogemos el token

         if (auth()->attempt($credentials)) {  //comprobación de autenticación 
            
            return redirect()->route('usuarios');

        } else {
            session()->flash('message', 'Invalid credentials');
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login'); 
    }

    public function admin(){
        return view('usuarios');
    }
}
