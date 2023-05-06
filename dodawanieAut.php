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

            #opis {
                min-height: 80px;
                max-height: 180px;
            }
        </style>
        <title>CarSzer-Panel administratora</title>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="sweetalert.min.js"></script>


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
                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 text-light">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Panel Administratora | Hi admin</h1>
                    </div>

                    <h2 class="col-md-5 mx-auto text-center">DODAJ POJAZD DO OFERTY</h2>
                    <!--DODAWANIE PRZERWY TECH -->


                    <div class="col-md-5 mx-auto text-center">

                        <form method="post" action="upload.php" enctype="multipart/form-data">
                            <div class="form-floating m-3 text-light">
                                <input type="text" name="nrrejestracyjny" id="nrrejestracyjny" class="form-control" pattern="[A-Z]{2,3}-[A-Z0-9]{4,5}" required>
                                <label for="nrrejestracyjny">Numer rejestracyjny:</label>
                            </div>

                            <div class="form-floating m-3 text-dark">
                                <input type="text" name="marka" id="marka" class="form-control" pattern="[A-Za-z{2,50}" required>
                                <label for="marka">Marka:</label>
                            </div>
                            <div class="form-floating m-3 text-dark">
                                <input type="text" name="model" id="model" class="form-control" pattern="[A-Za-z0-9]{2,50}" required>
                                <label for="model">Model:</label>
                            </div>
                            <div class="form-floating m-3 text-dark">
                                <input type="text" name="pojemnosc" id="pojemnosc" class="form-control" required>
                                <label for="pojemnosc">Pojemnosc cc:</label>
                            </div>
                            <div class="form-floating m-3 text-dark">
                                <input type="text" name="moc" id="moc" class="form-control" required>
                                <label for="moc">Moc KM</label>
                            </div>
                            <div class="form-floating m-3 text-dark">
                                <input type="text" name="moment" id="moment" class="form-control" required>
                                <label for="moment">Moment obrotowy:</label>
                            </div>
                            <div class="form-floating m-3 text-dark">
                                <textarea name="opis" id="opis" class="form-control" required></textarea>
                                <label for="opis">Opis:</label>
                            </div>

                            <div class="form-floating m-3 text-dark">
                                <input type="text" name="cena" id="cena" class="form-control" required>
                                <label for="cena">Cena:</label>
                            </div>



                            <div class="form-floating m-3 text-dark">
                                <input class="btn  btn-dark m-md-3" type="file" id="my_image" name="my_image" class="form-control" accept="image/jpeg" maxlength="1048576" required>
                            </div>
                            <?php if (isset($_GET['error'])) : ?>
                                <p><?php echo $_GET['error']; ?></p>
                            <?php endif ?>

                            <input class="w-50 btn btn-lg btn-warning m-md-3" type="submit" name="submit" value="Dodaj pojazd"></input>
                        </form>
                    </div>

                    <script>
                        const inputs = document.querySelectorAll('input');
                        const areas = document.querySelectorAll('textarea');

                        const patterns = {

                            marka: /^[A-Za-z]{2,20}$/i,
                            model: /^[A-Za-z0-9]{2,50}$/i,
                            pojemnosc: /^[0-9]{3,4}$/,
                            moc: /^[0-9]{1,4}$/,
                            moment: /^[0-9]{1,4}$/,
                            opis: /^[A-Za-z0-9 ]{3,}$/i,
                            cena: /^[0-9. ]{1,9}$/,
                            nrrejestracyjny: /^(?!\.)[A-Z]{2,3}\-[A-Z0-9]{4,5}$/
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
                    </script>

                </main>
            </div>
    </body>
    <!-- Stopka -->
    <?php include("footer.php"); ?>

    </html>
<?php endif; ?>