<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{asset('/css/machines.css')}}">

    <link rel="stylesheet" href="{{asset('/css/users.css')}}">
    <link rel="stylesheet" href="{{asset('/css/plantillaUser.css')}}">

    <title>Machines</title>
</head>
<body>

@extends('plantillaUser')
@section('contenidoPagina')
    <div class="container ">
        <div class="row">
            <table>
                <th>Name</th>
                <th>Description</th>
                @forelse ($machines as $item)
                <tr>

                    <td>{{$item->name}}</td>
                    <td>{{$item->description}}</td>

                    <td>
                        <a href="{{ route('editMachines', $item->id)}}" class="btn btn-secondary" >Edit</a> <!--añadimos también EDITAR-->
                    </td>
                    <td>
                        <form action="{{ route('deleteMachines', $item->id)}}" method="post"> <!--añadimos también BORRAR-->
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" >Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <li>NO HAY NADA </li>
                @endforelse
            </table>
        </div>

        <div class="row  d-flex align-items-md-center">
            <div class="col">
                <form method="post" action="{{ route('addMachines') }}">
                    @method('PATCH')
                    @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name"  class="form-control"  value="{{old('name')}}"/>
                {!! $errors->first('name', '<small>:message</small><br>' )!!}
                </div>
                <div class="mb-3">
                    <label for="description">Descripcion</label>
                    <input type="text" name="description"  class="form-control"  value="{{old('description')}}"/>
                {!! $errors->first('descripcion', '<small>:message</small><br>' )!!}
                </div>

                    <button type="submit" style="btn btn-primary">Add machine</button>
                </form>
            </div>
        </div>
    </div>
@endsection()
</body>
</html>
