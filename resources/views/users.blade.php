<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/plantilla.css">
    <link rel="stylesheet" href="/css/users.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>Document</title>
</head>
    {{-- <h1>USUARIOS</h1> --}}
  @extends('plantilla');
  @section('contenidoPagina')
  <div class="col-8 mt-5 mb-3">
    <div id="main">
      <div class="container">
        <div class="input-group">

          <input class="form-control border-end-0 border" type="text" id="myInput" placeholder="Search by name">

          <span class="input-group-append bg-transparent">
              <button id="botonS" class="btn" type="button" disabled>
                <i class="bi bi-search"></i>
              </button>
          </span>
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
            <tr>
                <td>Usuario 1</td>
                <td>Email 1</td>
                <td>123456789M</td>
                <td>
                    <a href="#" class="btn btn-info" data-bs-toggle="tooltip" title="More details"><i class="bi bi-eye"></i></a>
                    <a href="#" class="btn btn-warning mx-1" data-bs-toggle="tooltip" title="Edit user"><i class="bi bi-pencil"></i></a>
                    <a href="#" class="btn btn-danger" data-bs-toggle="tooltip" title="Delete user"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <tr>
                <td>paco88</td>
                <td>email@email.com</td>
                <td>432156789M</td>
                <td>
                    <a href="#" class="btn btn-info" data-bs-toggle="tooltip" title="More details"><i class="bi bi-eye"></i></a>
                    <a href="#" class="btn btn-warning mx-1" data-bs-toggle="tooltip" title="Edit user"><i class="bi bi-pencil"></i></a>
                    <a href="#" class="btn btn-danger" data-bs-toggle="tooltip" title="Delete user"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <tr>
                <td>juan</td>
                <td>email@gmail.com</td>
                <td>123454701P</td>
                <td>
                    <a href="#" class="btn btn-info" data-bs-toggle="tooltip" title="More details"><i class="bi bi-eye"></i></a>
                    <a href="#" class="btn btn-warning mx-1" data-bs-toggle="tooltip" title="Edit user"><i class="bi bi-pencil"></i></a>
                    <a href="#" class="btn btn-danger" data-bs-toggle="tooltip" title="Delete user"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <tr>
                <td>hphpññ</td>
                <td>gmail@email.com</td>
                <td>654345666K</td>
                <td>
                    <a href="#" class="btn btn-info" data-bs-toggle="tooltip" title="More details"><i class="bi bi-eye"></i></a>
                    <a href="#" class="btn btn-warning mx-1" data-bs-toggle="tooltip" title="Edit user"><i class="bi bi-pencil"></i></a>
                    <a href="#" class="btn btn-danger" data-bs-toggle="tooltip" title="Delete user"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <tr>
                <td>user5</td>
                <td>hotmail@email.com</td>
                <td>123542369Q</td>
                <td>
                    <a href="#" class="btn btn-info" data-bs-toggle="tooltip" title="More details"><i class="bi bi-eye"></i></a>
                    <a href="#" class="btn btn-warning mx-1" data-bs-toggle="tooltip" title="Edit user"><i class="bi bi-pencil"></i></a>
                    <a href="#" class="btn btn-danger" data-bs-toggle="tooltip" title="Delete user"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
  @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
