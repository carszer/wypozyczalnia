
<?php
require_once "connect.php";
$validation = true;

    if (!isset($_POST['dataod'])) {
        $validation = false;
    }

    if (!isset($_POST['datado'])) {
        $validation = false;
    }

    if ($_POST['dataod'] < date('Y-m-d')) {
        $validation = false;
    }

    if ($_POST['datado'] > date('Y-m-31')) {
        $validation = false;
    }

    if($_POST['dataod']>$_POST['datado']){
        $validation = false;
    }

    if ($validation == true) {
        $arr = array_fill(0,32,0);
        $idcar = 1;
        $connect = new mysqli($host, $db_user, $db_pass, $db_name);
        $sql = "SELECT data_start, ile_dni FROM reservation where idcar = $idcar and (data_start between'" . date('Y-m-d' - 1) . "' and '" . date('Y-m-31') . "')";
        $result = mysqli_query($connect, $sql);
        while ($pole = $result->fetch_assoc()) {
            $date = strtotime($pole['data_start']);
            $day = idate('d', $date);
            $ile = $pole['ile_dni'];
            for ($i = 0; $i < $ile; $i++){
                $arr[$day + $i] = 1;
                }
        }

        $datefrom = strtotime($_POST['dataod']);
        $dayfrom = idate('d', $datefrom);
        $dateto = strtotime($_POST['datado']);
        $dayto = idate('d', $dateto);
        $clear = true;
        for($i = $dayfrom; $i <= $dayto; $i++){
        if ($arr[$i] == 1) {
            $clear = false; //Zmienna walidacyjna czy samochóch wolny(true = wolny tj można rezerwować)
        }
    }
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
              <a class="nav-link" href="oNas.php">O nas</a>
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

 
          <!-- REZERWACJA AUTA -->

          <div class="col-md-5 mx-auto text-center pt-5">
            <form method="POST">
            <div class="form-floating m-3">
            <input type="date" class="form-control" id="dataod" name="dataod" required>
              <label for="dataod">Wynajmij od:</label>
            </div>

            <div class="form-floating m-3">
            <input type="date" class="form-control" id="datado" name="datado" required>
              <label for="datado">Wynajmij do:</label>
            </div>

            <button class="w-50 btn btn-lg btn-warning m-md-3" type="submit" name="submit">Rezerwuj</button>

             </form>
          </div>
  </div>  
    </div>
  </main>
  <!-- Stopka -->
  <?php include("footer.php"); ?>
</body>

</html>
