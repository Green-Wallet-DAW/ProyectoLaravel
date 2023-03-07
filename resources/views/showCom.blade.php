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
    @guest
        <a href="{{route('login')}}">Login</a>
    @else
        @extends('plantillaUser');
        @section('contenidoPagina')
        <div class="col-8 mt-5 mb-3">
            <div class="userBox">
                <div class="uCon fs-1 pt-4">
                    <strong>Details of {{$array['com']->name}}</strong>
                </div>
                <div class="uCon">
                    <strong>Name: </strong>{{$array['com']->name}}
                </div>
                <div class="uCon">
                    <strong>Tokens: </strong>{{$array['com']->token}}
                </div>
                <div class="uCon">
                    <strong>Description: </strong>{{$array['com']->description}}
                </div>
                <div class="uCon">
                    <strong>Master: </strong>{{$array['com']->master}}
                </div>
                <div class="uCon">
                    <strong>Users: </strong>
                    @if(isset($array['user']))
                        @foreach ($array['user'] as $user)
                            <ul style="margin-bottom: 0px">{{ $user }}</ul>
                        @endforeach
                    @else
                        <ul style="margin-bottom: 0px">There are no users in this community</ul>
                    @endif
                    
                </div>
                <div class="uCon">
                    <strong>Community created at: </strong>@if (isset($array['com']->created_at))
                    {{$array['com']->created_at}}
                    @else
                        No data available
                    @endif
                </div>
                <div class="uCon">
                    <strong>Last update: </strong>@if (isset($array['com']->updated_at))
                    {{$array['com']->updated_at}}
                    @else
                        No data available
                    @endif
                </div>
            </div>
            <a href="{{route('comunidadIndex')}}"><button type="button" class="btn btn-success fs-5">Back</button></a>
        </div>
        @endsection
    @endguest
</body>
</html>
