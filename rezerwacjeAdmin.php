<?php
session_start();
?>
<?php
if (empty($_SESSION['admin'])) : {
        header('Location: admin.php');
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

            #cena {
                background: none;
                border-bottom: 5px solid green;
                transition: border-color .4s ease-out;
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

            .error {
                color: red;
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
        </style>
        <title>CarSzer-Panel administratora</title>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="sweetalert.min.js"></script>

   
<script>
    function changeImgAndPrice() {
        var car = document.getElementById("car");
        var selectedCar = car.options[car.selectedIndex];
        var img = selectedCar.id;
        var price = selectedCar.dataset.price;
        
        document.getElementById("imgFrame").src = img;
        document.getElementById("cena").value = price;
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

                            <li class="nav-item">
                                <a style="color: white" class="nav-link btn btn-secondary m-2 " role="button" href="rezerwacjeAdmin.php">Dodawanie rezerwacji</a>
                            </li>
                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 text-light">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Panel Administratora | Hi admin</h1>
                    </div>

                    <h2 class="col-md-5 mx-auto text-center">Dodaj rezerwację</h2>
                    <?php
                    require_once "connect.php";
                    $connect = new mysqli($host, $db_user, $db_pass, $db_name);
                    $sql = "SELECT idcar, img, marka, model, cena FROM car WHERE visible = 1";
                    $result = $connect->query($sql);
                    if ($result->num_rows > 0) {

                        $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    }
                  
                    $validation = true;
                    //walidacja
                    if (isset($_POST['submit'])) {

                            $validation = true;
                            
                            if (isset($_POST['email'])) {
                                $addremail = $_POST['email'];
                                }
                                else{
                                    $_SESSION['error_email'] = "Mail musi być wpisany";
                                }


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

                            if (!isset($_POST['car'])) {
                                $validation = false;
                              }
                            else
                                $idcar = $_POST['car'];

                            if (!isset($_POST['dataod'])) {
                              $validation = false;
                              $_SESSION['error_data'] = "Data niepoprawna";  
                            }
                        
                            if (!isset($_POST['datado'])) {
                              $validation = false;
                              $_SESSION['error_data'] = "Data niepoprawna";
                            }
                        
                            if ($_POST['dataod'] < date('Y-m-d')) {
                              $validation = false;
                              $_SESSION['error_data'] = "Data niepoprawna";
                            }
                        
                            if ($_POST['datado'] > date('Y-m-31')) {
                              $validation = false;
                              $_SESSION['error_koniec'] = "Samochody wynajmujemy na bieżący miesiąc, spróbuj w następnym miesiącu";
                            }
                        
                            if ($_POST['dataod'] > $_POST['datado']) {
                              $validation = false;
                              $_SESSION['error_data'] = "Data niepoprawna";
                            }

                        if ($validation == true) {
                            $datado = $_POST['datado'];
                            $dataod = $_POST['dataod'];
                            $diff = date_diff(date_create($dataod), date_create($datado));
                            $days = $diff->format('%a');
                            $days = intval($days) + 1;
                            $arr = array_fill(0, 32, 0);
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
                                $quser = $connect->query("SELECT iduser FROM user WHERE email='$addremail'");
                                if($quser->num_rows > 0){
                                    $row = $quser->fetch_assoc();
                                    $connect->query("UPDATE user SET imie='$imie', nazwisko='$nazwisko', nrtelefon='$nrTel', miasto='$miasto', ulica='$ulica', lokal='$nrLok', nrprawojazdy='$prawojazdy' WHERE email='$addremail'");
                                    $sql = "INSERT INTO reservation (data_start, data_koniec,ile_dni, idcar, iduser) VALUES ('$dataod','$datado','" . $days . "','$idcar','$row[iduser]')";
                                    mysqli_query($connect, $sql);
                                     $_SESSION['reservation'] = true;
                                     header('Location:rezerwacjeOKadmin.php');
                                }
                                else{
                                    $connect->query("INSERT INTO user (iduser, email, password) VALUES (NULL, '$addremail', '123456')");
                                    $quser = $connect->query("SELECT iduser FROM user WHERE email='$addremail'");
                                    $row = $quser->fetch_assoc();
                                    $connect->query("UPDATE user SET imie='$imie', nazwisko='$nazwisko', nrtelefon='$nrTel', miasto='$miasto', ulica='$ulica', lokal='$nrLok', nrprawojazdy='$prawojazdy' WHERE email='$addremail'");
                                    $sql = "INSERT INTO reservation (data_start, data_koniec,ile_dni, idcar, iduser) VALUES ('$dataod','$datado','" . $days . "','$idcar','$row[iduser]')";
                                    mysqli_query($connect, $sql);
                                     $_SESSION['reservation'] = true;
                                     header('Location:rezerwacjeOKadmin.php');
                                  }
                            }
                            else{
                              $_SESSION['error_zajety'] = "W wybranym terminie samochód jest już zarezerwowany";
                            }
                          }
                        }

                    
                    $connect->close();
                    ?>


                    <div class="col-md-5 mx-auto text-center">
                        <img id="imgFrame" class="img-thumbnail" width="" src="<?php echo $options[0]['img']; ?>">
                        <form method="post" action="">
                            <div class="form-floating m-3 text-dark">
                                <select class="form-select text-dark" name="car" id="car" onchange="changeImgAndPrice()" required>
                                    <?php
                                    foreach ($options as $option) {
                                    ?>
                                        <option class="opt" id="<?php echo $option['img'] ?>" value="<?php echo $option['idcar'] ?>" data-price="<?php echo $option['cena']; ?>"> <?php echo $option['marka'] . " " . $option['model']; ?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <label for="car">Wybierz auto:</label>
                            </div>
                            <div class="form-floating m-3 text-dark">
                                <input type="text" class="form-control" id="cena" name="cena" required disabled value="....">
                                <label for="cena">Cena</label>
                                <small id="nameHelp" class="form-text">Cena za 24H wynajmu</small>
                            </div>

                            <div class="form-floating m-3 text-dark">
                                <input type="text" class="form-control" id="email" name="email" required>
                                <label for="name">Email</label>
                                <small id="nameHelp" class="form-text">Email musi nie istnieć w bazie i być w formacie example@example.com</small>
                            </div>
                            <?php
                            if(isset($_SESSION['error_email'])) {
                            echo '<div class="error" id="error_email">' .$_SESSION['error_email'] . '</div>';
                            unset($_SESSION['error_email']);
                            }
                            ?>


                            <div class="form-floating m-3 text-dark">
                                <input type="text" class="form-control" id="name" name="name" pattern="[A-Za-z-ząćęłńóśźżĄĆĘŁŃÓŚŹŻ]{3,20}" required>
                                <label for="name">Imię</label>
                                <small id="nameHelp" class="form-text">Imie musi zawierać przynajmniej 3 znaki.</small>
                            </div>
                            <?php
                            if(isset($_SESSION['error_imie'])) {
                            echo '<div class="error" id="error_imie">' .$_SESSION['error_imie'] . '</div>';
                            unset($_SESSION['error_imie']);
                            }
                            ?>


                            <div class="form-floating m-3 text-dark">
                                <input type="text" class="form-control" id="nazwisko" name="nazwisko" pattern="[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]{3,20}" required>
                                <label for="nazwisko">Nazwisko</label>
                                <small id="nazwiskoHelp" class="form-text">Nazwisko musi zawierać przynajmniej 3 znaki.</small>
                            </div>
                            <?php
                            if(isset($_SESSION['error_nazwisko'])) {
                            echo '<div class="error" id="error_nazwisko">' .$_SESSION['error_nazwisko'] . '</div>';
                            unset($_SESSION['error_nazwisko']);
                            }
                            ?>

                            <div class="form-floating m-3 text-dark">
                                <input type="text" class="form-control" id="telefon" name="telefon" pattern="[0-9]{9}" required>
                                <label for="telefon">Nr. telefonu</label>
                                <small id="telefonHelp" class="form-text">Numer telefonu musi mieć 9 cyfr.</small>
                            </div>
                            <?php
                            if(isset($_SESSION['error_tel'])) {
                            echo '<div class="error" id="error_tel">' .$_SESSION['error_tel'] . '</div>';
                            unset($_SESSION['error_tel']);
                            }
                            ?>

                            <div class="form-floating m-3 text-dark">
                                <input type="text" class="form-control" id="miasto" pattern="[A-Za-z]{3,20}" name="miasto" required>
                                <label for="miasto">Miasto</label>
                                <small id="miastoHelp" class="form-text">Miasto musi zawierać przynajmniej 3 znaki.</small>
                            </div>
                            <?php
                            if(isset($_SESSION['error_miasto'])) {
                            echo '<div class="error" id="error_miasto">' .$_SESSION['error_miasto'] . '</div>';
                            unset($_SESSION['error_miasto']);
                            }
                            ?>

                            <div class="form-floating m-3 text-dark">
                                <input type="text" class="form-control" id="ulica" name="ulica" pattern="(?!\.)(?!(0))[A-Za-ząćęłńóśźżĄĆĘŁŃÓŚŹŻ0-9.-]{3,20}" required>
                                <label for="ulica">Ulica</label>
                                <small id="ulicaHelp" class="form-text">Ulica musi zawierać przynajmniej 3 znaki.</small>
                            </div>
                            <?php
                            if(isset($_SESSION['error_ulica'])) {
                            echo '<div class="error" id="error_ulica">' .$_SESSION['error_ulica'] . '</div>';
                            unset($_SESSION['error_ulica']);
                            }
                            ?>

                            <div class="form-floating m-3 text-dark">
                                <input type="text" class="form-control" id="numer" name="numer" pattern="(?!(0))[0-9A-Za-z/]{1,7}" required>
                                <label for="numer">Lokal</label>
                                <small id="numerHelp" class="form-text">Podaj numer lokalu np. '10B/12', '10'</small>
                            </div>
                            <?php
                            if(isset($_SESSION['error_lokal'])) {
                            echo '<div class="error" id="error_lokal">' .$_SESSION['error_lokal'] . '</div>';
                            unset($_SESSION['error_lokal']);
                            }
                            ?>

                            <div class="form-floating m-3 text-dark">
                                <input type="text" class="form-control" id="prawojazdy" name="prawojazdy" pattern="(?!\.)[0-9]{5}/[0-9]{2}/[0-9]{4}" required>
                                <label for="prawojazdy">Nr. prawa jazdy</label>
                                <small id="prawojazdyHelp" class="form-text">Numer prawa jazdy musi składać się z 11 znaków i wygląda nastepująco 12345/12/1234</small>
                            </div>
                            <?php
                            if(isset($_SESSION['error_prawko'])) {
                            echo '<div class="error" id="error_prawko">' .$_SESSION['error_prawko'] . '</div>';
                            unset($_SESSION['error_prawko']);
                            }
                            ?>


                            <div class="form-floating m-3 text-dark">
                                <input type="date" name="dataod" id="dataod" class="form-control" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" min="<?php echo date('Y-m-d'); ?>">
                                <label for="dataod">Rezerwacja od:</label>
                            </div>

                            <div class="form-floating m-3 text-dark">
                                <input type="date" class="form-control" id="datado" name="datado" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" min="<?php echo date('Y-m-d'); ?>">
                                <label for="datado">rezerwacja do:</label>
                            </div>
                            <?php
                            if(isset($_SESSION['error_zajety'])) {
                            echo '<div class="error" id="error_zajety">' .$_SESSION['error_zajety'] . '</div>';
                            unset($_SESSION['error_zajety']);
                            }
                            if(isset($_SESSION['error_data'])) {
                            echo '<div class="error" id="error_data">' .$_SESSION['error_data'] . '</div>';
                            unset($_SESSION['error_data']);
                            }
                            if(isset($_SESSION['error_koniec'])) {
                            echo '<div class="error" id="error_koniec">' .$_SESSION['error_koniec'] . '</div>';
                            unset($_SESSION['error_koniec']);
                            }
                            if(isset($_SESSION['error_uzytkownik'])) {
                                echo '<div class="error" id="error_uzytkownik">' .$_SESSION['error_uzytkownik'] . '</div>';
                                unset($_SESSION['error_uzytkownik']);
                            }
                            ?>

                            <input class="w-50 btn btn-lg btn-warning m-md-3" type="submit" name="submit" value="Dodaj rezerwację"></input>
                        </form>
                        <?php
                        if (isset($_SESSION['error_data'])) {
                            echo '<div class="alert alert-danger mt-3" role="alert">';
                            echo $_SESSION['error_data'];
                            unset($_SESSION['error_data']);
                            echo '</div>';
                        }
                        ?>



                        <script>
                            const inputs = document.querySelectorAll('input');
                            const areas = document.querySelectorAll('textarea');

                            const patterns = {

                                email: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i,
                                name: /^[A-Za-z-ząćęłńóśźżĄĆĘŁŃÓŚŹŻ]{3,50}$/i,
                                nazwisko: /^[A-Za-z-ząćęłńóśźżĄĆĘŁŃÓŚŹŻ]{3,50}$/i,
                                telefon: /^[0-9]{9}$/i,
                                miasto: /^[A-Za-z-ząćęłńóśźżĄĆĘŁŃÓŚŹŻ]{3,50}$/i,
                                ulica: /^[A-Za-z-ząćęłńóśźżĄĆĘŁŃÓŚŹŻ]{3,50}$/i,
                                numer: /^[0-9]{1,4}$/i,
                                prawojazdy: /^(?!\.)[0-9]{5}\/[0-9]{2}\/[0-9]{4}$/i,
                                marka: /^[A-Za-z0-9]{2,50}$/i,
                                model: /^[A-Za-z0-9]{2,50}$/i,
                                opis: /^[A-Za-ząćęłńóśźżĄĆĘŁŃÓŚŹŻ0-9 ]{3,}$/i
                            };

                            inputs.forEach((input) => {
                                input.addEventListener('keyup', (e) => {
                                    validate(e.target, patterns[e.target.attributes.id.value]);
                                });
                            });

                            areas.forEach((textarea) => {
                                textarea.addEventListener('keyup', (e) => {
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

                            function submitForm(form) {
                                swal({
                                        title: "Potwierdź operację",
                                        text: "Czy jesteś pewien że chcesz dodać rezerwację?",
                                        icon: "warning",
                                        buttons: true,
                                        dangerMode: true,
                                    })
                                    .then(function(isOkay) {
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
<?php endif; ?>