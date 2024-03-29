<?php
require_once "connect.php";
$connect = new mysqli($host, $db_user, $db_pass, $db_name);
session_start();
if (isset($_POST['email'])) {
  $validation = true;

  $password1 = $_POST['pass1'];
  $password2 = $_POST['pass2'];
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
  $emailIstnieje = $connect->query("SELECT iduser FROM user WHERE email='$addremail'");
  $numEmail = $emailIstnieje->num_rows;
  if ($numEmail > 0) {
    $validation = false;
    $_SESSION['error_email'] = "Użytkownik o podanym emailu istnieje.";
  }

  if ($validation == true) {
    if ($connect->query("INSERT INTO user (iduser, email, password) VALUES (NULL, '$addremail', '$password1')")) {
      $_SESSION['zarejestrowany'] = true;
      header('Location:regOK.php');

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
    <div class="position-relative overflow-hidden p-3 p-md-5 text-center bg-dark bg-gradient">
      <div class="col-md-5 p-5 mx-auto mt-5">
        <form method="POST">
          <img class="mb-4" src="img/matiz.png" alt="" width="150">
          <h1 class="h1 mb-5 fw-light text-light m-3">Utwórz konto</h1>

          <div class="form-floating m-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
            <label for="floatingInput">Adres E-mail</label>
          </div>
          <?php
          if (isset($_SESSION['error_email'])) {
            echo '<div class="error">' . $_SESSION['error_email'] . '</div>';
            unset($_SESSION['error_email']);
          }
          ?>
          <div class="form-floating m-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass1">
            <label for="floatingPassword">Hasło</label>
          </div>
          <?php
          if (isset($_SESSION['error_pass1'])) {
            echo '<div class="error">' . $_SESSION['error_pass1'] . '</div>';
            unset($_SESSION['error_pass1']);
          }
          ?>
          <div class="form-floating m-3 mb-5">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass2">
            <label for="floatingPassword">Powtórz Hasło</label>
          </div>
          <?php
          if (isset($_SESSION['error_pass2'])) {
            echo '<div class="error">' . $_SESSION['error_pass2'] . '</div>';
            unset($_SESSION['error_pass2']);
          }
          ?>

          <button class="w-50 btn btn-lg btn-warning" type="submit" name="submit">Utwórz konto</button>

        </form>
      </div>

      <div class="alert alert-dark text-center" role="alert">
        Utwórz konto lub zaloguj się aby móc w pełni korzystać z serwisu!!!
      </div>
      <p class="mt-5 mb-3 text-muted">&copy; 2022–2023</p>
    </div>

  </main>
  <!-- Stopka -->
  <?php include("footer.php"); ?>
</body>

</html>