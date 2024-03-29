<?php
session_start();
if (isset($_SESSION['admin'])) {
  unset($_SESSION['admin']);
  unset($_SESSION['zalogowany']);
  session_destroy();
  header('Location: index.php');
}
?>
<?php if(empty($_SESSION['zalogowany']) && empty($_SESSION['userid'])):{
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
  <title>CarSzer-Panel użytkownika</title>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="sweetalert.min.js"></script>
</head>
<body>
    <header >
    <nav class="navbar navbar-expand-md navbar-dark sticky-top border-bottom border-warning"
      style="background-color: #1c2331">
      <div class="container-fluid">
        <img src='img/matizB.png' height="15px" class="m-1">
        <a class="navbar-brand" href="index.php">CarSzer</a>
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
              <a class="nav-link" href="#">Kontakt</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">O nas</a>
            </li>
          </ul>
          <div class="text-end">
          <button class="btn btn-outline-light me-2" type="button" onclick="window.location='userDash.php'" id="logButton">Panel
              użytkownika</button>
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
            <a style="color: white" class="nav-link btn btn-secondary me-2" role="button" href="userDash.php">Moje rezerwacje</a>   
            <br>
            <a style="color: white" class="nav-link btn btn-secondary me-2" role="button" href="userDashDaneKontaktowe.php">Dane kontaktowe</a>   
          </li>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 text-light" >
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Panel użytkownika | <?=$_SESSION['zalogowany']?> | <?=$_SESSION['userid']?></h1>
      </div>
      <h2>Moje rezerwacje</h2>
  
            <table class='table'>
            <thead>
              <tr>
                <th scope='col'>Marka</th>
                <th scope='col'>Model</th>
                <th scope='col'>Cena</th>
                <th scope='col'>Początek</th>
                <th scope='col'>Koniec</th>
                <th scope='col'>Liczba dni</th>
                <th scope='col'> </th>
              </tr>
            </thead>
            <tbody>
           
           <?php
             require_once "connect.php";
             $connect = new mysqli($host, $db_user, $db_pass, $db_name);
            $zmienna = $_SESSION['rezerwacja'];
            $sql = "SELECT  c.marka, c.model, c.cena, r.idreservation, r.data_start, r.data_koniec, r.ile_dni, r.potwierdzone as dni FROM car as c 
            INNER JOIN reservation as r ON c.idcar=r.idcar
            INNER JOIN user as u ON u.iduser=r.iduser WHERE u.email = '$zmienna'";
            $result = mysqli_query($connect, $sql);
            //while ($pole = $result->fetch_row()) {
              while($pole = $result->fetch_assoc()){
                echo '<form action="deleteuser.php" method="post" onsubmit="return submitForm(this);">';
                echo"
                <tr>
                <td>{$pole ['marka']}</td>
                <td>{$pole ['model']}</td>
                <td>{$pole ['cena']}</td>
                <td>{$pole ['data_start']}</td>
                <td>{$pole ['data_koniec']}</td>
                <td>{$pole ['ile_dni']}</td>
                <td><input type='submit' class='btn btn-danger' name='deletebutton' value='Usuń'></td>
                </tr>
                <input type='hidden' name='idreservation' value='{$pole ['idreservation']}'>
                </form>";     
            }
            if(isset($_POST['deletebutton'])){
            $_SESSION['resOK'] = true;
            }
        $connect->close();
        ?>
        
         <script>
	          function submitForm(form) {
                swal({
                  title: "Potwierdź operację",
                  text: "Czy jestes pewien że chcesz usunąć rezerwację auta?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then(function (isOkay) {
                  if (isOkay) {
                    form.submit();
                  }
                });
                return false;
              }
                </script>
        </tbody>
        </table>
      </div>
    </main>
  </div>
  </body>
  <!-- Stopka -->
  <?php include("footer.php"); ?>

</html>
<?php endif;?>