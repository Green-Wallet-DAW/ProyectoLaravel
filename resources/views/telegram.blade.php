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
    <link rel="stylesheet" href="{{asset('/css/plantillaUser.css?v=1a040')}}">
    <link rel="stylesheet" href="{{asset('/css/users.css?v=1a040')}}">
    <link rel="stylesheet" href="{{asset('/css/pt.css?v=1a040')}}">
    <title>Telegram</title>
</head>
<body>

  @guest
    <a href="{{route('login')}}">Login</a>
  @else
    @extends('plantillaUser');
    @section('contenidoPagina')
      <div class="col-10 mt-5 mb-3">
        <div id="cUser">
          <a href="{{route('createTelegram')}}" title="New message"><button type="button" class="btn btn-success fs-5">New message</button></a>
          <input type="text" id="searchbar" class="form-control" placeholder="Search you message name here" aria-label="Searchbar" aria-describedby="basic-addon2" onkeyup="myFunction()">
        </div>
          <div class="row mt-4" id="messages">
            @forelse ($telegram as $item)
                  {{-- Diseñar nueva caja para poder hacer filas de 2 y que quepan en la pantalla --}}
                  <div class="col-6">
                    <div class="telegramBox">
                      <div class="uCon fs-1 pt-3 point" id="one" data-bs-toggle="collapse" data-bs-target="#collapseExample{{$item->id}}" aria-expanded="false" aria-controls="collapseExample{{$item->id}}" onclick="myFunction()">
                          <strong>{{$item->name}}</strong>
                      </div>
                      <div class="uCon fs-1 pt-3 point1" id="two" data-bs-toggle="collapse" data-bs-target="#collapseExample{{$item->id}}" aria-expanded="false" aria-controls="collapseExample{{$item->id}}" onclick="myFunction2()">
                        <strong>{{$item->name}}</strong>
                      </div>
                      <div class="collapse" id="collapseExample{{$item->id}}">
                        <div class="uCon">
                          <a href="{{route('send', $item->id)}}" class="btn btn-info mb-3" data-bs-toggle="tooltip" title="Send message"><i class="bi bi-envelope-fill" style="color: white"></i></a>
                          <a href="{{route('editTelegram', $item->id)}}" class="btn btn-warning mx-1 mb-3" data-bs-toggle="tooltip" title="Edit message"><i class="bi bi-pencil"></i></a>
                          <form id="ppp" action="{{route('deleteTelegram', $item->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mb-3" data-bs-toggle="tooltip" title="Delete message">
                              <i class="bi bi-trash"></i>
                            </button>
                          </form>
                        </div>
                        <div class="uCon">
                          <strong>Name: </strong>{{$item->name}}
                        </div>
                        <div class="uCon">
                            <strong>Content: </strong><br>
                            <textarea name="content" cols="36" rows="5" disabled>{{$item->content}}</textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                @empty
                    <div>TELEGRAMS DO NOT EXIST</div>
                @endforelse
          </div>
      </div>
    @endsection
  @endguest
  <script type="text/javascript" src="{{asset('/filter.js')}}"></script>
</body>
</html>
