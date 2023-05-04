<?php
session_start();
?>
<?php
if(empty($_SESSION['admin'])):{
  header('Location: loginForm.php');
}
?>
<?php else: ?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <?php include("logo.php"); ?>
    <link href="dashboard.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
  <style>

    .g-recaptcha {
      width: min-content;
    }
    table, tr, td {
      color: white;
    }
    main{
      min-height: 1000px;
    }
    table,td{
      font-size: 18px;
    }
  </style>
  <title>CarSzer-Panel administratora</title>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="sweetalert.min.js"></script>
</head>
<body>
    <header >
    <nav class="navbar navbar-expand-md navbar-dark sticky-top border-bottom border-warning"
      style="background-color: #1c2331">
      <div class="container-fluid">
        <img src='img/matizB.png' height="15px" class="m-1">
        <a class="navbar-brand" href="adminIndex.php">CarSzer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
          aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
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
            <br>
            <a style="color: white" class="nav-link btn btn-secondary m-2 " role="button" href="adminDashPrzerwaTech.php">Dodawanie przerw technicznych</a>
          </li>  
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 text-light" >
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Panel Administratora | Hi admin</h1>
      </div>

      <h2>Dodaj przerwę techniczną</h2>
                <!--DODAWANIE PRZERWY TECH -->
      <?php
      require_once "connect.php";
      $connect = new mysqli($host, $db_user, $db_pass, $db_name);
      $sql = "SELECT idcar, marka, model FROM car";
      $result = $connect->query($sql);
      if($result->num_rows > 0) {
        $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
      }

      $connect->close();
   ?>
    <div class="col-md-5 mx-left text-center">
    <form method="post">
        <div class="form-floating m-3 text-dark">
        <select class="form-select text-dark" name="car" required>
        <option  disabled selected hidden>Wybierz auto</option>
          <?php
            foreach ($options as $option) {
              ?>
              <option value=<?php $option['marka']?>><?php echo $option['marka']. " " . $option['model']; ?> </option>
              <?php
            }
            ?>
        </select>
        </div>

        <div class="form-floating m-3 text-dark">
                  <input type="date" name="dataod" id="dataod" class="form-control" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" min="<?php echo date('Y-m-d'); ?>">
                  <label for="dataod">Przerwa od:</label>
                </div>

                <div class="form-floating m-3 text-dark">
                  <input type="date" class="form-control" id="datado" name="datado" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" min="<?php echo date('Y-m-d'); ?>">
                  <label for="datado">Przerwa do:</label>
                </div>

               <input class="w-50 btn btn-lg btn-warning m-md-3" type="submit" name="submit" value="Akceptuj"></input>
     </form>

     <?php
     // za wczesna data
     /*
      require_once "connect.php";
      $connect = new mysqli($host, $db_user, $db_pass, $db_name);
      $currentDate = date('Y-m-d');
      $_SESSION['user'] = true;

      $validation = true;
      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
        $dataOd = $_POST['dataod'];
        if($dataOd < $currentDate) {
          $validation = false;
          $_SESSION['user'] = 'Nieprawidłowe dane!!!';
        }
        echo $dataOd;
      }
     
     
      */
      
     ?>
     <?php
     // Błąd za wczesna data
     /*
        if (isset($_SESSION['user'])) {
          echo '<div class="alert alert-danger mt-3" role="alert">';
          echo $_SESSION['user'];
          unset($_SESSION['user']);
          echo '</div>';
        }
        */
        ?>

    </div>
   
    </main>
  </div>
  </body>
  <!-- Stopka -->
  <?php include("footer.php"); ?>

</html>
<?php endif;?>