<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/users.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>User List</title>
</head>
    {{-- <h1>USUARIOS</h1> --}}
  @guest
    <a href="{{route('login')}}">Login</a>
  @else
  @extends('plantillaUser');
  @section('contenidoPagina')
  <div class="col-8 mt-5 mb-3">
    
          <div id="cUser">
            <input class="form-control border" type="text" id="myInput" placeholder="Write anything to filter the list">
            <a href="/createUser"><button type="button" class="btn btn-success fs-5">Create User</button></a>
          </div>
        <br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">C.U.M.N</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="myTableU">
              @forelse ($usuarios as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->cumn}}</td>
                    <td>
                        <a href="{{route('showUser', $item->id)}}" class="btn btn-info" data-bs-toggle="tooltip" title="User {{$item->id}} details"><i class="bi bi-eye"></i></a>
                        <a href="{{route('editUser', $item->id)}}" class="btn btn-warning mx-1" data-bs-toggle="tooltip" title="Edit user {{$item->id}}"><i class="bi bi-pencil"></i></a>
                        <form id="ppp" action="{{route('deleteUser', $item->id)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" title="Delete user {{$item->id}}">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                        
                    </td>
                  </tr>
              @empty
                  <tr>USER DO NOT EXIST</td>
              @endforelse
            </tbody>
        </table>
        @endguest
  </div>
  @endsection
  <script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTableU tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script>
    
</body>
</html>
