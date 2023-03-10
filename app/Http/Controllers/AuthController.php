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
use DB;

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
            $success['tokens'] = $user->token;

            // dd($success);
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            // return response()->json(['error' => 'Unauthorised'], 401);
            return response()->json(['error' => ''], 401);
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
            'cumn'=>'nullable',
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

    public function forgotPass(Request $request)
    {
        // dd($request->email);

        $user = Usuario::whereEmail($request->email)->get();
        // return $user[0]->password;
        // dd($user2);
        // dd($user2->name);
        if(isset($user[0])){
            $user2 = Usuario::findOrFail(intval($user[0]->id));
            // dd($user2->name);
            $newpass = '';
            $newpass = $this->generateRandomString();
            $user2->password = password_hash($newpass,PASSWORD_DEFAULT);
            $user2->update();
            // dd($newpass);
            // return $newpass;
            return response()->json($newpass, 200);
        }else{
            return response()->json("The email typed doesn't not exist in our database.", 404);
        }
    }

    public function updatePass(Request $request)
    {
        $success = Usuario::findOrFail($request->id);

        $success['name'] =  $success->name;
        $success['email'] =  $success->email;
        $success['password'] = password_hash($request->password,PASSWORD_DEFAULT);
        $success['phone_number'] =  $success->phone_number;
        $success['cumn'] =  $success->cumn;
        $success['rol'] = "user";
        
        if ($success->newsletter == 1) {
            $success['newsletter'] = 1;
        } else {
            $success['newsletter'] = 0;
        }
        $success->update();

        return response()->json(['success' => $success], $this->successStatus);
    }

    function generateRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 14; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
