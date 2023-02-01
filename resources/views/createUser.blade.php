<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/users.css')}}">
    <link rel="stylesheet" href="{{asset('/css/createUser.css')}}">

    <title>User List</title>
</head>
    {{-- <h1>USUARIOS</h1> --}}
  @extends('plantillaUser');
  @section('contenidoPagina')
  <div class="col-8 mt-5 mb-3">
    <div class="userBox userEBox">
        <form method="post" action="{{ route('addUser') }}">
            @method('PATCH')
            @csrf
            <div class="cajaUE fs-1">
                <strong >Creating a user</strong>
                <button type="submit" class="btn btn-success btn-block enter-btn fs-4">Create</button>
            </div>
            
            <div class="eUser">
                <label for="name"><strong>Name: </strong></label>
                <input type="text" name="name" value="{{old('name')}}"/> 
                {!! $errors->first('name', '<small>:message</small><br>' )!!} 
            </div>

            <div class="eUser">
                <label for="password"><strong>Password: </strong></label>
                <input type="text" name="password" value="{{old('password')}}"/>
                {!! $errors->first('password', '<small>:message</small><br>' )!!}  
            </div>
            
            <div class="eUser">
                <label for="email"><strong>Email: </strong></label>
                <input type="email" name="email" value="{{old('email')}}"/>
                {!! $errors->first('email', '<small>:message</small><br>' )!!}  
            </div>
            
            <div class="eUser">
                <label for="cumn"><strong>C.U.M.N: </strong></label>
                <input type="text" name="cumn" value="{{old('cumn')}}"/>
                {!! $errors->first('cumn', '<small>:message</small><br>' )!!} 
            </div>
            
            <div class="eUser">
                <label for="phone_number"><strong>Phone number: </strong></label>
                <input type="text" name="phone_number" value="{{old('phone_number')}}"/>
                {!! $errors->first('phone_number', '<small>:message</small><br>' )!!} 
            </div>
            
            <div class="eUser">
                <label for="role"><strong>Role: </strong></label>
                <select name="role" id="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            
            <div class="eUser">
                <input class="checkUser" type="checkbox" name="news" id="news">
                <label for="news"><strong>I want to receive news and updates about Green Wallet.</strong></label>
            </div>
            
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <br/>
            @endif

        </form>
    </div>
    <a href="{{route('usuarios')}}"><button type="button" class="btn btn-success fs-5">Back</button></a>
    @endsection
</body>
</html>
