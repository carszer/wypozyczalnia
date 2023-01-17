<?php
session_start();
?>
<?php if(empty($_SESSION['zalogowany'])):{
   header('Location: loginForm.php');
}
?>
<?php else: ?>
<?php
require_once "connect.php";
$connect = new mysqli($host, $db_user, $db_pass, $db_name);
if (isset($_POST['marka'])) {
  $validation = true;

  $marka = $_POST['marka'];
  if (isset($_POST['marka'])) {
    $validation = true;
  }

  $model = $_POST['model'];
  if (isset($_POST['model'])) {
    $validation = true;
  }

  $cena = $_POST['cena'];
  if (isset($_POST['cena'])) {
    $validation = true;
  }

  $imie = $_POST['name'];
  if (isset($_POST['name'])) {
    $validation = true;
  }

  $nazwisko = $_POST['nazwisko'];
  if (isset($_POST['nazwisko'])) {
    $validation = true;
  }

  $nrTel = $_POST['telefon'];
  if (strlen($nrTel) < 9) {
    $validation = true;
  }

  $miasto = $_POST['miasto'];
  if (isset($_POST['miasto'])) {
    $validation = true;
  }

  $ulica = $_POST['ulica'];
  if (isset($_POST['ulica'])) {
    $validation = true;
  }

  $nrLok = $_POST['numer'];
  if (isset($_POST['numer'])) {
    $validation = true;
  }

  $prawojazdy = $_POST['prawojazdy'];
  if (isset($_POST['prawojazdy'])) {
    $validation = true;
  }

  if ($validation == true) {
    if ($connect->query("INSERT INTO rezerwacje (ID, marka, model, cena, imie, nazwisko, nr_tel, miasto, ulica, nr_lokalu,
    nr_praw) VALUES (NULL, '$marka', '$model', '$cena', '$imie', '$nazwisko', '$nrTel', '$miasto', '$ulica', '$nrLok', '$prawojazdy')")) {
      $_SESSION['rezerwacja'] = true;
    }
  }
}
$connect->close();
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
  <style>
    .error {
      color: red;
    }

    .g-recaptcha {
      width: min-content;
    }
  </style>
  <?php include("logo.php"); ?>
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
              <a class="nav-link active" aria-current="page" href="index.php">Strona główna</a>
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
  <main class="bg-dark bg-gradient">
  <div class="album py-5 " >
    <p class="h1 text-center text-light py-4">Zarezerwuj auto!!</p>
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 ">
          <div class="col">
            <div class="card bg-dark text-light">
              <img width="100%" height="225"
                src="https://v.wpimg.pl/MzkxMzA0YhsKGjtJbktvDklCbxMoEmFYHlp3WG4IfUoTVyRUNkBjCgdXLFUnHycKDh9iSXQAdE1EHCwfNl8iJQYZORM7b3xUAQgoHWNN"
                alt="...">
              <div class="card-body">
                <p class="h4 card-text">To jest matiz matiz jest szybki</p>
                <p class="card-text">Cena: 99zł</p>
              </div>
            </div>
          </div>
          <!-- REZERWACJA AUTA -->

          <div class="col-md-5 mx-auto text-center">
            <form method="POST">
            <div class="form-floating m-3">
              <input type="text" class="form-control" id="marka" name="marka" value="Dełu" readonly >
              <label for="Marka">Marka</label>
            </div>

            <div class="form-floating m-3">
              <input type="text" class="form-control" id="model" name="model" value="Matiz" readonly>
              <label for="model">Model</label>
            </div>

            <div class="form-floating m-3">
              <input type="text" class="form-control" id="cena" name="cena" value="99 PLN" readonly>
              <label for="cena">Cena</label>
            </div>

            <div class="form-floating m-3">
              <input type="text" class="form-control" id="name" name="name" required>
              <label for="name">Imię</label>
            </div>

            <div class="form-floating m-3">
            <input type="text" class="form-control" id="nazwisko" name="nazwisko" required>
              <label for="nazwisko">Nazwisko</label>
            </div>

            <div class="form-floating m-3">
            <input type="text" class="form-control" id="telefon" name="telefon" pattern="^\d{9}" required>
              <label for="telefon">Nr. telefonu</label>
            </div>

            <div class="form-floating m-3">
            <input type="text" class="form-control" id="miasto" name="miasto" required>
              <label for="miasto">Miasto</label>
            </div>

            <div class="form-floating m-3">
            <input type="text" class="form-control" id="ulica" name="ulica" required>
              <label for="ulica">Ulica</label>
            </div>

            <div class="form-floating m-3">
            <input type="text" class="form-control" id="numer" name="numer" required>
              <label for="numer">Numer lokalu</label>
            </div>

            <div class="form-floating m-3">
            <input type="text" class="form-control" id="prawojazdy" name="prawojazdy" required>
              <label for="prawojazdy">Nr. prawa jazdy</label>
            </div>

            <button class="w-50 btn btn-lg btn-warning m-md-3" type="submit" name="submit">Rezerwuj</button>

             </form>
          </div>
  </div>  
    </div>
  </main>
  <!-- Stopka -->
  <?php include("footer.php"); ?>
</body>

</html>
<?php endif;?>