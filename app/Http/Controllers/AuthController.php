<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login(Request $request)
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


    public function registro(Request $request)
    {
        $request->validate([
            'name'=>'required|max:40|min:5',
            'password'=>'required|max:255|min:10',
            'email'=>'required|max:100',
            'phone_number'=>'required'
        ]);

        $task = new Usuario();
        $task->name = $request->name;
        $task->password = password_hash($request->password,PASSWORD_DEFAULT);
        $task->email = $request->email;
        $task->cumn = $request->cumn;
        $task->phone_number = $request->phone_number;
        $task->rol = $request->role;
        if($request->has('news')){
            $task->newsletter = 1;
        }else{
            $task->newsletter = 0;
        };

        $task->save();

        return redirect()->route('login');   //te redirije al menú admin o podría ser paciente...
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
