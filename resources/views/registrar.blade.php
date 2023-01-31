<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/plantillaUser.css">
    <link rel="stylesheet" href="{{asset('/css/users.css')}}">
    <link rel="stylesheet" href="/css/registrar.css">
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
            <div class="userBox register">
                <form method="post" action="{{ route('registro') }}">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="form-group col">
                            {{-- <label>Username</label> --}}
                            <input type="text" name="name" class="form-control p_input" placeholder="Username*">
                            {!! $errors->first('name', '<small>:message</small><br>' )!!} 
                        </div>
                        <div class="form-group col">
                            {{-- <label>Password</label> --}}
                            <input id="password" type="password" name="password" class="form-control p_input" placeholder="Password*">
                            {!! $errors->first('password', '<small>:message</small><br>' )!!}
                        </div>
                        <div class="form-group col">
                            {{-- <label>Confirm Password</label> --}}
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control p_input" placeholder="Confirm password*"> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-8">
                            {{-- <label>Email</label> --}}
                            <input type="email" name="email" class="form-control p_input" placeholder="Email*">
                            {!! $errors->first('email', '<small>:message</small><br>' )!!} 
                        </div>
                        <div class="form-group col-4">
                            {{-- <label>Phone Number</label> --}}
                            <input type="text" name="phone_number" class="form-control p_input" placeholder="Phone number*">
                            {!! $errors->first('phone_number', '<small>:message</small><br>' )!!} 
                        </div>
                    </div>
                    <div class="form-group">
                        {{-- <label>Credit Union Member Number</label> --}}
                        <input type="text" name="cumn" class="form-control p_input" placeholder="Credit Union Member Number">
                        {!! $errors->first('cumn', '<small>:message</small><br>' )!!} 
                    </div>
                    <div class="form-group pb-0">
                        <input class="checkUser data" type="checkbox" name="terms" id="terms">
                        <label for="terms"><a id="privacy" href="https://wallets.green/privacy-policy" target="_blank"><strong>I accept Terms and Conditions of Use*</strong></a></label>
                        {!! $errors->first('terms', '<small>The Terms and Conditions of Use must be accepted</small><br>' )!!} 
                    </div>
                    <div class="row">
                        <div class="form-group col-9 pb-0">
                            <input class="checkUser data" type="checkbox" name="news" id="news">
                            <label for="news"><strong>I wish to receive updates and news about Green Wallet</strong></label>
                        </div>
                        <div class="text-center cajaUE fs-1 col d-flex justify-content-end">
                            <button id="send" type="submit" class="btn btn-success btn-block enter-btn fs-3">Send</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="textB">
                Already have a Green Wallet account?
                <br>
                <a id="enlace" href="/login"><strong>Click here to log in and start !</strong></a>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>