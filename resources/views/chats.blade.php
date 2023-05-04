<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/css/plantillaUser.css?v=1a040')}}">
    <link rel="stylesheet" href="{{asset('/css/users.css?v=1a040')}}">
    <link rel="stylesheet" href="{{asset('/css/pt.css?v=1a0403')}}">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Telegram</title>
</head>
<body>

  @guest
    <a href="{{route('login')}}">Login</a>
  @else
    @extends('plantillaUser');
    @section('contenidoPagina')
      <div class="col-10 mt-5 mb-3">
        @forelse ($chats as $item)
        <div class="card">
          <div class="card-header" data-bs-toggle="collapse" data-bs-target="#collapseExample{{$item[0]->record}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$item[0]->record}}">
            <span class="titulo"><b>{{$item[0]->record}} chat</b></span>
          </div>
          <div class="collapse" id="collapseExample{{$item[0]->record}}">
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link active"
                  id="general-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#general"
                  type="button"
                  role="tab"
                  aria-controls="general"
                  aria-selected="true"
                  >General</button
                >
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link"
                  id="soporte-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#soporte"
                  type="button"
                  role="tab"
                  aria-controls="soporte"
                  aria-selected="false"
                  >Techninal support</button
                >
              </li>
            </ul>
            <div class="card-body">

            
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                  <div class="scrolls">
                    @forelse ($item as $chat)
                      @if ($chat->receiver == 1 && $chat->tipo == 'general')
                        <div class="row mes">
                          <div class="col left">Sent at {{$chat->updated_at}}<hr>
                            <p class="mensaje">{{$chat->message}}</p>
                          </div>
                          <div class="col-5"></div>
                        </div>
                      @elseif($chat->tipo == 'general')
                        <div class="row mes">
                          <div class="col-5"></div>
                          <div class="col right">Sent at {{$chat->updated_at}}<hr>
                            <p class="mensaje">{{$chat->message}}</p>
                          </div>
                        </div>
                      @endif
                    @empty
                    @endforelse
                  </div>
                  <form method="post" action="{{ route('sendMessage') }}">
                    @method('PATCH')
                    @csrf
                    <div class="card-header chat">
                      <input type="number" name="receiver" value="{{$item[0]->sender}}" hidden>
                      <input type="text" name="tipo" value="general" hidden>
                      <input type="text" name="message" id="message" class="form-control chat2" placeholder="Help {{$item[0]->record}} by writing something here!">
                      <button type="submit" class="btn btn-success" style="border-radius: 20px;"><i class="bi bi-envelope-fill"></i></button>
                    </div>
                  </form>
                </div>

                <div class="tab-pane fade" id="soporte" role="tabpanel" aria-labelledby="soporte-tab">
                  <div class="scrolls">
                    @forelse ($item as $chat)
                      @if ($chat->receiver == 1 && $chat->tipo == 'soporte')
                        <div class="row mes">
                          <div class="col left">Sent at {{$chat->updated_at}}<hr>
                            <p class="mensaje">{{$chat->message}}</p>
                          </div>
                          <div class="col-5"></div>
                        </div>
                      @elseif($chat->tipo == 'soporte')
                        <div class="row mes">
                          <div class="col-5"></div>
                          <div class="col right">Sent at {{$chat->updated_at}}<hr>
                            <p class="mensaje">{{$chat->message}}</p>
                          </div>
                        </div>
                      @endif
                    @empty
                    @endforelse
                  </div>
                  <form method="post" action="{{ route('sendMessage') }}">
                    @method('PATCH')
                    @csrf
                    <div class="card-header chat">
                      <input type="number" name="receiver" value="{{$item[0]->sender}}" hidden>
                      <input type="text" name="tipo" value="soporte" hidden>
                      <input type="text" name="message" id="message" class="form-control chat2" placeholder="Help {{$item[0]->record}} by writing something here!">
                      <button type="submit" class="btn btn-success" style="border-radius: 20px;"><i class="bi bi-envelope-fill"></i></button>
                    </div>
                  </form>
                </div>
              </div>




            </div>
            
          </div>
        </div>
        <br>
        @empty
            <div>NO CHATS ON PROGRESS</div>
        @endforelse
      </div>
    @endsection
  @endguest
  <script type="text/javascript" src="{{asset('/filter.js')}}"></script>
</body>
</html>
