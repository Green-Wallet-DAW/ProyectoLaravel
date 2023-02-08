
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

<form method="post" action="{{ route('comunidadActualizar', $comunidad) }}">  //No es necesario especificar el Id ya que la nueva versión laravel ya busca dentro del Objeto
          <div > 
              @method('PATCH')
              @csrf
              
              <label for="name">nombre:</label>
              <input type="text"  name="name" value="{{ $comunidad->name }}"/>
          </div>
          <div >
              <label for="token">tokens</label>
              <input type="number"  name="token" value="{{ $comunidad->token }}"/>
          </div>
          <div >
              <label for="description">description</label>
              <input type="text"  name="description" value="{{ $comunidad->description }}"/>
          </div>
          <div >
              <label for="master">master</label>
              <input type="text"  name="master" value="{{ $comunidad->master }}"/>
          </div>
         
          <button type="submit" >Actualizar</button>
      </form>
  </div>
</div>

@endsection
