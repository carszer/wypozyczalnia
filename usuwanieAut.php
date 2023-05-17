<?php
session_start();
?>
<?php
if (empty($_SESSION['admin'])) : {
    header('Location: loginForm.php');
  }
?>
<?php else : ?>
  <!DOCTYPE html>
  <html lang="pl-PL">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <?php include("logo.php"); ?>
    <link href="dashboard.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <style>
      .g-recaptcha {
        width: min-content;
      }

      table,
      tr,
      td {
        color: white;
      }

      main {
        min-height: 1000px;
      }

      table,
      td {
        font-size: 18px;
      }
    </style>
    <title>CarSzer-Panel administratora</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="sweetalert.min.js"></script>

    <script>
      function changeImg() {
        car = document.getElementById("car");
        img = car.options[car.selectedIndex].id
        document.getElementById("imgFrame").src = img;
      }
    </script>


    <script>
      if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
      }
    </script>
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-dark sticky-top border-bottom border-warning" style="background-color: #1c2331">
        <div class="container-fluid">
          <img src='img/matizB.png' height="15px" class="m-1">
          <a class="navbar-brand" href="adminIndex.php">CarSzer</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav m-auto mb-2 justify-content-center mb-md-0">
            </ul>
            <div class="text-end">
              <button class="btn btn-outline-light me-2" type="button" onclick="window.location='adminDash.php'" id="logButton">Panel Administratora</button>
              <!--<a class="btn btn-warning me-2" href="logowanie.html">Zaloguj się</a> -->

              <!-- <button class="btn btn-warning" type="button" onclick="window.location='wyloguj.php'" id="registerButton">Wyloguj</button> -->
              <a class="btn btn-warning" type="submit" href="wyloguj.php">Wyloguj się</a>
              <!--<a class="btn btn-outline-light me-2" href="registerForm.php">Zarejestruj się</a>-->
            </div>
          </div>
        </div>
      </nav>
    </header>

    <div class="container-fluid bg-dark bg-gradient">
      <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block collapse bg-dark">
          <div class="position-sticky pt-3 sidebar-sticky ">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a style="color: white" class="nav-link btn btn-secondary m-2 " role="button" href="adminDash.php">Podgląd rezerwacji</a>
              </li>

              <li class="nav-item">
                <a style="color: white" class="nav-link btn btn-secondary m-2 " role="button" href="adminDashPrzerwaTech.php">Dodawanie przerw technicznych</a>
              </li>

              <li class="nav-item">
                <a style="color: white" class="nav-link btn btn-secondary m-2 " role="button" href="dodawanieAut.php">Dodawanie pojazdów do oferty</a>
              </li>

              <li class="nav-item">
                <a style="color: white" class="nav-link btn btn-secondary m-2 " role="button" href="usuwanieAut.php">Usuwanie pojazdów z oferty</a>
              </li>
          </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 text-light">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Panel Administratora | Hi admin</h1>
          </div>

          <h2 class="col-md-5 mx-auto text-center">Dodaj przerwę techniczną</h2>
          <!--DODAWANIE PRZERWY TECH -->
          <?php
          require_once "connect.php";
          $connect = new mysqli($host, $db_user, $db_pass, $db_name);
          $sql = "SELECT idcar, img, marka, model FROM car";
          $result = $connect->query($sql);
          if ($result->num_rows > 0) {

            $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
          }
          $sql = "SELECT iduser FROM user where email = 'przerwatech@gmail.com'";
          $result = $connect->query($sql);
          if ($result->num_rows > 0) {
            $iduser = mysqli_fetch_row($result);
            $iduser = $iduser[0];
          }
          ?>
          <div class="col-md-5 mx-auto text-center">
            <img id="imgFrame" class="img-thumbnail" src="<?php echo $options[0]['img']; ?>">

            <form method="post" action="deleteCar.php">
              <div class="form-floating m-3 text-dark">
                <select class="form-select text-dark" name="car" id="car" onchange="changeImg()" required>
                  <?php
                  foreach ($options as $option) {
                  ?>
                    <option id="<?php echo $option['img'] ?>" value="<?php echo $option['idcar'] ?>"> <?php echo $option['marka'] . " " . $option['model']; ?> </option>
                  <?php
                  }
                  ?>
                </select>
                <label for="car">Wybierz auto:</label>
              </div>

              <input class="w-50 btn btn-lg btn-warning m-md-3" type="submit" name="submit" value="Usuń"></input>
            </form>

            <?php include("tabelaAutInvisible.php"); ?>
          
          </div>

        </main>
      </div>
  </body>
  <!-- Stopka -->
  <?php include("footer.php"); ?>

  </html>
<?php endif; ?>