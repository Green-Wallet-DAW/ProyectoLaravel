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




@forelse ($servicios as $servicio)

    
    <div class="col">
      <div id="caja">
        <button id="boton" type="button" data-bs-toggle="collapse" data-bs-target="#contenido" aria-controls="contenido" aria-expanded="false" aria-label="Toggle navigation">
            <svg id="flechaCaja" xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#049201" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                <path id="path1" d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
            </svg>
            <span id="tituloCaja">{{$servicio->name}}</span><span id="precioEnTokens">{{$servicio->tokens}}</span>
        </button>
        <div id="descripcionCaja">
            {{$servicio->description}}
        </div>
        <div id="contenido" class="collapse">
            {{$servicio->link}}
          </div>
      </div>
    </div>


@empty
<h2>No hay nada</h2>

@endforelse


@endsection()
