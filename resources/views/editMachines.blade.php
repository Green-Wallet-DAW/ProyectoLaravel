<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/plantilla.css')}}">
    <link rel="stylesheet" href="{{asset('/css/machines.css')}}">

    <title>Edit Machines</title>
</head>
<body>

@extends('plantilla')
@section('contenidoPagina')
    <div class="container ">
        <div class="row ">


<form method="get" action="{{ route('updateMachine', $machine) }}">

    <div >
        @csrf
        <label for="name">nombre:</label>
        <input type="text"  name="Nombre" value="{{ $machine->Nombre }}"/>
    </div>
    <div >
        <label for="descripcion">descripcion</label>
        <input type="text"  name="Descripcion" value="{{ $machine->Descripcion }}"/>
    </div>

    <button type="submit" >Actualizar</button>
</form>
@endsection()
</body>
</html>
