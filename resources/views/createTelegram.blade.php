<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/users.css')}}">
    <link rel="stylesheet" href="{{asset('/css/createUser.css')}}">
    <link rel="stylesheet" href="{{asset('/css/plantillaUser.css')}}">
    <title>Create a Telegram message</title>
</head>
<body>
    @guest
        <a href="{{route('login')}}">Login</a>
    @else
        @extends('plantillaUser');
        @section('contenidoPagina')
        <div class="col-8 mt-5 mb-3">
            <div class="userBox userEBox">
                <form method="post" action="{{ route('saveTelegram') }}">
                    @method('PATCH')
                    @csrf
                    <div class="cajaUE fs-1">
                        <strong >Creating a new Telegram message</strong>
                        <button type="submit" class="btn btn-success btn-block enter-btn fs-4">Create</button>
                    </div>

                    <div class="eUser">
                        <label for="name"><strong>Name: </strong></label>
                        <input type="text" name="name" value="{{old('name')}}"/>
                        {!! $errors->first('name', '<small>:message</small><br>' )!!}
                    </div>

                    <div class="eUser">
                        <label for="content"><strong>Content: </strong></label><br>
                        <textarea name="content" cols="67" rows="8" value="{{old('content')}}"></textarea>
                        {!! $errors->first('content', '<small>:message</small><br>' )!!}
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
            <a href="{{route('telegram')}}"><button type="button" class="btn btn-success fs-5">Back</button></a>
            @endsection
    @endguest
</body>
</html>
