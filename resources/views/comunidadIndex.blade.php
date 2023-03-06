<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/users.css')}}">
    <link rel="stylesheet" href="{{asset('/css/plantillaUser.css')}}">
    <title>Community List</title>
</head>
<body>
    @guest
        <a href="{{route('login')}}">Login</a>
    @else
        @extends('plantillaUser');
        @section('contenidoPagina')
            <div class="col-8 mt-5 mb-3">
                <div id="cUser">
                    <a href="#"><button type="button" class="btn btn-success fs-5">Create Community</button></a>
                </div>
                <br>
                <table class="table table-hover" id="tabla" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Community Name</th>
                            <th scope="col" class="text-center">Master</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="myTableU">
                    @forelse ($comunidades as $item)
                        <tr>
                            <td class="align-middle text-center">{{$item->name}}</td>
                            <td class="align-middle text-center">{{$item->master}}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{route('showCom', $item->id)}}" class="btn btn-info" data-bs-toggle="tooltip" title="{{$item->name}} community details"><i class="bi bi-eye"></i></a>
                                <a href="{{route('comunidadEditar', $item->id)}}" class="btn btn-warning mx-1" data-bs-toggle="tooltip" title="Edit {{$item->name}} community data"><i class="bi bi-pencil"></i></a>
                                <form id="ppp" action="{{route('comunidadBorrar', $item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" title="Delete {{$item->name}} community">
                                    <i class="bi bi-trash"></i>
                                </button>
                                </form>
    
                            </td>
                        </tr>
                    @empty
                        <tr>COMMUNITY DO NOT EXIST</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
        @endsection
    @endguest
    <script>
        $(document).ready(function(){
            alert = function() {};
            $('#tabla').DataTable();
        });
    </script>

</body>
{{-- @extends('plantillaUser')


@section('contenidoPagina')
<table class="default">

    <tr>
        <th>Name</th>
        <th>Token</th>
        <th>Description</th>
        <th>master</th>
    </tr>


    @forelse ($comunidades as $item)

    <tr>
        <td>{{$item->name}}</td>
        <td>{{$item->token}}</td>
        <td>{{$item->description}}</td>
        <td>{{$item->master}}</td>
        <td><a href="{{ route('comunidadEditar', $item->id)}}">Edit</a> <!--añadimos también EDITAR--></td>
        <td>
            <form action="{{ route('comunidadBorrar', $item->id)}}" method="post"> <!--añadimos también BORRAR-->
                @csrf
                @method('DELETE')
                <button type="submit">borrar</button>
            </form>
        </td>
    </tr>




    @empty
    <li>NO HAY NADA </li>
    @endforelse
</table>

@endsection --}}
