<!DOCTYPE html>
<html lang="pl-PL">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>CarSzer</title>
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
  <header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top border-bottom border-warning"
      style="background-color: #1c2331">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">CarSzer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
          aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav m-auto mb-2 justify-content-center mb-md-0">
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="index.php">Strona główna</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="oferta.php">Oferta</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Rezerwuj</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Kontakt</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">O nas</a>
            </li>
          </ul>
          <div class="text-end">
            <!-- <a class="btn btn-outline-light me-2" href="loginForm.php">Zaloguj się</a> -->
            <a class="btn btn-outline-light me-2" href="loginForm.php">Zaloguj się</a>
            <!--<a class="btn btn-warning me-2" href="logowanie.html">Zaloguj się</a> -->

            <a class="btn btn-warning" href="registerForm.php">Zarejestruj się</a>
            <!--<a class="btn btn-outline-light me-2" href="registerForm.html">Zarejestruj się</a>-->
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <!-- Tittle -->
    <div class="position-relative overflow-hidden p-3 bg-light text-center ">
      <div class="col-md-5 p-lg-5 mx-auto my-5">
        <p class="h1">Ekskluzywne marki w naszej ofercie</p>
        <!--<p class="lead fw-normal">Ale jeszcze nie mam zdjęć</p> -->
        <!--  <a class="btn btn-outline-secondary" href="#">Rezerwację zrobisz później</a>-->
      </div>
      <div class="product-device shadow-sm d-none d-md-block"></div>
      <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>

    <!-- Oferta galeria -->
    <div class="album py-2 bg-light">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 ">
          <div class="col">
            <div class="card shadow-sm">
              <img width="100%" height="225"
                src="https://v.wpimg.pl/MzkxMzA0YhsKGjtJbktvDklCbxMoEmFYHlp3WG4IfUoTVyRUNkBjCgdXLFUnHycKDh9iSXQAdE1EHCwfNl8iJQYZORM7b3xUAQgoHWNN"
                alt="...">
              <div class="card-body">
                <p class="h4 card-text">To jest matiz matiz jest szybki</p>
                <p class="card-text">Cena: 99zł</p>
                <p class="card-text"></p>
                <div class="d-flex justify-content-center align-items-center">
                  <div class="btn-group jus">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Zobacz więcej</button>

                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card shadow-sm">
              <img width="100%" height="225"
                src="https://v.wpimg.pl/MzkxMzA0YhsKGjtJbktvDklCbxMoEmFYHlp3WG4IfUoTVyRUNkBjCgdXLFUnHycKDh9iSXQAdE1EHCwfNl8iJQYZORM7b3xUAQgoHWNN"
                alt="...">
              <div class="card-body">
                <p class="h4 card-text">To jest matiz matiz jest szybki</p>
                <p class="card-text">Cena: 99zł</p>
                <div class="d-flex justify-content-center align-items-center">
                  <div class="btn-group jus">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Zobacz więcej</button>

                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card shadow-sm">
              <img width="100%" height="225"
                src="https://v.wpimg.pl/MzkxMzA0YhsKGjtJbktvDklCbxMoEmFYHlp3WG4IfUoTVyRUNkBjCgdXLFUnHycKDh9iSXQAdE1EHCwfNl8iJQYZORM7b3xUAQgoHWNN"
                alt="...">
              <div class="card-body">
                <p class="h4 card-text">To jest matiz matiz jest szybki</p>
                <p class="card-text">Cena: 99zł</p>
                <div class="d-flex justify-content-center align-items-center">
                  <div class="btn-group jus">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Zobacz więcej</button>

                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card shadow-sm">
              <img width="100%" height="225"
                src="https://v.wpimg.pl/MzkxMzA0YhsKGjtJbktvDklCbxMoEmFYHlp3WG4IfUoTVyRUNkBjCgdXLFUnHycKDh9iSXQAdE1EHCwfNl8iJQYZORM7b3xUAQgoHWNN"
                alt="...">
              <div class="card-body">
                <p class="h4 card-text">To jest matiz matiz jest szybki</p>
                <p class="card-text">Cena: 99zł</p>
                <div class="d-flex justify-content-center align-items-center">
                  <div class="btn-group jus">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Zobacz więcej</button>

                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card shadow-sm">
              <img width="100%" height="225"
                src="https://v.wpimg.pl/MzkxMzA0YhsKGjtJbktvDklCbxMoEmFYHlp3WG4IfUoTVyRUNkBjCgdXLFUnHycKDh9iSXQAdE1EHCwfNl8iJQYZORM7b3xUAQgoHWNN"
                alt="...">
              <div class="card-body">
                <p class="h4 card-text">To jest matiz matiz jest szybki</p>
                <p class="card-text">Cena: 99zł</p>
                <div class="d-flex justify-content-center align-items-center">
                  <div class="btn-group jus">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Zobacz więcej</button>

                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card shadow-sm">
              <img width="100%" height="225"
                src="https://v.wpimg.pl/MzkxMzA0YhsKGjtJbktvDklCbxMoEmFYHlp3WG4IfUoTVyRUNkBjCgdXLFUnHycKDh9iSXQAdE1EHCwfNl8iJQYZORM7b3xUAQgoHWNN"
                alt="...">
              <div class="card-body">
                <p class="h4 card-text">To jest matiz matiz jest szybki</p>
                <p class="card-text">Cena: 99zł</p>
                <div class="d-flex justify-content-center align-items-center">
                  <div class="btn-group jus">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Zobacz więcej</button>

                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card shadow-sm">
              <img width="100%" height="225"
                src="https://v.wpimg.pl/MzkxMzA0YhsKGjtJbktvDklCbxMoEmFYHlp3WG4IfUoTVyRUNkBjCgdXLFUnHycKDh9iSXQAdE1EHCwfNl8iJQYZORM7b3xUAQgoHWNN"
                alt="...">
              <div class="card-body">
                <p class="h4 card-text">To jest matiz matiz jest szybki</p>
                <p class="card-text">Cena: 99zł</p>
                <div class="d-flex justify-content-center align-items-center">
                  <div class="btn-group jus">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Zobacz więcej</button>

                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card shadow-sm">
              <img width="100%" height="225"
                src="https://v.wpimg.pl/MzkxMzA0YhsKGjtJbktvDklCbxMoEmFYHlp3WG4IfUoTVyRUNkBjCgdXLFUnHycKDh9iSXQAdE1EHCwfNl8iJQYZORM7b3xUAQgoHWNN"
                alt="...">
              <div class="card-body">
                <p class="h4 card-text">To jest matiz matiz jest szybki</p>
                <p class="card-text">Cena: 99zł</p>
                <div class="d-flex justify-content-center align-items-center">
                  <div class="btn-group jus">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Zobacz więcej</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card shadow-sm">
              <img width="100%" height="225"
                src="https://v.wpimg.pl/MzkxMzA0YhsKGjtJbktvDklCbxMoEmFYHlp3WG4IfUoTVyRUNkBjCgdXLFUnHycKDh9iSXQAdE1EHCwfNl8iJQYZORM7b3xUAQgoHWNN"
                alt="...">
              <div class="card-body">
                <p class="h4 card-text">To jest matiz matiz jest szybki</p>
                <p class="card-text">Cena: 99zł</p>
                <div class="d-flex justify-content-center align-items-center">
                  <div class="btn-group jus">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Zobacz więcej</button>

                  </div>

                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </main>
  <!-- Stopka -->
  <?php include("footer.php"); ?>



</body>

</html>