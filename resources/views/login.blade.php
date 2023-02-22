<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/plantillaUser.css')}}">
    <link rel="stylesheet" href="{{asset('/css/users.css')}}">
    <link rel="stylesheet" href="{{asset('/css/login.css')}}">
    <title>Document</title>
</head>
<body>
    <nav id="nav" class="navbar navbar-expand-xl navbar-light d-none d-xl-block" style="margin-top: 0px">
        <div class="container-fluid px-2">
          <a class="navbar-brand fw-bold" href="#">Green Wallets</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="lista navbar-nav ms-auto">
              <li class="nav-item me-xl-2">
                <a id="home" class="nav-link active" aria-current="page" href="{{route ('usuarios')}}">HOME</a>
              </li>
              <li class="nav-item mx-xl-2">
                <a class="nav-link active" href="https://wallets.green/what-we-do" target="_blank">WHAT WE DO</a>
              </li>
              <li class="nav-item mx-xl-2">
                <a class="nav-link active" href="https://wallets.green/financial-institutions" target="_blank">FINANCIAL INSTITUTIONS</a>
              </li>
              <li class="nav-item mx-xl-2">
                <a class="nav-link active" href="https://wallets.green/companies" target="_blank">COMPANIES</a>
              </li>
              <li class="nav-item mx-xl-2">
                <a class="nav-link active" href="https://wallets.green/individuals" target="_blank">INDIVIDUALS</a>
              </li>
            </ul>
          </div>
        </div>
        <div id="borde"></div>
      </nav>
    <div class="container-fluid d-xl-none">
      <div id="cabz"><a href="#">Green Wallets</a></div>
    </div>
    <div class="row">
        <div class="col">
            <div class="userBox login">
                <form class="" method="post" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" class="form-control p_input" placeholder="Email*">
                        {!! $errors->first('email', '<small>:message</small><br>' )!!}
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control p_input" placeholder="Password*">
                        {!! $errors->first('password', '<small>:message</small><br>' )!!}
                      </div>
                    <div class="form-group">
                        <input type="checkbox" name="data" id="data">
                        <label for="data" style="font-size: 25px"><strong>Remember my data</strong></label>
                    </div>
                    <div class="text-center cajaUE fs-1 mt-2">
                        <button id="logB" type="submit" class="btn btn-success btn-block enter-btn fs-3">LOG IN</button>
                        <button id="forgot" type="button" class="btn btn-success btn-block fs-3">FORGOT PASSWORD</button>
                    </div>
                </form>
            </div>
            <div class="textB">
                Don’t have a Green Wallet account?
                <br>
                <a id="enlace" href="{{ route('registrar') }}"><strong>Click here to get started !</strong></a>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
