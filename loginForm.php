<?php 
  session_start();
  if ((isset($_SESSION['zaloogowany'])) && ($_SESSION['zalogowany']==true))
  {
    header('Location: userIndex.php');
    exit();
  }

?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>CarSzer</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">CarSzer</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
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
        <div class="position-relative overflow-hidden p-3 p-md-5  text-center bg-light">
          <div class="col-md-5 p-lg-5 mx-auto my-5 "> 
            <form action="zaloguj.php" method="POST">
              <img class="mb-4" src="img/small-logo.png" alt="" width="150" height="100">
              <h1 class="h1 mb-3 fw-normal m-md-3">Zaloguj się</h1>
          
              <div class="form-floating m-md-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Adres E-mail</label>
              </div>
              <div class="form-floating m-md-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Hasło</label>
                <small id="registerHelp" class="">Nie masz konta? Zarejestruj się klikajac <a href="registerForm.php">Tutaj</a></small>
                </br>
                <small id="registerHelp" class="">Nie pamiętasz hasła? Odzyskaj je klikajac <a href="recoverPass.php">Tutaj</a></small>
              </div>
            </br>
            </br>
              <input class="w-50 btn btn-lg btn-primary" type="submit" value = "Zaloguj się">
            </form> 
            <?php
              if(isset($_SESSION['blad']))
              { 
                echo '<div class="alert alert-danger" role="alert">';
                  echo $_SESSION['blad'];
                echo '</div>';
              }
            ?>
         
          </div>
          <div class="alert alert-primary" role="alert">
            Utwórz konto lub zaloguj się aby móc w pełni korzystać z serwisu!!!
          </div>
          <div class="product-device shadow-sm d-none d-md-block"></div>
          <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
        </div>
      </main>

      <footer class="container py-5">
        <div class="row">
          <div class="col-12 col-md">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mb-2" role="img" viewBox="0 0 24 24"><title>Product</title><circle cx="12" cy="12" r="10"/><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/></svg>
            <small class="d-block mb-3 text-muted">&copy; 2017–2022</small>
          </div>
          <div class="col-6 col-md">
            <h5>Features</h5>
            <ul class="list-unstyled text-small">
              <li><a class="link-secondary" href="#">Cool stuff</a></li>
              <li><a class="link-secondary" href="#">Random feature</a></li>
              <li><a class="link-secondary" href="#">Team feature</a></li>
              <li><a class="link-secondary" href="#">Stuff for developers</a></li>
              <li><a class="link-secondary" href="#">Another one</a></li>
              <li><a class="link-secondary" href="#">Last time</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>Resources</h5>
            <ul class="list-unstyled text-small">
              <li><a class="link-secondary" href="#">Resource name</a></li>
              <li><a class="link-secondary" href="#">Resource</a></li>
              <li><a class="link-secondary" href="#">Another resource</a></li>
              <li><a class="link-secondary" href="#">Final resource</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>Resources</h5>
            <ul class="list-unstyled text-small">
              <li><a class="link-secondary" href="#">Business</a></li>
              <li><a class="link-secondary" href="#">Education</a></li>
              <li><a class="link-secondary" href="#">Government</a></li>
              <li><a class="link-secondary" href="#">Gaming</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>About</h5>
            <ul class="list-unstyled text-small">
              <li><a class="link-secondary" href="#">Team</a></li>
              <li><a class="link-secondary" href="#">Locations</a></li>
              <li><a class="link-secondary" href="#">Privacy</a></li>
              <li><a class="link-secondary" href="#">Terms</a></li>
            </ul>
          </div>
        </div>
      </footer>
</body>
</html>