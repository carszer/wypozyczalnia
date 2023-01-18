<?php
session_start();
?>
<?php if (empty($_SESSION['zalogowany']) && empty($_SESSION['rezerwacja']) && empty($_SESSION['userid'])): {
      header('Location: loginForm.php');
    }
  ?>
<?php else: ?>
  <?php
  $zmienna = $_SESSION['rezerwacja'];
  $user = $_SESSION['userid'];
  $car = $_GET['idcar'];
  require_once "connect.php";
  $connect = new mysqli($host, $db_user, $db_pass, $db_name);
  if (isset($_POST['marka'])) {
    $validation = true;

    $imie = $_POST['name'];
    if (strlen($imie) < 3) {
      $validation = false;
      $_SESSION['error_imie'] = "Imie musi składać się z co najmniej 3 liter!";
    }

    $nazwisko = $_POST['nazwisko'];
    if (empty($nazwisko)) {
      $validation = false;
      $_SESSION['error_nazwisko'] = "Podaj nazwisko!";
    }

    $nrTel = $_POST['telefon'];
    if (strlen($nrTel) < 9) {
      $validation = false;
      $_SESSION['error_tel'] = "Numer telefonu musi składać się z 9 cyfr!";
    }

    $miasto = $_POST['miasto'];
    if (empty($miasto)) {
      $validation = false;
      $_SESSION['error_miasto'] = "Pole miasto nie może być puste!";
    }

    $ulica = $_POST['ulica'];
    if (empty($ulica)) {
      $validation = false;
      $_SESSION['error_ulica'] = "Pole ulica nie może być puste!";
    }

    $nrLok = $_POST['numer'];
    if (empty($nrLok)) {
      $validation = false;
      $_SESSION['error_lokal'] = "Pole numer lokalu nie może być puste";
    }

    $prawojazdy = $_POST['prawojazdy'];
    if (empty($prawojazdy)) {
      $validation = false;
      $_SESSION['error_prawko'] = "Pole prawo jazdy nie może być puste";
    }

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

    if ($_POST['dataod'] > $_POST['datado']) {
      $validation = false;
    }

    if ($validation == true) {
      $datado = $_POST['datado'];
      $dataod = $_POST['dataod'];
      $diff = date_diff(date_create($dataod), date_create($datado));
      $days = $diff->format('%a');
      $days = intval($days) + 1;
      $arr = array_fill(0, 32, 0);
      $idcar = $car;
      $sql = "SELECT data_start, ile_dni FROM reservation where idcar = $idcar and (data_start between'" . date('Y-m-1') . "' and '" . date('Y-m-31') . "')";
      $result = mysqli_query($connect, $sql);
      while ($pole = $result->fetch_assoc()) {
        $date = strtotime($pole['data_start']);
        $day = idate('d', $date);
        $ile = $pole['ile_dni'];
        for ($i = 0; $i < $ile; $i++) {
          $arr[$day + $i] = 1;
        }
      }
      $datefrom = strtotime($_POST['dataod']);
      $dayfrom = idate('d', $datefrom);
      $dateto = strtotime($_POST['datado']);
      $dayto = idate('d', $dateto);
      $clear = true;
      for ($i = $dayfrom; $i <= $dayto; $i++) {
        if ($arr[$i] == 1) {
          $clear = false; //Zmienna walidacyjna czy samochóch wolny(true = wolny tj można rezerwować)
        }
      }
      if ($clear) {
        $connect->query("UPDATE user SET imie='$imie', nazwisko='$nazwisko', nrtelefon='$nrTel', miasto='$miasto', ulica='$ulica', lokal='$nrLok', nrprawojazdy='$prawojazdy' WHERE email='$zmienna'");
        $sql = "INSERT INTO reservation (data_start, data_koniec,ile_dni, idcar, iduser) VALUES ('$dataod','$datado','" . $days . "','$car','$user')";
        mysqli_query($connect, $sql);
        $_SESSION['reservation'] = true;
        header('Location:rezerwacjeOK.php');
      }
    }
  }

  $idcar = $car;
  include 'Calendar.php';
  $calendar = new Calendar(date('Y-m-d'));
  $sql = "SELECT data_start, ile_dni FROM reservation where idcar = $idcar";
  $result = mysqli_query($connect, $sql);
  while ($pole = $result->fetch_assoc()) {
    $calendar->add_event('Zajęty', $pole['data_start'], $pole['ile_dni']);
  }

  $connect->close();
  ?>
  <!DOCTYPE html>
  <html lang="pl-PL">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="calendar.css" rel="stylesheet" type="text/css">
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
    <?php if (isset($_SESSION['zalogowany'])): {
      include("userNav.php");
    } ?>
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
    <?php endif; ?>
    <main class="bg-dark bg-gradient">
      <div class="album py-5 ">
        <p class="h1 text-center text-light py-4">Zarezerwuj auto!!</p>
        <div class="container">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 ">
            <?php
            $car = $_GET['idcar'];
            require_once "connect.php";
            $connect = new mysqli($host, $db_user, $db_pass, $db_name);
            $sql = "SELECT idcar, marka, model, cena,img FROM car where idcar = $car";
            $result = mysqli_query($connect, $sql);

            while ($pole = $result->fetch_assoc()) {
              echo "
          <div class='col'>
            <div class='card bg-dark text-light'>
              <img width='100%' height='225'
                src={$pole["img"]}
                alt=...>
              <div class='card-body'>
                <p class='h4 card-text'>
                {$pole['marka']}
                {$pole['model']}
                </p>
                <p class='card-text'>Cena: {$pole["cena"]} zł</p>
                <p class='card-text'></p>
                <div>
                  $calendar 
                </div>
              </div>
            </div>
          </div>
    ";
            }
            ?>
            <?php
            $sql = "SELECT idcar, marka, model, cena,img FROM car where idcar = $car";
            $result = mysqli_query($connect, $sql);
            while ($row = $result->fetch_assoc()) {
              $marka = $row['marka'];
              $model = $row['model'];
              $cena = $row['cena'];
            }
            ;
            ?>


            <!-- REZERWACJA AUTA -->
            <div class="col-md-5 mx-auto text-center">
              <form method="POST">
                <div class="form-floating m-3">
                  <input type="text" class="form-control" id="marka" name="marka" value="<?php echo "$marka" ?>" readonly>
                  <label for="Marka">Marka</label>
                </div>

                <div class="form-floating m-3">
                  <input type="text" class="form-control" id="model" name="model" value="<?php echo "$model" ?>" readonly>
                  <label for="model">Model</label>
                </div>

                <div class="form-floating m-3">
                  <input type="text" class="form-control" id="cena" name="cena" value="<?php echo "$cena" ?>" readonly>
                  <label for="cena">Cena</label>
                </div>

                <div class="form-floating m-3">
                  <input type="text" class="form-control" id="name" name="name" required>
                  <label for="name">Imię</label>
                </div>
                <?php
                if(isset($_SESSION['error_imie'])) {
                  echo '<div class="error">' .$_SESSION['error_imie'] . '</div>';
                  unset($_SESSION['error_imie']);
                }
                ?>

                <div class="form-floating m-3">
                  <input type="text" class="form-control" id="nazwisko" name="nazwisko" required>
                  <label for="nazwisko">Nazwisko</label>
                </div>
                <?php
                if(isset($_SESSION['error_nazwisko'])) {
                  echo '<div class="error">' .$_SESSION['error_nazwisko'] . '</div>';
                  unset($_SESSION['error_nazwisko']);
                }
                ?>

                <div class="form-floating m-3">
                  <input type="text" class="form-control" id="telefon" name="telefon" pattern="^\d{9}" required>
                  <label for="telefon">Nr. telefonu</label>
                </div>
                <?php
                if(isset($_SESSION['error_tel'])) {
                  echo '<div class="error">' .$_SESSION['error_tel'] . '</div>';
                  unset($_SESSION['error_tel']);
                }
                ?>

                <div class="form-floating m-3">
                  <input type="text" class="form-control" id="miasto" name="miasto" required>
                  <label for="miasto">Miasto</label>
                </div>
                <?php
                if(isset($_SESSION['error_miast'])) {
                  echo '<div class="error">' .$_SESSION['error_miasto'] . '</div>';
                  unset($_SESSION['error_miasto']);
                }
                ?>

                <div class="form-floating m-3">
                  <input type="text" class="form-control" id="ulica" name="ulica" required>
                  <label for="ulica">Ulica</label>
                </div>
                <?php
                if(isset($_SESSION['error_ulica'])) {
                  echo '<div class="error">' .$_SESSION['error_ulica'] . '</div>';
                  unset($_SESSION['error_ulica']);
                }
                ?>

                <div class="form-floating m-3">
                  <input type="text" class="form-control" id="numer" name="numer" required>
                  <label for="numer">Numer lokalu</label>
                </div>
                <?php
                if(isset($_SESSION['error_lokal'])) {
                  echo '<div class="error">' .$_SESSION['error_lokal'] . '</div>';
                  unset($_SESSION['error_lokal']);
                }
                ?>

                <div class="form-floating m-3">
                  <input type="text" class="form-control" id="prawojazdy" name="prawojazdy" required>
                  <label for="prawojazdy">Nr. prawa jazdy</label>
                </div>
                <?php
                if(isset($_SESSION['error_prawko'])) {
                  echo '<div class="error">' .$_SESSION['error_prawko'] . '</div>';
                  unset($_SESSION['error_prawko']);
                }
                ?>

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
<?php endif; ?>