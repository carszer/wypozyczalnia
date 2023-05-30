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

                        if (!isset($_POST['car'])) {
                            $validation = false;
                            $_SESSION['error_data'] = "Podaj datę rozpoczęcia";
                        }

                        if (!isset($_POST['dataod'])) {
                            $validation = false;
                            $_SESSION['error_data'] = "Podaj datę rozpoczęcia";
                        }

                        if (!isset($_POST['datado'])) {
                            $validation = false;
                            $_SESSION['error_data'] = "Podaj datę zakończenia";
                        }

                        if ($_POST['dataod'] < date('Y-m-d')) {
                            $validation = false;
                            $_SESSION['error_data'] = "Data rozpoczęcia < aktualna";
                        }

                        if ($_POST['dataod'] > $_POST['datado']) {
                            $validation = false;
                            $_SESSION['error_data'] = "Data rozpoczęcia nie może być późniejsza niż data zakończenia";
                        }

                        if ($validation == true) {
                            $datado = $_POST['datado'];
                            $dataod = $_POST['dataod'];
                            $diff = date_diff(date_create($dataod), date_create($datado));
                            $days = $diff->format('%a');
                            $days = intval($days) + 1;
                            $idcar = $_POST['car'];
                            $sql = "INSERT INTO reservation (data_start, data_koniec,ile_dni, idcar, iduser,cena) VALUES ('$dataod','$datado','" . $days . "','$idcar','$iduser',)";
                            mysqli_query($connect, $sql);
                        }
                    }
                    $connect->close();
                    ?>


                    <div class="col-md-5 mx-auto text-center">
                        <img id="imgFrame" class="img-thumbnail" width="" src="<?php echo $options[0]['img']; ?>">
                        <form method="post">
                            <div class="form-floating m-3 text-dark">
                                <select class="form-select text-dark" name="car" id="car" onchange="changeImgAndPrice()" required>
                                    <?php
                                    foreach ($options as $option) {
                                    ?>
                                        <option id="<?php echo $option['img'] ?>" value="<?php echo $option['idcar'] ?>" data-price="<?php echo $option['cena']; ?>"> <?php echo $option['marka'] . " " . $option['model']; ?> </option>
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
                                <input type="text" class="form-control" id="name" name="name" pattern="[A-Za-z]{3,20}" required>
                                <label for="name">Imię</label>
                                <small id="nameHelp" class="form-text">Imie musi zawierać przynajmniej 3 znaki.</small>
                            </div>


                            <div class="form-floating m-3 text-dark">
                                <input type="text" class="form-control" id="nazwisko" name="nazwisko" pattern="[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]{3,20}" required>
                                <label for="nazwisko">Nazwisko</label>
                                <small id="nazwiskoHelp" class="form-text">Nazwisko musi zawierać przynajmniej 3 znaki.</small>
                            </div>

                            <div class="form-floating m-3 text-dark">
                                <input type="text" class="form-control" id="telefon" name="telefon" pattern="[0-9]{9}" required>
                                <label for="telefon">Nr. telefonu</label>
                                <small id="telefonHelp" class="form-text">Numer telefonu musi mieć 9 cyfr.</small>
                            </div>

                            <div class="form-floating m-3 text-dark">
                                <input type="text" class="form-control" id="miasto" pattern="[A-Za-z]{3,20}" name="miasto" required>
                                <label for="miasto">Miasto</label>
                                <small id="miastoHelp" class="form-text">Miasto musi zawierać przynajmniej 3 znaki.</small>
                            </div>

                            <div class="form-floating m-3 text-dark">
                                <input type="text" class="form-control" id="ulica" name="ulica" pattern="(?!\.)(?!(0))[A-Za-ząćęłńóśźżĄĆĘŁŃÓŚŹŻ0-9.-]{3,20}" required>
                                <label for="ulica">Ulica</label>
                                <small id="ulicaHelp" class="form-text">Ulica musi zawierać przynajmniej 3 znaki.</small>
                            </div>

                            <div class="form-floating m-3 text-dark">
                                <input type="text" class="form-control" id="numer" name="numer" pattern="(?!(0))[0-9A-Za-z/]{1,7}" required>
                                <label for="numer">Lokal</label>
                                <small id="numerHelp" class="form-text">Podaj numer lokalu np. '10B/12', '10'</small>
                            </div>

                            <div class="form-floating m-3 text-dark">
                                <input type="text" class="form-control" id="prawojazdy" name="prawojazdy" pattern="(?!\.)[0-9]{5}/[0-9]{2}/[0-9]{4}" required>
                                <label for="prawojazdy">Nr. prawa jazdy</label>
                                <small id="prawojazdyHelp" class="form-text">Numer prawa jazdy musi składać się z 11 znaków i wygląda nastepująco 12345/12/1234</small>
                            </div>


                            <div class="form-floating m-3 text-dark">
                                <input type="date" name="dataod" id="dataod" class="form-control" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" min="<?php echo date('Y-m-d'); ?>">
                                <label for="dataod">Rezerwacja od:</label>
                            </div>

                            <div class="form-floating m-3 text-dark">
                                <input type="date" class="form-control" id="datado" name="datado" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" min="<?php echo date('Y-m-d'); ?>">
                                <label for="datado">rezerwacja do:</label>
                            </div>

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