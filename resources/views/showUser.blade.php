<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/users.css')}}">
    <link rel="stylesheet" href="{{asset('/css/consultaUser.css')}}">
    <link rel="stylesheet" href="{{asset('/css/plantillaUser.css')}}">
    <title>User Details</title>
</head>
<body>
    {{-- <h1>USUARIOS</h1> --}}
    @extends('plantillaUser');
    @section('contenidoPagina')
    <div class="col-8 mt-5 mb-3">
        <div class="userBox">
            <div class="uCon fs-1 pt-4">
                <strong>Details of {{$task->name}}</strong>
            </div>
            <div class="uCon">
                <strong>Name: </strong>{{$task->name}}
            </div>
            <div class="uCon">
                <strong>Tokens: </strong>{{$task->token}}
            </div>
            <div class="uCon">
                <strong>Subscribed to newsletter: </strong>@if ($task->newsletter == 1)
                    YES
                @else
                    NO
                @endif
            </div>
            <div class="uCon">
                <strong>Email: </strong>{{$task->email}}
            </div>
            <div class="uCon">
                <strong>C.U.M.N: </strong>@if (isset($task->cumn))
                {{$task->cumn}}
                @else
                    No number registered
                @endif
            </div>
            <div class="uCon">
                <strong>Phone number: </strong>{{$task->phone_number}}
            </div>
            {{-- <div class="uCon">
                <strong>Number of communities: </strong>@if (isset($task->number_comunity))
                {{$task->number_comunity}}
                @else
                    No number registered
                @endif
            </div> --}}
            <div class="uCon">
                <!-- <strong>Subscribed to newsletter: </strong>@if ($task->newsletter == 1)
                    YES
                @else
                    NO
                @endif
            </div>
            <div class="uCon"> -->
                <strong>Account role: </strong>{{$task->rol}}
            </div>
            <div class="uCon">
                <strong>User created at: </strong>@if (isset($task->created_at))
                {{$task->created_at}}
                @else
                    No data available
                @endif
            </div>
            <div class="uCon">
                <strong>Last update: </strong>@if (isset($task->updated_at))
                {{$task->updated_at}}
                @else
                    No data available
                @endif
            </div>
        </div>
        <a href="{{route('usuarios')}}"><button type="button" class="btn btn-success fs-5">Back</button></a>
    </div>
    @endsection
</body>
</html>
