
@extends('plantilla')


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

@endsection