<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/css/serviceList.css">
  <title>Document</title>
</head>
<body>
  
</body>
</html>

@extends('plantilla')

@section('contenidoPagina')




  <a href="/createService" class="btn btn-success boton-Agregar" title="Add a Service">Add a new Service</a>  

  
@forelse ($servicios as $servicio)

    

<form action="" method="GET">
    <div id="caja">
      <div class="row">
        <div class="col">
          <button id="boton" type="button" data-bs-toggle="collapse" data-bs-target="#contenido{{$servicio->id}}" aria-controls="contenido{{$servicio->id}}" aria-expanded="false" aria-label="Toggle navigation">
            <svg id="flechaCaja" xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#049201" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                <path id="path1" d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
            </svg>
            <span id="tituloCaja">{{$servicio->name}}</span><span id="precioEnTokens">{{$servicio->precio}}</span> </div>
            <div class="col">
              <a href="{{ route('editServices', $servicio->id)}}" class="btn btn-warning boton-Editar" title="Edit service {{$servicio->id}}">Edit</a>  
              <a href="{{ route('deleteService', $servicio->id)}}" class="btn btn-danger" title="Delete service {{$servicio->id}}">Delete</a></div>
          </button>
        </div>
      <div class="row">
        <div id="descripcionCaja">
          {{$servicio->description}}
      </div>
      <div id="contenido{{$servicio->id}}" class="collapse form-group">
          <div>{{$servicio->link}}</div>
        
    </div>
      </div>
      

      </div>


  


</form>
@empty
<h2>No hay nada</h2>

@endforelse


@endsection()
