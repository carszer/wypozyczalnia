
<?php
 require_once "connect.php";
    $connect = new mysqli($host,$db_user,$db_pass,$db_name);
    //$connect = new mysqli("localhost", "root", "", "testowa");
    session_start();
if (isset($_POST['kod'])) {
  $validation = true;

  if (isset($_POST['email'])) {
    $email = $_POST['email'];
  } else {
    $validation = false;
    $_SESSION['error_email'] = "Podaj email!";
  }

  if (isset($_POST['kod'])) {
    $kod = $_POST['kod'];
  } else {
    $validation = false;
    $_SESSION['error_kod'] = "Podaj kod!";
  }

  if (isset($_POST['newpass1'])) {
    $newpass1 = $_POST['newpass1'];
  } else {
    $validation = false;
    $_SESSION['error_pass1'] = "Podaj hasło!";
  }
  if (isset($_POST['newpass2'])) {
    $newpass2 = $_POST['newpass2'];
  } else {
    $validation = false;
    $_SESSION['error_pass2'] = "Podaj hasło!";
  }

  $q1 = "SELECT kod from users where email='$email'";
  if ($validation == true) {
    if ($query = mysqli_query($connect, $q1)) {
      if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $kodBaza = $row['kod'];
        if ($kod != $kodBaza) {
          $validation = false;
          $_SESSION['error_kod'] = "Podany kod jest błędny!";
        }
      }
    } else {
      $_SESSION['error_email'] = "Podany adres email jest nieprawidłowy!";
      $validation = false;
    }
    if ((strlen($newpass1) < 6) || (strlen($newpass1) > 16)) {
      $validation = false;
      $_SESSION['error_pass1'] = "Hasło musi składać się z 6 do 16 znaków!";
    };

    if ($newpass1 != $newpass2) {
      $validation = false;
      $_SESSION['error_pass2'] = "Podane hasła są różne!";
    };
    $q2 = "UPDATE users SET password = '$newpass1' WHERE email = '$email'";
    if ($validation == true) {
      if ($connect->query($q2)) {
        header("Location: passChangeOK.php");
      }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>CarSzer</title>
    <style>
        .error {
            color: red;
        }
    </style>
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
                 <!--<a class="btn btn-warning me-2" href="logowanie.php">Zaloguj się</a> -->
                  <a class="btn btn-warning" href="registerForm.php">Zarejestruj się</a>
                  <!--<a class="btn btn-outline-light me-2" href="registerForm.php">Zarejestruj się</a>-->
              </div>
            </div>
          </div>
        </nav>
      </header>
      <main>  
        <div class="position-relative overflow-hidden p-3 p-md-5  text-center bg-light">
          <div class="col-md-5 p-lg-5 mx-auto my-5 "> 
            <form action= "changePass.php" method="POST">
              <img class="mb-4" src="img/small-logo.png" alt="" width="150" height="100">
              <h1 class="h1 mb-3 fw-normal m-md-3">Utwórz nowe hasło</h1>
          
              <div class="form-floating m-md-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="kod">
                <label for="floatingInput">Kod z maila</label>
              </div>
              <?php
                if (isset($_SESSION['error_kod']))
                {
                    echo '<div class="error">'.$_SESSION['error_kod'].'</div>';
                    unset($_SESSION['error_kod']);
                }
              ?>
              <div class="form-floating m-md-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                <label for="floatingInput">E-mail</label>
              </div>
              <?php
                if (isset($_SESSION['error_email']))
                {
                    echo '<div class="error">'.$_SESSION['error_email'].'</div>';
                    unset($_SESSION['error_email']);
                }
              ?>
              <div class="form-floating m-md-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="newpass1">
                <label for="floatingPassword">Nowe hasło</label>
              </div>
              <?php
                if (isset($_SESSION['error_pass1']))
                {
                    echo '<div class="error">'.$_SESSION['error_pass1'].'</div>';
                    unset($_SESSION['error_pass1']);
                }
              ?>
              <div class="form-floating m-md-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="newpass2">
                <label for="floatingPassword">Powtórz Hasło</label>
              </div>
              <?php
                if (isset($_SESSION['error_pass2']))
                {
                    echo '<div class="error">'.$_SESSION['error_pass2'].'</div>';
                    unset($_SESSION['error_pass2']);
                }
              ?>
            </br>
            </br>
            <input class="w-50 btn btn-lg btn-primary" type="submit" value = "Ustaw hasło">
            <p class="mt-5 mb-3 text-muted">&copy; 2022–2022</p>
            </form>
          </div>
          <div class="product-device shadow-sm d-none d-md-block"></div>
          <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
          <div class="alert alert-primary" role="alert">
            Utwórz konto lub zaloguj się aby móc w pełni korzystać z serwisu!!!
          </div>
        </div>
      </main>
      <!-- Stopka -->
    <?php include("footer.php"); ?>
</body>
</html>