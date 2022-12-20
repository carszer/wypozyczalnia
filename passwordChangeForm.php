<?php
    $connect = new mysqli("localhost", "root", "", "carszer");
    session_start();
    if (isset($_POST['email']))
    {
        $validation = true;
        $sprawdzemail = $_POST['email'];

        $emailIstnieje = $connect->query("SELECT id FROM klient WHERE email='$sprawdzemail'");
        $numEmail = $emailIstnieje->num_rows;
        if ($numEmail=0)
        {
            $validation = false;
            $_SESSION['error_email'] = "Użytkownik o podanym emailu nie istnieje.";
        }
        if ($numEmail>0)
        {
            $validation = true;
            $_SESSION['wyslano_haslo'] = "Użytkownik o podanym emailu istnieje.";
        }
        if($validation=true)
        {
          function generujHaslo($length) {
          $uppercase = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'W', 'Y', 'Z');
          $lowercase = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'w', 'y', 'z');
          $number = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);

          $password = NULL;

          for ($i = 0; $i < $length; $i++) {
          $password .= $uppercase[rand(0, count($uppercase) - 1)];
          $password .= $lowercase[rand(0, count($lowercase) - 1)];
          $password .= $number[rand(0, count($number) - 1)];
        }
          return substr($password, 0, $length);}
          //Zrobione jest tak że odrazu podmienia poprzednie hasło na nowe, trzeba dodać dodatkowe pole w bazie na wygenerowane hasło? jakiś pomysł?
          $newPassword = generujHaslo(8);
          $zmianahasla = $connect->query("UPDATE users SET password='$newPassword' WHERE email='$sprawdzemail'");

          function wysylanieMaila()
          {
            $header = "From: CarSzer@gmail.com \nContent-Type:".' text/plain;charset="UTF-8"'."\nContent-Transfer-Encoding: 8bit";
            $to = "$sprawdzemail";
            $subject = "Zmiana hasła";
            $message = "Witaj, twoje nowe hasło to: $newPassword. Pozdrawiamy, zespół CarSzer.";
            mail($to, $subject, $message, $header);
            if(mail($to, $subject, $message, $header))
              {
              echo "Poprawnie wysłano e-mail";
              }
              else
              {
              echo "Wystąpił nieoczekiwany błąd, spróbuj jeszcze raz...";
              }
          }
          echo "<p>Nowe hasło zostało wysłane na mail: $sprawdzemail</p>" . "\n";
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
                  <a class="nav-link active" aria-current="page" href="index.html">Strona główna</a>
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

            
              <img class="mb-4" src="img/small-logo.png" alt="" width="150" height="100">
              <h1 class="h1 mb-3 fw-normal m-md-3">Odzyskiwanie hasła</h1>
          
              <form>
              <div class="form-floating m-md-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="mail">
                <label for="floatingInput">Adres E-mail</label>
                <?php
                if (isset($_SESSION['error_email']))
                {
                    echo '<div class="error">'.$_SESSION['error_email'].'</div>';
                    unset($_SESSION['error_email']);
                }
              ?>
              </br>
                </br>
                <button class="w-50 btn btn-lg btn-primary" type="submit" name="utworz">Wyślij nowe hasło</button>
              <p class="mt-5 mb-3 text-muted">&copy; 2022–2022</p>
              </div>
            </form>

          <div class="product-device shadow-sm d-none d-md-block"></div>
          <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
          <div class="alert alert-primary" role="alert">
            Utwórz konto lub zaloguj się aby móc w pełni korzystać z serwisu!!!
          </div>
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