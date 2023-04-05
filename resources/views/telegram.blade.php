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
    <link rel="stylesheet" href="{{asset('/css/plantillaUser.css')}}">
    <link rel="stylesheet" href="{{asset('/css/users.css')}}">
    <link rel="stylesheet" href="{{asset('/css/pt.css')}}">
    <title>Telegram</title>
</head>
<body>

  @guest
    <a href="{{route('login')}}">Login</a>
  @else
    @extends('plantillaUser');
    @section('contenidoPagina')
      <div class="col-8 mt-5 mb-3">
        <div id="cUser">
          <a href="{{route('createTelegram')}}"><button type="button" class="btn btn-success fs-5">New message</button></a>
        </div>
          <div class="row">
            @forelse ($telegram as $item)
                  {{-- Diseñar nueva caja para poder hacer filas de 2 y que quepan en la pantalla --}}
                  {{-- <div class="col-6"> --}}
                    <div class="userBox">
                      <div class="uCon fs-1 pt-4">
                          <strong>{{$item->name}}</strong>
                      </div>
                      <div class="uCon">
                          <strong>Name: </strong>{{$item->name}}
                      </div>
                      <div class="uCon">
                          <strong>Content: </strong><br>
                          <textarea name="content" id="" cols="65" rows="5" disabled>{{$item->content}}</textarea>
                      </div>
                      <div class="uCon">
                        <a href="{{route('send', $item->id)}}" class="btn btn-primary" data-bs-toggle="tooltip" title="Send message">Send message</a>
                      </div>
                    </div>
                  {{-- </div> --}}
                @empty
                    <div>TELEGRAMS DO NOT EXIST</div>
                @endforelse
          </div>
      </div>
    @endsection
  @endguest
</body>
</html>
