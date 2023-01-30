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



<div class="caja" id="caja">
<form method="POST" action="{{ route('addService') }}">
        <div class="form-group formularioCaja"> 

            @method('PATCH')
              @csrf
              
              <label for="name">Name:</label>
              <input class="form-control" type="text"  name="name" value=""/>
          </div>
          <div class="form-group formularioCaja">
            <label for="description">Description</label>
            <input  class="form-control" type="text"  name="description" value=""/>
        </div>
        <div class="form-group formularioCaja">
            <label for="link">Link</label>
            <input class="form-control" type="text"  name="link" value=""/>
        </div>
        <div class="form-group formularioCaja">
            <label for="precio">Price</label>
            <input class="form-control" type="number"  name="precio" value=""/>
        </div>
        <div class="form-group formularioCaja">
            <label for="rol_service">Service</label>
            <select class="form-control" type="number"  name="rol_service" value="">
            <option value="COMMUNITY">COMMUNITY</option>
            <option value="USER">USER</option>
            </select>
        </div>
          <button class="btn btn-success botonFormulario" type="submit" >Create</button>
      </form>

  </div>


@endsection
