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
                <strong>Description: </strong>{{$task->description}}
            </div>
            <div class="uCon">
                <strong>Master: </strong>{{$task->master}}
            </div>
            <div class="uCon">
                <strong>Community created at: </strong>@if (isset($task->created_at))
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
        <a href="{{route('comunidadIndex')}}"><button type="button" class="btn btn-success fs-5">Back</button></a>
    </div>
    @endsection
</body>
</html>
