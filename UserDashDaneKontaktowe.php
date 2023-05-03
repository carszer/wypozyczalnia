<?php
session_start();
if (isset($_SESSION['admin'])) {
  unset($_SESSION['admin']);
  unset($_SESSION['zalogowany']);
  session_destroy();
  header('Location: index.php');
}
?>
<?php if(empty($_SESSION['zalogowany']) || empty($_SESSION['userid'])):{
   header('Location: loginForm.php');
} 
?>
<!-- tutaj przechowujemy id zalogowanego użytkownika -->
<?php else: $userid = $_SESSION['userid']; ?>
  
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
        <h2>Dane kontaktowe</h2>

        <!-- DANE KONTAKTOWE -->
        <!-- do poprawy 
        1. nazwy label się nie wyświetlają 
        2. linia 154 (miasto) można mieć dwa pattern lub je złączyć?-->

<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
          require_once "connect.php";

          $imie = $_POST['name'];       
          $nazwisko = $_POST['nazwisko'];      
          $telefon = $_POST['telefon'];   
          $miasto = $_POST['miasto'];    
          $ulica = $_POST['ulica'];  
          $numer = $_POST['numer'];
          $nrprawojazdy = $_POST['prawojazdy'];
          
          $connect = new mysqli($host, $db_user, $db_pass, $db_name);
          $sql = "UPDATE user SET imie='$imie', nazwisko='$nazwisko', nrtelefon='$telefon', miasto='$miasto' , ulica='$ulica', lokal='$numer', nrprawojazdy='$nrprawojazdy' WHERE iduser='$userid'";
          $result = mysqli_query($connect, $sql); 
          $connect->close();

          }
   
          ?>

        

<div class="col-md-5 mx-left text-dark ">
<?php
//połączenie do bazy
             require_once "connect.php";
             $connect = new mysqli($host, $db_user, $db_pass, $db_name);
             $sql = "SELECT imie,nazwisko,nrtelefon,miasto,ulica,lokal,nrprawojazdy FROM `user` WHERE iduser=$userid";
           $result = mysqli_query($connect, $sql);
              while($pole = $result->fetch_assoc()){
               $imie = $pole ['imie'];
               $nazwisko = $pole ['nazwisko'];
               $nrTelefonu = $pole ['nrtelefon'];
               $miasto = $pole ['miasto'];
               $ulica = $pole ['ulica'];
               $lokal = $pole ['lokal'];
               $nrPrawaJazdy = $pole ['nrprawojazdy'];
              };
              $connect->close();
?>
        
          <form method="POST">
          <div class="form-check form-switch text-light">
          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" 
          onclick="this.form.elements['name'].disabled = 
          this.form.elements['nazwisko'].disabled = 
          this.form.elements['telefon'].disabled  = 
          this.form.elements['miasto'].disabled  = 
          this.form.elements['ulica'].disabled  = 
          this.form.elements['numer'].disabled  = 
          this.form.elements['prawojazdy'].disabled  = 
          !this.checked" >
          <label class="form-check-label" for="flexSwitchCheckDefault">Edytuj dane</label>
            </div>
          <div class="form-floating m-3">
            <input type="text" class="form-control" id="name" name="name" <?php echo"value= $imie"; ?> pattern="[A-Za-zęóąśłżźćńĘÓĄŚŁŻŹĆŃ ]+" required disabled >
            <label for="name">Imię</label>
          </div>

         <?php
         if(isset($_SESSION['error_imie'])) {
          echo '<div class="error">' .$_SESSION['error_imie'] . '</div>';
          unset($_SESSION['error_imie']);
         }
         ?>

        <div class="form-floating m-3">
            <input type="text" class="form-control" id="nazwisko" name="nazwisko"<?php echo"value= $nazwisko"; ?>  pattern="[A-Za-zęóąśłżźćńĘÓĄŚŁŻŹĆŃ ]+"  required disabled>
             <label for="nazwisko">Nazwisko</label>
        </div>
        <?php
        if(isset($_SESSION['error_nazwisko'])) {
          echo '<div class="error">' .$_SESSION['error_nazwisko'] . '</div>';
          unset($_SESSION['error_nazwisko']);
        }
        ?>

                <div class="form-floating m-3">
                  <input type="text" class="form-control" id="telefon" name="telefon" <?php echo"value= $nrTelefonu"; ?> pattern="^\d{9}" required disabled>
                  <label for="telefon">Nr. telefonu</label>
                </div>
                <?php
                if(isset($_SESSION['error_tel'])) {
                  echo '<div class="error">' .$_SESSION['error_tel'] . '</div>';
                  unset($_SESSION['error_tel']);
                }
                ?>

                <div class="form-floating m-3">
                  <input type="text" class="form-control" id="miasto" <?php echo"value= $miasto";?> pattern="^\w{3,50}"  pattern="[A-Za-zęóąśłżźćńĘÓĄŚŁŻŹĆŃ ]+" name="miasto"  required disabled>
                  <label for="miasto">Miasto</label>
                </div>
                <?php
                if(isset($_SESSION['error_miasto'])) {
                  echo '<div class="error">' .$_SESSION['error_miasto'] . '</div>';
                  unset($_SESSION['error_miasto']);
                }
                ?>

                <div class="form-floating m-3">
                  <input type="text" class="form-control" id="ulica"  name="ulica"<?php echo"value= $ulica"; ?>  required disabled>
                  <label for="ulica">Ulica</label>
                </div>
                <?php
                if(isset($_SESSION['error_ulica'])) {
                  echo '<div class="error">' .$_SESSION['error_ulica'] . '</div>';
                  unset($_SESSION['error_ulica']);
                }
                ?>

                <div class="form-floating m-3">
                  <input type="text" class="form-control" id="numer" name="numer"<?php echo"value= $lokal"; ?> required disabled>
                  <label for="numer">Numer lokalu</label>
                </div>
                <?php
                if(isset($_SESSION['error_lokal'])) {
                  echo '<div class="error">' .$_SESSION['error_lokal'] . '</div>';
                  unset($_SESSION['error_lokal']);
                }
                ?>

                <div class="form-floating m-3">
                  <input type="text" class="form-control" id="prawojazdy" name="prawojazdy"<?php echo"value= $nrPrawaJazdy"; ?> disabled>  
                  <label for="prawojazdy">Nr. prawa jazdy</label>
                </div>
                <?php
                if(isset($_SESSION['error_prawko'])) {
                  echo '<div class="error">' .$_SESSION['error_prawko'] . '</div>';
                  unset($_SESSION['error_prawko']);
                }
                ?>
                <button class="w-50 btn btn-lg btn-warning m-md-3" type="submit" name="submit">Zatwierdź zmiany</button>

         </form>      

        </div>
      </div>
    </main>
  </div>
  </body>
  <!-- Stopka -->
  <?php include("footer.php"); ?>

</html>
<?php endif;?>