<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>CarSzer</title>
  <?php include("logo.php"); ?>
 <style>

  main{
    min-height:1000px;
  }
  </style>
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

    <?php if(isset($_SESSION['zalogowany'])):{
          include("userNav.php");
      }?>
      <?php else: ?>
  <header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top border-bottom border-warning"
      style="background-color: #1c2331">
      <div class="container-fluid">
      <img src='img/matizB.png' height="15px" class="m-1">
        <a class="navbar-brand" href="#">CarSzer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
          aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav m-auto mb-2 justify-content-center mb-md-0">
            <li class="nav-item">
              <a class="nav-link active " aria-current="page" href="index.php">Strona główna</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="oferta.php">Oferta</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Rezerwuj</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Kontakt</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="oNas.php">O nas</a>
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
  <?php endif;?>
  <main class="bg-dark ">
    <div class="container marketing py-5">
        <h1 class="display-3 text-center text-light py-4">Kim jesteśmy?</h1>
        <div class="text-center pt-2">
          <h1 class="display-5 text-light py-4">
          Jesteśmy tylko prostymi studentami, którzy robią za darmo silnik do wypożyczalni samochodów...
          Na papierze naszym celem jest stworzenie tego silnika...
          Ale w głębi duszy chcemy iść na piwo... A najlepiej na KRZYNKĘ PIWA!
          </h1>
        </div>
    <!-- Three columns of text below the carousel -->
        <div class="row text-center py-5 text-light">
            <div class="col-lg-4">
                <img src="https://www.wme.amw.gdynia.pl/wp-content/uploads/2020/04/niemczyk_S.png" class="rounded-circle " width="200" height="200" role="img">
                <h2 class="fw-normal ">Tadeusz Poniemiecki</h2>
                <p>Główny koordynator projektu</p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
            <img src="https://www.wme.amw.gdynia.pl/wp-content/uploads/2020/04/t.leszczynski.jpg" class="rounded-circle " width="200" height="200" role="img">
                <h2 class="fw-normal ">Tomasz Leszczyna</h2>
                <p>Chuj wie po co on komu</p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
            <img src="https://www.wme.amw.gdynia.pl/wp-content/uploads/2020/04/blaszczyk_S.png" class="rounded-circle " width="200" height="200" role="img">
                <h2 class="fw-normal ">Marek Błaszczuk</h2>
                <p>Opełatoł statku SAŁ</p>
            </div><!-- /.col-lg-4 -->
            
        </div>
    </div>
  </main>
  <?php include("footer.php"); ?>
  </body>
</html>