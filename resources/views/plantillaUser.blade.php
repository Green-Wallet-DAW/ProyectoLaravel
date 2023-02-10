<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/plantillaUser.css">
    <title>Document</title> 
</head>
<body>
    <nav id="nav" class="navbar navbar-expand-xl navbar-light d-none d-xl-block">
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
                <a class="nav-link active" href="https://wallets.green/what-we-do">WHAT WE DO</a>
              </li>
              <li class="nav-item mx-xl-2">
                <a class="nav-link active" href="https://wallets.green/financial-institutions">FINANCIAL INSTITUTIONS</a>
              </li>
              <li class="nav-item mx-xl-2">
                <a class="nav-link active" href="https://wallets.green/companies">COMPANIES</a>
              </li>
              <li class="nav-item mx-xl-2">
                <a class="nav-link active" href="https://wallets.green/individuals">INDIVIDUALS</a>
              </li>
              <li class="nav-item ms-xl-2 d-flex align-items-center">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right flecha"></i></a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
            
              </li>
            </ul>
          </div>
        </div>
        <div id="borde"></div>
      </nav>
    <div class="container-fluid d-xl-none">
      <div id="cabz"><a href="#">Green Wallets</a></div>
    </div>
    <div class="row mt-5">
      <div class="col-3">
        <div class="aside flex-shrink-0" >
          <a href="{{route('usuarios')}}" class="d-flex align-items-center justify-content-center py-2 mb-3 text-decoration-none border-bottom">
            <span class="fs-1 text-light  fw-semibold">DASHBOARD</span>
          </a>
          <ul class="list-unstyled ps-0">
            <li class="mb-1">
              <button class="btn btn-toggle align-items-center rounded collapsed fs-3 text-light" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                QUERIES
              </button>
              <div class="subelement collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="{{route('usuarios')}}" class="link-light rounded fs-4">Users</a></li>
                  <li><a href="#" class="link-light rounded fs-4">Communities</a></li>
                  <li><a href="#" class="link-light rounded fs-4">Facilities</a></li>
                  <li><a href="#" class="link-light rounded fs-4">Machines</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle align-items-center rounded collapsed fs-3 text-light" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                TOKEN STORE
              </button>
              <div class="subelement collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="serviceList" class="link-light rounded fs-4">Services</a></li>
                </ul>
              </div>
            </li>
            <li class="border-top my-3 "></li>
          </ul>
        </div>
      </div>
      <div id="contenido" class="col-9">
        @yield('contenidoPagina')
      </div>
    </div>
    {{-- <h1>USUARIOS</h1> --}}
    {{-- <div class="footer bg-dark-subtle">
        <p class="copyright">Copyright © 2022 Green Wallets - All Rights Reserved.</p>
        <a class="privacy" href="https://wallets.green/privacy-policy">PRIVACY POLICY</a>
        <p>Powered by<a class="linkFooter" href="https://www.godaddy.com/websites/website-builder?isc=pwugc&utm_source=wsb&utm_medium=applications&utm_campaign=en-ie_corp_applications_base"> GoDaddy</a></p>
    </div> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>