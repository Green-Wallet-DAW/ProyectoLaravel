<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\Controller;
use Validator;

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
        if($request->has('newsletter')){
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
        var_dump($request);
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

    ////////////////////////////////////////////////////////////
    //// FUNCIONES API

    public $successStatus = 200;
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function loginU()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['id'] =  $user->id;
            $success['name'] =  $user->name;
            $success['email'] =  $user->email;
            $success['password'] =  $user->password;
            $success['phone_number'] =  $user->phone_number;
            $success['cumn'] =  $user->cumn;
            $success['rol'] =  $user->rol;
            $success['newsletter'] = $user->newsletter;

            // dd($success);
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function registerU(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:40|min:5|unique:usuarios,name',
            'password'=>'required|max:255|min:10',
            'email'=>'required|max:100|unique:usuarios,email',
            'phone_number'=>'required|unique:usuarios,phone_number',
            // 'terms'=>'accepted'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = password_hash($request->password,PASSWORD_DEFAULT);
        $user = Usuario::create($input);

        // dd($input);

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['id'] =  $user->id;
        $success['name'] =  $user->name;
        $success['email'] =  $user->email;
        $success['password'] =  $user->password;
        $success['phone_number'] =  $user->phone_number;
        $success['cumn'] =  $user->cumn;
        $success['rol'] =  "user";

        if ($user->newsletter == true) {
            $success['newsletter'] = 1;
        } else {
            $success['newsletter'] = 0;
        }
        
        // $success['newsletter'] = $user->newsletter;

        return response()->json(['success' => $success], $this->successStatus);
    }
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function detailsU()
    {
        $user = Auth::user();
        return $user;
    }



    public function logoutU(Request $request)
    {
        
        $isUser = $request->user()->token()->revoke();
        if($isUser){
            $success['message'] = "Successfully logged out.";
            return response()->json(['success' => $isUser], $this->successStatus);
        }
        else{
            return response()->json(['error' => 'Unauthorised'], 401);
        }
            
        
    }

    public function updateU(Request $request)
    {
        $request->validate([
            'name'=>'required|max:40|min:5',
            'email'=>'required|max:100',
            'phone_number'=>'required',
        ]);
        
        $data = Auth::user();
        $success = Usuario::findOrFail($request->id);
        
        $success['name'] =  $request->name;
        $success['email'] =  $request->email;
        $success['password'] =  $success->password;
        $success['phone_number'] =  $request->phone_number;
        $success['cumn'] =  $request->cumn;
        $success['rol'] = "user";
        
        if ($request->newsletter == true) {
            $success['newsletter'] = 1;
        } else {
            $success['newsletter'] = 0;
        }
        $success->update();
       
        return response()->json(['success' => $success], $this->successStatus);
        //Esta función actualizará la tarea que hayamos seleccionado
       
    }
}
