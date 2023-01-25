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

<form method="get" action="{{ route('updateService', $item) }}">
        <div class="form-group"> 

              @csrf
              
              <label for="name">Name:</label>
              <input class="form-control" type="text"  name="name" value="{{ $item->name }}"/>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <input  class="form-control" type="text"  name="description" value="{{ $item->description }}"/>
        </div>
        <div class="form-group">
            <label for="link">Link</label>
            <input class="form-control" type="text"  name="link" value="{{ $item->link }}"/>
        </div>
        <div class="form-group">
            <label for="precio">Price</label>
            <input class="form-control" type="text"  name="precio" value="{{ $item->precio }}"/>
        </div>
          <button class="btn btn-success" type="submit" >Update</button>
      </form>
  </div>
</div>

@endsection
