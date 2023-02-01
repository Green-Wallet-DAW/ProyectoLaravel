
@extends('plantilla')


@section('contenidoPagina')

@if ($errors->any())  //esto muestra todos los errores seguidos
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
<br/>
@endif

<form method="post" action="{{ route('comunidadAlmacenar') }}"> 
 
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" name="name" value="{{old('name')}}"/>  <!--ponemos old porque en el caso que carguemos el formulario y diera error habría que volver a introducir todos los campos, así recuerda o guarda los campos que están bien-->
     {!! $errors->first('name', '<small>:message</small><br>' )!!}  <!-- así especificamos los errores debajo-->
  

     <label for="token">Token:</label>
        <input type="number" name="token" value="{{old('token')}}"/>  <!--ponemos old porque en el caso que carguemos el formulario y diera error habría que volver a introducir todos los campos, así recuerda o guarda los campos que están bien-->
     {!! $errors->first('token', '<small>:message</small><br>' )!!}  <!-- así especificamos los errores debajo-->
  
        <label for="descripcion">Descripcion:</label>
        <input type="text" name="description" value="{{old('description')}}"/>
     {!! $errors->first('description', '<small>:message</small><br>' )!!}  

        <label for="master">Master:</label>
        <input type="number" name="master" value="{{old('master')}}"/>
     {!! $errors->first('master', '<small>:message</small><br>' )!!}  

    <button type="submit">Crear</button>
</form>

@endsection