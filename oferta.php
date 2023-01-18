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
          </div>
        </div>
      </div>
    </nav>
  </header>
  <?php endif;?>
  <main class="bg-dark bg-gradient">
    <!-- Tittle -->
    <!-- Oferta galeria -->
    <div class="album py-5">
    <p class="h1 text-center text-light py-4">Ekskluzywne marki w naszej ofercie</p>
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 ">
<?php
 require_once "connect.php";
 $connect = new mysqli($host, $db_user, $db_pass, $db_name);
 $sql = "SELECT idcar, marka, model, moc_km,pojemnosc,moment,cena,img,opis FROM car";
 $result = mysqli_query($connect, $sql);
while($pole = $result->fetch_assoc()){
echo "
          <div class='col'>
            <div class='card bg-dark text-light'>
              <img width='100%' height='225'
                src={$pole["img"]}
                alt=...>
              <div class='card-body'>
                <p class='h4 card-text text-uppercase'>

                {$pole ['marka']}
                {$pole ['model']}
                </p>
                <p class='card-text'>Cena: {$pole["cena"]} zł</p>
                <p>Pojemność: {$pole["pojemnosc"]} cm&#179;<br>
                Moc: {$pole["moc_km"]} KM<br>
                Moment obrotowy: {$pole["moment"]} nm</p>
                <p>{$pole["opis"]}</p>
                <div class='d-flex justify-content-center align-items-center'>
                  <div class='btn-group jus'>
                    <button type='button' class='btn btn-sm btn-outline-secondary' onclick=window.location='rezerwacje.php?idcar={$pole["idcar"]}'>Rezerwuj</button>
                  </div>
                </div>
              </div>
            </div>
          </div>";
  }
   $connect->close() 
   ?>
  </main>
  <!-- Stopka -->
  <?php include("footer.php"); ?>
</body>
</html>