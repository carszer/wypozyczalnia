<?php
    $connect = new mysqli("localhost", "root", "", "testowa");
    session_start();
    if (isset($_POST['email']))
    {
        $validation = true;

        $password1 = $_POST['pass1'];
        $password2 = $_POST['pass2'];


        if ((strlen($password1)<6) || (strlen($password1)>16))
        {
            $validation = false;
            $_SESSION['error_pass1'] = "Hasło musi składać się z 6 do 16 znaków!";
        }

        $addremail = $_POST['email'];

        if ($password1!=$password2)
        {
            $validation = false;
            $_SESSION['error_pass2'] = "Podane hasła są różne!";
        }
        
        //$hashPass = password_hash($password1, PASSWORD_DEFAULT);
        $emailIstnieje = $connect->query("SELECT id FROM users WHERE email='$addremail'");
        $numEmail = $emailIstnieje->num_rows;
        if ($numEmail>0)
        {
            $validation = false;
            $_SESSION['error_email'] = "Użytkownik o podanym emailu istnieje.";
        }

        if ($validation==true)
        {
          header("Location: registationSuccess.html");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>CarSzer</title>
    <style>
        .error {
            color: red;
        }
        .g-recaptcha{
          width: min-content;
        }
    </style>
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
                if (isset($_SESSION['error_email']))
                {
                    echo '<div class="error">'.$_SESSION['error_email'].'</div>';
                    unset($_SESSION['error_email']);
                }
              ?>
              <div class="form-floating m-md-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass1">
                <label for="floatingPassword">Hasło</label>
              </div>
              <?php
                if (isset($_SESSION['error_pass1']))
                {
                    echo '<div class="error">'.$_SESSION['error_pass1'].'</div>';
                    unset($_SESSION['error_pass1']);
                }
              ?>
              <div class="form-floating m-md-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass2">
                <label for="floatingPassword">Powtórz Hasło</label>
              </div>
              <?php
                if (isset($_SESSION['error_pass2']))
                {
                    echo '<div class="error">'.$_SESSION['error_pass2'].'</div>';
                    unset($_SESSION['error_pass2']);
                }
              ?>
             
              <button class="w-50 btn btn-lg btn-primary" name="utworz">Utwórz konto</button>
              <p class="mt-5 mb-3 text-muted">&copy; 2022–2023</p>
            </form>
          </div>
          <div class="product-device shadow-sm d-none d-md-block"></div>
          <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
         
        </div>
        <div class="alert alert-primary text-center" role="alert">
            Utwórz konto lub zaloguj się aby móc w pełni korzystać z serwisu!!!
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
      <script src="https://www.google.com/recaptcha/api.js"></script>
    </body>

</html>