<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/users.css')}}">
    <link rel="stylesheet" href="{{asset('/css/editUser.css')}}">

    <title>User List</title>
</head>
    {{-- <h1>USUARIOS</h1> --}}
  @extends('plantillaUser');
  @section('contenidoPagina')
  <div class="col-8 mt-5 mb-3">
    <div class="userBox userEBox">
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form class="row" method="post" action="{{route('updateUser', $task)}}">
            @method('PATCH')
            @csrf
            <div class="cajaUE fs-1">
                <strong>Edit form for {{$task->name}}</strong>
                <button type="submit" class="btn btn-success btn-block enter-btn fs-4">Update</button>
            </div>
            <div class="eUser"> 
                
                <label for="name"><strong>Name: </strong></label>
                <input type="text"  name="name" value="{{ $task->name }}"/>
            </div>
            <div class="eUser">
                <label for="email"><strong>Email: </strong></label>
                <input type="email"  name="email" value="{{ $task->email }}"/>
            </div>
            <div class="eUser">
                <label for="cumn"><strong>Credit Union Member Number: </strong></label>
                <input type="text"  name="cumn" value="{{ $task->cumn }}"/>
            </div>
            <div class="eUser">
                <label for="phone_number"><strong>Phone number: </strong></label>
                <input type="text"  name="phone_number" value="{{ $task->phone_number }}"/>
            </div>
            <div class="eUser">
                <label for="role"><strong>Role: </strong></label>
                <select name="role" id="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="eUser">
                <input class="checkUser" type="checkbox" name="newsletter" id="newsletter">
                <label for="newsletter"><strong>I want to receive news and updates about Green Wallet.</strong></label>
            </div>
        </form>
    </div>
    <a href="{{route('usuarios')}}"><button type="button" class="btn btn-success fs-5">Back</button></a>
  @endsection
    
</body>
</html>
