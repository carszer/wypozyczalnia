<?php 
  session_start();
?>
<!DOCTYPE html> 
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>CarSzer</title>
    <style>
    .g-recaptcha{
          width: min-content;
        }
    </style>
     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top border-bottom border-warning" style="background-color: #1c2331">
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

            
              <img class="mb-4" src="img/small-logo.png" alt="" width="150" height="100">
              <h1 class="h1 mb-3 fw-normal m-md-3">Odzyskiwanie hasła</h1>
          
              <form action="mail.php" method="post">
              <div class="form-floating m-md-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="mail">
                <label for="floatingInput">Adres E-mail</label>
              </div>
              <div class="form-floating m-md-3">
              <div class="mx-auto g-recaptcha" data-sitekey="6LfWsukjAAAAAC2hSiSZOJsf3UeZFMOfmPu21Kae" data-callback='onSubmit' data-action='submit'></div>
              </div>
              <button class="w-50 btn btn-lg btn-primary" type="submit" name="send_btn">Wyślij kod odzyskiwania</button>
              <p class="mt-5 mb-3 text-muted">&copy; 2022–2022</p>
            </form>
            
            <?php
              if(isset($_SESSION['error']))
              { 
                echo '<div class="alert alert-danger" role="alert">';
                  echo $_SESSION['error'];
                  
                echo '</div>';
                unset($_SESSION['error']);
              }
            ?>
          <div class="product-device shadow-sm d-none d-md-block"></div>
          <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>   
        </div>
        <div class="alert alert-primary" role="alert">
            Utwórz konto lub zaloguj się aby móc w pełni korzystać z serwisu!!!
          </div>
      </main>

         <!-- Stopka -->
    <?php include("footer.php"); ?>
</body>
</html>