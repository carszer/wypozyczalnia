<?php
$connect = new mysqli("localhost", "root", "", "testowa");
session_start();
if (isset($_POST['email'])) {
  $validation = true;

  $password1 = $_POST['pass1'];
  $password2 = $_POST['pass2'];


  if (isset($_POST['utworz'])) {
    $recaptcha = $_POST['g-recaptcha-response'];
    $secret_key = "6LdN85YjAAAAADdo-i0iuRdV6fAaeICNpWRQDA2j";
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $recaptcha;
    $response = file_get_contents($url);
    $response = json_decode($response);
    if ($response->success == true) {
      echo '<script>alert("Google reCAPTACHA verified")</script>';
    } else {
      echo '<script>alert("Error in Google reCAPTACHA")</script>';
    }
  }

  if ((strlen($password1) < 6) || (strlen($password1) > 16)) {
    $validation = false;
    $_SESSION['error_pass1'] = "Hasło musi składać się z 6 do 16 znaków!";
  }

  $addremail = $_POST['email'];

  if ($password1 != $password2) {
    $validation = false;
    $_SESSION['error_pass2'] = "Podane hasła są różne!";
  }

  //$hashPass = password_hash($password1, PASSWORD_DEFAULT);
  $emailIstnieje = $connect->query("SELECT id FROM users WHERE email='$addremail'");
  $numEmail = $emailIstnieje->num_rows;
  if ($numEmail > 0) {
    $validation = false;
    $_SESSION['error_email'] = "Użytkownik o podanym emailu istnieje.";
  }

  if ($validation == true) {
    if ($connect->query("INSERT INTO users (ID, email, password) VALUES (NULL, '$addremail', '$password1')")) {
      $_SESSION['zarejestrowany'] = true;
      $_SESSION['witamy'] = 'Zarejestrowano pomyślnie!</br><a href="loginForm.php">Zaloguj się</a>';

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
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
  <header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
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
              <a class="nav-link" href="oferta.html">Oferta</a>
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
    <div class="position-relative overflow-hidden p-3 p-md-5  text-center bg-light">
      <div class="col-md-5 p-lg-5 mx-auto my-5 ">
        <form method="POST">
          <img class="mb-4" src="img/small-logo.png" alt="" width="150" height="100">
          <h1 class="h1 mb-3 fw-normal m-md-3">Utwórz konto</h1>

          <div class="form-floating m-md-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
            <label for="floatingInput">Adres E-mail</label>
          </div>
          <?php
          if (isset($_SESSION['error_email'])) {
            echo '<div class="error">' . $_SESSION['error_email'] . '</div>';
            unset($_SESSION['error_email']);
          }
          ?>
          <div class="form-floating m-md-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass1">
            <label for="floatingPassword">Hasło</label>
          </div>
          <?php
          if (isset($_SESSION['error_pass1'])) {
            echo '<div class="error">' . $_SESSION['error_pass1'] . '</div>';
            unset($_SESSION['error_pass1']);
          }
          ?>
          <div class="form-floating m-md-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass2">
            <label for="floatingPassword">Powtórz Hasło</label>
          </div>
          <?php
          if (isset($_SESSION['error_pass2'])) {
            echo '<div class="error">' . $_SESSION['error_pass2'] . '</div>';
            unset($_SESSION['error_pass2']);
          }
          ?>

          <div class="form-floating m-md-3">
            <div class="mx-auto g-recaptcha" data-sitekey="6LdN85YjAAAAADdo-i0iuRdV6fAaeICNpWRQDA2j"></div>
          </div>

          <button class="w-50 btn btn-lg btn-primary g-recaptcha" name="utworz">Utwórz konto</button>
          <p class="mt-5 mb-3 text-muted">&copy; 2022–2022</p>
          <?php
          if (isset($_SESSION['witamy'])) {
            echo '<div class="error">' . $_SESSION['witamy'] . '</div>';
            unset($_SESSION['witamy']);
          }
          ?>
        </form>
      </div>
      <div class="product-device shadow-sm d-none d-md-block"></div>
      <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>

    </div>
    <div class="alert alert-primary text-center" role="alert">
      Utwórz konto lub zaloguj się aby móc w pełni korzystać z serwisu!!!
    </div>
  </main>
  <!-- Stopka -->
  <?php include("footer.php"); ?>

</html>