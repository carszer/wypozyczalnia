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
        <h1 class="display-3 text-center text-light py-4">Jak przygotować się do wypożyczenia?</h1>
        <div class="text-left pt-2">
          <p class="display-6 text-light py-3">
            1. Po pierwsze, najważniejsze, nie czekaj do ostatniej chwili. Im prędzej zaczniesz
             się orientować w dostępności aut, tym większa szansa, że uda Ci się znaleźć takie, które spełni Twoje oczekiwania.
          </p>
          <p class="display-6 text-light py-3">
            2. Przygotuj prawo jazdy i jeden dodatkowy dokument tożsamości ze zdjęciem - te dokumenty są niezbędne do wynajmu auta.
          </p>
          <p class="display-6 text-light py-3">
            3. Przygotuj kartę kredytową lub debetową z odpowiednimi środkami na koncie. Zwróć uwagę, aby na koncie była odpowiednia
             ilość środków pozwalająca na blokadę pełnej kwoty za wynajem, kaucję i pełen bak paliwa. W innym wypadku wypożyczalnia 
             może odmówić wynajęcia samochodu.
             Przy końcowym rozliczeniu różnica między należnościami a zablokowanymi “na zabezpieczenie” środkami, jest zwalniana i wraca na konto.
          </p>
          <h1 class="display-3 text-center text-light py-4">Paliwo, mandaty i uszkodzenia</h1>
          <p class="display-6 text-light py-3">
          Zastanawia Cię co z tymi “zmiennymi”, o które martwiłbyś się w swoim aucie? Paliwo to nie woda, mandaty są możliwe, a stłuczka może
          zdarzyć się każdemu.
          <br><br> Co wtedy dzieje się w przypadku wynajętego samochodu? Podczas przekazania auta, otrzymujesz dokładną informację, 
          ile paliwa jest w baku - zazwyczaj jest on wypełniony “pod korek”.
          <br><br> Auto powinno być zwrócone z takim samym poziomem paliwa.
          Mandaty są kwestią kierowcy, nie właściciela auta, zatem za mandaty otrzymane podczas jazdy odpowiadasz osobiście. Tak samo opłaty przejazdowe i parkingowe.
          W przypadku stłuczki czy wypadku sprawa jest bardziej złożona. 
          <br><br>Tutaj najlepiej dokładnie zapoznać się z warunkami ubezpieczenia podczas wynajmu samochodu.
          W różnych wypożyczalniach może być to rozwiązane na inny sposób. Zazwyczaj w przypadku winy innego kierowcy, opłata idzie z OC sprawcy.
          <br><br> W przypadku winy 
          wynajmującego kwotę pokrywa wynajmujący lub ubezpieczenie dodatkowe, jeśli zostało wykupione przy wynajmie.
          </p>

          <h1 class="display-3 text-center text-light py-4">O co zapytać pracownika w wypożyczalni samochodów?</h1>
          <p class="display-6 text-light py-3">
            1. Do której godziny musisz zwrócić auto.
          </p>
          <p class="display-6 text-light py-3">
            2. Czy auto musisz zwrócić w tym samym miejscu, czy możliwy jest jego odbiór przez pracownika.
          </p>
          <p class="display-6 text-light py-3">
            2. Czy auto musisz zwrócić w tym samym miejscu, czy możliwy jest jego odbiór przez pracownika.
          </p>
          <p class="display-6 text-light py-3">
            3. Sprawdź kartę auta i stan samochodu. W karcie auta powinny być zapisane wszystkie uszkodzenia
             i rysy.<br><br> Upewnij się, czy wszystko się zgadza, aby później była pewność co do sprawcy uszkodzeń.      
          </p>
        </div>
    </div>
  </main>
  <?php include("footer.php"); ?>
  </body>
</html>