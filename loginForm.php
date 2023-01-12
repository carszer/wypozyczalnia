<?php
session_start();
if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
  unset($_SESSION['blad']);
  header('Location: userIndex.php');

}

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
          < <a class="btn btn-outline-light me-2" href="loginForm.php">Zaloguj się</a>
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
      <div class="col-md-5 p-5 mx-auto mt-5 ">
        <form action="zaloguj.php" method="POST">
          <img class="mb-4" src="img/matiz.png" alt="" width="150">
          <h1 class="h1 mb-5 fw-light text-light m-3">Zaloguj się</h1>

          <div class="form-floating m-3">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Adres E-mail</label>
          </div>
          <div class="form-floating m-3">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Hasło</label>
            <small id="registerHelp" class="text-light mt-1">Nie masz konta? Zarejestruj się klikajac <a
                class="text-light" href="registerForm.php">Tutaj</a></small>
            </br>
            <small id="registerHelp" class="text-light mb-1">Nie pamiętasz hasła? Odzyskaj je klikajac <a
                class="text-light" href="recoverPass.php">Tutaj</a></small>
          </div>
          <input class="w-50 btn btn-lg btn-warning m-3" type="submit" name="login_btn" value="Zaloguj się">
        </form>
        <?php
        if (isset($_SESSION['blad'])) {
          echo '<div class="alert alert-danger mt-3" role="alert">';
          echo $_SESSION['blad'];
          unset($_SESSION['blad']);
          echo '</div>';
        }
        ?>

      </div>
      <div class="alert alert-dark" role="alert">
        Utwórz konto lub zaloguj się aby móc w pełni korzystać z serwisu!!!
      </div>
      <p class="mt-5 mb-3 text-muted">&copy; 2022–2023</p>
    </div>
  </main>

  <!-- Stopka -->
  <?php include("footer.php"); ?>
</body>

</html>