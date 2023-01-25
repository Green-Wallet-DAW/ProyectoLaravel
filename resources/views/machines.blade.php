<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/plantilla.css')}}">
    <link rel="stylesheet" href="{{asset('/css/machines.css')}}">

    <title>Machines</title>
</head>
<body>

@extends('plantilla')
@section('contenidoPagina')
    <div class="container row d-flex">
        <div class="col">

            <h3>Maquinas</h3>
            <table>
                @forelse ($machines as $item)
                <p>Modelo: {{$item->Nombre}}</p>
                @empty
                <li>NO HAY NADA </li>
                @endforelse
            </table>
        </div>
        <div class="col">
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            <br/>
            @endif

        </div>
        <div class="row ">
            <div class="col">

                <div class="formulario">

                </div>
                <form method="post" action="{{ route('addMachines') }}">

                    @csrf
                    <label for="Nombre">Nombre:</label>
                    <input type="text" name="Nombre" value="{{old('Nombre')}}"/>
                {!! $errors->first('name', '<small>:message</small><br>' )!!}

                    <label for="Descripcion">Descripcion:</label>
                    <input type="text" name="Descripcion" value="{{old('Descripcion')}}"/>
                {!! $errors->first('descripcion', '<small>:message</small><br>' )!!}


                    <button type="submit">Crear</button>
                </form>
            </div>
        </div>

    </div>
@endsection()
</body>
</html>
