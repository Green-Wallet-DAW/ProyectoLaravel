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

<form method="POST" action="{{ route('addService') }}">
        <div class="form-group"> 

            @method('PATCH')
              @csrf
              
              <label for="name">Name:</label>
              <input class="form-control" type="text"  name="name" value=""/>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <input  class="form-control" type="text"  name="description" value=""/>
        </div>
        <div class="form-group">
            <label for="link">Link</label>
            <input class="form-control" type="text"  name="link" value=""/>
        </div>
        <div class="form-group">
            <label for="precio">Price</label>
            <input class="form-control" type="text"  name="precio" value=""/>
        </div>
          <button class="btn btn-success" type="submit" >Create</button>
      </form>
  </div>
</div>

@endsection
