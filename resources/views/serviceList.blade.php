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
<div class="col">
  <div id="caja">
    <button id="boton" type="button" data-bs-toggle="collapse" data-bs-target="#contenido" aria-controls="contenido" aria-expanded="false" aria-label="Toggle navigation">
        <svg id="flechaCaja" xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#049201" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
            <path id="path1" d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
        </svg>
        <span id="tituloCaja">TÍTULO CAJA</span>
    </button>
    <div id="descripcionCaja">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit fugiat, amet omnis necessitatibus eaque, quis sequi iusto maiores delectus ducimus debitis praesentium exercitationem accusantium totam expedita placeat rerum nisi laudantium!
    </div>
    <div id="contenido" class="collapse">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum possimus reiciendis animi velit maxime ea asperiores sequi consequuntur voluptatem tenetur quae, inventore debitis consectetur. In laudantium adipisci dolorem illum fugit.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae nulla placeat, accusantium aperiam minus dicta expedita maiores rerum quaerat quos asperiores fugiat voluptatibus culpa, at quis. Cupiditate optio neque similique.
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quas accusantium, quam totam ea fugiat vero inventore beatae dolorum voluptatibus praesentium perferendis atque maxime. Soluta, neque! Vitae laboriosam esse eligendi enim.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, dolor repellat quo hic dolorum, eligendi impedit vel, illo dignissimos fugit exercitationem doloribus mollitia ipsam qui. Dignissimos culpa incidunt voluptatem aspernatur?

    </div>
  </div>
</div>
@endsection()
