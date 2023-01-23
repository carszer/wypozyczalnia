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
        <h1 class="display-3 text-center text-light py-4">Polityka prywatności Carszer</h1>
        <div class="text-left pt-2">
          <p class="display-7 text-light py-3">
            <b>Administrator</b> - Carszer S.A z siedzibą na AMW.
          </p>
          <p class="display-7 text-light py-3">
            <b>Dane osobowe</b> - wszystkie informacje o osobie fizycznej zidentyfikowanej 
            lub możliwej do zidentyfikowania poprzez jeden bądź kilka szczególnych czynników 
            określających fizyczną, fizjologiczną, genetyczną, psychiczną, ekonomiczną, 
            kulturową lub społeczną tożsamość.
            <br>
            W tym IP urządzenia, dane o lokalizacji, identyfikator internetowy oraz informacje 
            gromadzone za pośrednictwem plików cookies oraz innej podobnej technologii.
          </p>
          <p class="display-7 text-light py-3">
            <b>Polityka</b> - niniejsza Polityka prywatności.
          </p>
          <p class="display-7 text-light py-3">
          <b>RODO</b> – Rozporządzenie Parlamentu Europejskiego i Rady (UE) 2016/679 z dnia 27
           kwietnia 2016 r. w sprawie ochrony osób fizycznych w związku z przetwarzaniem danych
           osobowych i w sprawie swobodnego przepływu takich danych oraz uchylenia dyrektywy 95/46/WE.
          </p>
          <p class="display-7 text-light py-3">
          <b>Serwis</b> – serwis internetowy prowadzony przez Administratora pod adresem carszer.bialystok.pl
          </p>
          <p class="display-7 text-light py-3">
           <b>Użytkownik</b> – każda osoba fizyczna odwiedzająca Serwis lub korzystająca z jednej albo kilku usług
           czy funkcjonalności opisanych w Polityce, w tym za pośrednictwem Aplikacji mobilnych
          </p>
          <p class="display-7 text-light py-3">
            <b>Przetwarzanie danych w związku z korzystaniem z serwisu</b> - W związku z korzystaniem przez
            Użytkownika z Serwisu Administrator zbiera dane w zakresie niezbędnym do świadczenia poszczególnych 
            oferowanych usług, a także informacje o aktywności Użytkownika w Serwisie. Poniżej zostały opisane
            szczegółowe zasady oraz cele przetwarzania danych osobowych gromadzonych podczas korzystania z Serwisu przez Użytkownika.
          </p>
          
        </div>
    </div>
  </main>
  <?php include("footer.php"); ?>
  </body>
</html>