<?php
session_start();
if (isset($_SESSION['admin'])) {
  unset($_SESSION['admin']);
  unset($_SESSION['zalogowany']);
  session_destroy();
  header('Location: index.php');
}
?>
<?php if (empty($_SESSION['zalogowany']) || empty($_SESSION['userid'])) : {
    header('Location: loginForm.php');
  }
?>
  <!-- tutaj przechowujemy id zalogowanego użytkownika -->
<?php else : $userid = $_SESSION['userid']; ?>

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
      label {
        margin-bottom: .5rem;
        text-align: right;
        display: block;
        letter-spacing: 2px;
        color: #adb5bd;
        text-transform: uppercase;
      }

      .form-control {
        color: white;
        border: none;
        background: none;
        border-bottom: 5px solid rgba(0, 0, 0, 0.2);
        transition: border-color .4s ease-out;
        border-radius: 0;
      }

      .form-control:active,
      .form-control:focus,
      .btn.focus,
      .btn:focus {
        outline: none;
        box-shadow: none;
        border-color: black;
      }

      .form-control.valid {
        border-color: green;
      }

      .form-control.invalid {
        border-color: red;
      }

      .form-control+small {
        color: red;
        opacity: 0;
        height: 0;
        transition: opacity .4s ease-out;
      }

      .form-control.invalid+small {
        opacity: 1;
        height: auto;
        margin-bottom: 20px;
        transition: opacity .4s ease-out;
      }

      *:disabled {
        color: black;
      }

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

      .buttony {
        display: flex;
      }
    </style>
    <title>CarSzer-Panel użytkownika</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="sweetalert.min.js"></script>
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-dark sticky-top border-bottom border-warning" style="background-color: #1c2331">
        <div class="container-fluid">
          <img src='img/matizB.png' height="15px" class="m-1">
          <a class="navbar-brand" href="index.php">CarSzer</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
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

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 text-light">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Panel użytkownika | <?= $_SESSION['zalogowany'] ?> | <?= $_SESSION['userid'] ?></h1>
          </div>
          <h2>Dane kontaktowe</h2>


          <div class="col-md-5 mx-auto text-dark ">
            <?php

            require_once "connect.php";
            $connect = new mysqli($host, $db_user, $db_pass, $db_name);
            $sql = "SELECT imie,nazwisko,nrtelefon,miasto,ulica,lokal,nrprawojazdy FROM `user` WHERE iduser=$userid";
            $result = mysqli_query($connect, $sql);
            while ($pole = $result->fetch_assoc()) {
              $imie = $pole['imie'];
              $nazwisko = $pole['nazwisko'];
              $nrTelefonu = $pole['nrtelefon'];
              $miasto = $pole['miasto'];
              $ulica = $pole['ulica'];
              $lokal = $pole['lokal'];
              $nrPrawaJazdy = $pole['nrprawojazdy'];
            };
            $connect->close();

            ?>

            <?php

            if (isset($_POST['name'])) {
              require_once "connect.php";
              $connect = new mysqli($host, $db_user, $db_pass, $db_name);
              $imie = $_POST['name'];
              $nazwisko = $_POST['nazwisko'];
              $telefon = $_POST['telefon'];
              $miasto = $_POST['miasto'];
              $ulica = $_POST['ulica'];
              $lokal = $_POST['numer'];
              $nrprawojazdy = $_POST['prawojazdy'];            
              $sql = "UPDATE user SET imie='$imie', nazwisko='$nazwisko', nrtelefon='$telefon', miasto='$miasto', ulica='$ulica', lokal='$lokal', nrprawojazdy='$nrprawojazdy'WHERE iduser='$userid'";
              $result = mysqli_query($connect, $sql);
            }
            ?>




            <form method="POST">
              <div class="form-check form-switch text-light">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" onclick="this.form.elements['name'].disabled = 
          this.form.elements['nazwisko'].disabled = 
          this.form.elements['telefon'].disabled  = 
          this.form.elements['miasto'].disabled  = 
          this.form.elements['ulica'].disabled  = 
          this.form.elements['numer'].disabled  = 
          this.form.elements['prawojazdy'].disabled  = 
          this.form.elements['submit'].disabled  =
          !this.checked">
                <label class="form-check-label" for="flexSwitchCheckDefault">Edytuj dane</label>
              </div>
              <div class="form-floating m-3">
                <input type="text" class="form-control" id="name" name="name" pattern="[A-Za-z]{3,20}" <?php echo "value= $imie"; ?> required disabled>
                <label for="name">Imię</label>
                <small id="nameHelp" class="form-text">Imie musi zawierać przynajmniej 3 znaki.</small>
              </div>
              <div class="form-floating m-3">
                <input type="text" class="form-control" id="nazwisko" name="nazwisko" pattern="[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]{3,20}" <?php echo "value= $nazwisko"; ?> required disabled>
                <label for="nazwisko">Nazwisko</label>
                <small id="nazwiskoHelp" class="form-text">Nazwisko musi zawierać przynajmniej 3 znaki.</small>
              </div>

              <div class="form-floating m-3">
                <input type="text" class="form-control" id="telefon" name="telefon" pattern="[0-9]{9}" <?php echo "value= $nrTelefonu"; ?> required disabled>
                <label for="telefon">Nr. telefonu</label>
                <small id="telefonHelp" class="form-text">Numer telefonu musi mieć 9 cyfr.</small>
              </div>

              <div class="form-floating m-3">
                <input type="text" class="form-control" id="miasto" pattern="[A-Za-z]{3,20}" <?php echo "value= $miasto"; ?> name="miasto" required disabled>
                <label for="miasto">Miasto</label>
                <small id="miastoHelp" class="form-text">Miasto musi zawierać przynajmniej 3 znaki.</small>
              </div>

              <div class="form-floating m-3">
                <input type="text" class="form-control" id="ulica" name="ulica" pattern="(?!\.)(?!(0))[A-Za-ząćęłńóśźżĄĆĘŁŃÓŚŹŻ0-9.-]{3,20}" <?php echo "value= $ulica"; ?> required disabled>
                <label for="ulica">Ulica</label>
                <small id="ulicaHelp" class="form-text">Ulica musi zawierać przynajmniej 3 znaki.</small>
              </div>

              <div class="form-floating m-3">
                <input type="text" class="form-control" id="numer" name="numer" pattern="(?!(0))[0-9A-Za-z/]{1,7}" <?php echo "value= $lokal"; ?> required disabled>
                <label for="numer">Lokal</label>
                <small id="numerHelp" class="form-text">Podaj numer lokalu np. '10B/12', '10'</small>
              </div>

              <div class="form-floating m-3">
                <input type="text" class="form-control" id="prawojazdy" name="prawojazdy" pattern="(?!\.)[0-9]{5}/[0-9]{2}/[0-9]{4}" <?php echo "value= $nrPrawaJazdy"; ?> required disabled>
                <label for="prawojazdy">Nr. prawa jazdy</label>
                <small id="prawojazdyHelp" class="form-text">Numer prawa jazdy musi składać się z 11 znaków i wygląda nastepująco 12345/12/1234</small>
              </div>
              <div class="buttony">
                <input class="w-50 btn btn-lg btn-warning m-md-3" type="submit" name="submit" disabled value="Zatwierdź"></input>
                <button class="w-50 btn btn-lg btn-warning m-md-3" onClick="window.location.userDashDaneKontaktowe.php=window.location.userDashDaneKontaktowe.php">Odśwież</button>
              </div>

            </form>
          </div>
      </div>
      </main>
    </div>
    <script>
      const inputs = document.querySelectorAll('input');

      const patterns = {
        name: /^[A-Za-z]{3,20}$/i,
        nazwisko: /^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]{3,20}$/i,
        telefon: /^[0-9]{9}$/,
        miasto: /^[A-Za-z]{3,20}$/i,
        ulica: /^(?!\.)(?!(0))[A-Za-ząćęłńóśźżĄĆĘŁŃÓŚŹŻ0-9.-]{3,20}$/i,
        numer: /^(?!(0))[0-9A-Za-z/]{1,7}$/i,
        prawojazdy: /^(?!\.)[0-9]{5}\/[0-9]{2}\/[0-9]{4}$/
      };

      inputs.forEach((input) => {
        input.addEventListener('keyup', (e) => {
          validate(e.target, patterns[e.target.attributes.id.value]);
        });
      });

      function validate(field, regex) {
        if (regex.test(field.value)) {
          field.className = 'form-control valid';
        } else {
          field.className = 'form-control invalid';
        }
      }
    </script>
  </body>
  <!-- Stopka -->
  <?php include("footer.php"); ?>

  </html>
<?php endif; ?>