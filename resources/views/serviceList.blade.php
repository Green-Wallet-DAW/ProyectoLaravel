<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/prueba3.css">
    <link rel="stylesheet" href="/css/serviceList.css">
    <title>Service List</title>
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
                <a id="home" class="nav-link active" aria-current="page" href="#">HOME</a>
              </li>
              <li class="nav-item mx-xl-2">
                <a class="nav-link active" href="#">WHAT WE DO</a>
              </li>
              <li class="nav-item mx-xl-2">
                <a class="nav-link active" href="#">FINANCIAL INSTITUTIONS</a>
              </li>
              <li class="nav-item mx-xl-2">
                <a class="nav-link active" href="#">COMPANIES</a>
              </li>
              <li class="nav-item mx-xl-2">
                <a class="nav-link active" href="#">INDIVIDUALS</a>
              </li>
              <li class="nav-item mx-xl-2">
                <a class="nav-link active" href="#">PROFILE</a>
              </li>
              <li class="nav-item ms-xl-2 d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#049201" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg>
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
      <div class="aside flex-shrink-0" >
        <a href="/" class="d-flex align-items-center justify-content-center py-2 mb-3 text-decoration-none border-bottom">
          <span class="fs-1 text-light  fw-semibold">DASHBOARD</span>
        </a>
        <ul class="list-unstyled ps-0">
          <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed fs-3 text-light" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
              QUERIES
            </button>
            <div class="subelement collapse show" id="home-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="link-light rounded fs-4">Users</a></li>
                <li><a href="#" class="link-light rounded fs-4">Communities</a></li>
              </ul>
            </div>
          </li>
          <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed fs-3 text-light" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
              TOKEN STORE
            </button>
            <div class="subelement collapse" id="orders-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="link-light rounded fs-4">User Services</a></li>
                <li><a href="#" class="link-light rounded fs-4">Community Services</a></li>
              </ul>
            </div>
          </li>
          <li class="border-top my-3 "></li>
        </ul>
      </div>
      <div class="col">
        <div id="caja">
          <button id="boton" type="button" data-bs-toggle="collapse" data-bs-target="#contenido" aria-controls="contenido" aria-expanded="false" aria-label="Toggle navigation">
              <svg id="flechaCaja" xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#049201" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                  <path id="path1" d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
              </svg>
              <span id="tituloCaja">TÍTULO CAJA</span>
          </button>
          <div id="descripcionCaja">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit fugiat, amet omnis necessitatibus eaque, quis sequi iusto maiores delectus ducimus debitis praesentium exercitationem accusantium totam expedita placeat rerum nisi laudantium!
          </div>
          <div id="contenido" class="collapse">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum possimus reiciendis animi velit maxime ea asperiores sequi consequuntur voluptatem tenetur quae, inventore debitis consectetur. In laudantium adipisci dolorem illum fugit.
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae nulla placeat, accusantium aperiam minus dicta expedita maiores rerum quaerat quos asperiores fugiat voluptatibus culpa, at quis. Cupiditate optio neque similique.
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quas accusantium, quam totam ea fugiat vero inventore beatae dolorum voluptatibus praesentium perferendis atque maxime. Soluta, neque! Vitae laboriosam esse eligendi enim.
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, dolor repellat quo hic dolorum, eligendi impedit vel, illo dignissimos fugit exercitationem doloribus mollitia ipsam qui. Dignissimos culpa incidunt voluptatem aspernatur?
      
          </div>
      </div>
      </div>




    </div>

    {{-- <h1>USUARIOS</h1> --}}
    <div class="footer bg-dark-subtle">
        <p class="copyright">Copyright © 2022 Green Wallets - All Rights Reserved.</p>
        <a class="privacy" href="https://wallets.green/privacy-policy">PRIVACY POLICY</a>
        <p>Powered by<a class="linkFooter" href="https://www.godaddy.com/websites/website-builder?isc=pwugc&utm_source=wsb&utm_medium=applications&utm_campaign=en-ie_corp_applications_base"> GoDaddy</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>