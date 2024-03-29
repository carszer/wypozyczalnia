<!DOCTYPE html>
<html lang="pl-PL">
<?php

// Google reCAPTCHA API keys settings  
$secretKey = '6LfWsukjAAAAAFxwhV05nJAVi6eFW1K_W9VMBwFs';
$postData = $valErr = $statusMsg = '';
$status = 'error';

// If the form is submitted 
if (isset($_POST['submit'])) {
  // Retrieve value from the form input fields 
  $postData = $_POST;
  $topic = trim($_POST['submit']);
  $email = trim($_POST['email']);
  $message = trim($_POST['message']);

  // Validate input fields  
  if (empty($topic)) {
    $valErr .= 'Please enter your name.<br/>';
  }
  if (empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $valErr .= 'Please enter a valid email.<br/>';
  }
  if (empty($message)) {
    $valErr .= 'Please enter message.<br/>';
  }

  // Check whether submitted input data is valid  
  if (empty($valErr)) {
    // Validate reCAPTCHA response  
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

      // Google reCAPTCHA verification API Request  
      $api_url = 'https://www.google.com/recaptcha/api/siteverify';
      $resq_data = array(
        'secret' => $secretKey,
        'response' => $_POST['g-recaptcha-response'],
        'remoteip' => $_SERVER['REMOTE_ADDR']
      );

      $curlConfig = array(
        CURLOPT_URL => $api_url,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $resq_data
      );

      $ch = curl_init();
      curl_setopt_array($ch, $curlConfig);
      $response = curl_exec($ch);
      curl_close($ch);

      // Decode JSON data of API response in array  
      $responseData = json_decode($response);

      // If the reCAPTCHA API response is valid  
      if ($responseData->success) {
        echo '<script>alert(dziala)</script>';
        $status = 'success';
        $statusMsg = 'Thank you! Your contact request has been submitted successfully.';
        $postData = '';
      } else {
        $statusMsg = 'The reCAPTCHA verification failed, please try again.';
      }
    } else {
      $statusMsg = 'Something went wrong, please try again.';
    }
  } else {
    $valErr = !empty($valErr) ? '<br/>' . trim($valErr, '<br/>') : '';
    $statusMsg = 'Please fill all the mandatory fields:' . $valErr;
  }
}

?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="shortcut icon" href="img/favicon.ico" />
  <style>
    .carousel-inner {
      width: 100%;
    }

    .carousel .carousel-item {
      height: 950px;
    }

    .carousel-item img {
      object-fit: cover;
    }

    .g-recaptcha {
      width: min-content;
    }
  </style>
  <script>
    function onSubmit(token) {
      document.getElementById("contactForm").submit();
    }
  </script>
  <title>CarSzer</title>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
              <a class="nav-link" href="#">O nas</a>
            </li>
          </ul>
          <div class="text-end">
            <button class="btn btn-outline-light me-2" type="button" onclick="window.location='loginForm.php'"
              id="logButton">Zaloguj się</button>
            <!--<a class="btn btn-warning me-2" href="logowanie.php">Zaloguj się</a> -->

            <button class="btn btn-warning" type="button" onclick="window.location='registerForm.php'"
              id="registerButton">Zarejestruj się</button>
            <!--<a class="btn btn-outline-light me-2" href="registerForm.php">Zarejestruj się</a>-->
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <!-- Tittle -->

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://www.tapeteos.pl/data/media/521/big/ferrari_f8_tributo_2020_023.jpg" height="950px"
            class="d-block w-100" alt="...">
          <div class="carousel-caption d-md-block">
            <h5>Fełałi</h5>
            <p>Za drogie żeby wynająć</p>
            <button class="btn btn-outline-dark bg-warning text-dark px-5 rounded" onclick="#">Rezerwuj</button>
          </div>
        </div>
        <div class="carousel-item">
          <img
            src="https://v.wpimg.pl/MzkxMzA0YhsKGjtJbktvDklCbxMoEmFYHlp3WG5_YkxfSDVJeQBiE0UPPVQxXGIbRB5iEDFVKlVYTX1Ddh8pGw4PIhUeXSwOAgJjEDFVKlgW"
            height="950px" class="d-block w-100" alt="...">
          <div class="carousel-caption d-md-block">
            <h5>Dełu matiz</h5>
            <p>Super samochód na rodzinne wyprawy</p>
            <button class="btn btn-outline-dark bg-warning text-dark px-5 rounded" onclick="#">Rezerwuj</button>
          </div>
        </div>
        <div class="carousel-item">
          <img src="https://th.bing.com/th/id/OIP.H7ishNCs4PTUl1nV6fBn7QHaES?pid=ImgDet&rs=1" height="950px"
            class="d-block w-100" alt="...">
          <div class="carousel-caption d-md-block ">
            <h5>Dełu matiz</h5>
            <p>Super samochód na rodzinne wyprawy</p>
            <button class="btn btn-outline-dark bg-warning text-dark px-5 rounded" onclick="#">Rezerwuj</button>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!--   
              <div class="col-md-5 p-lg-5 mx-auto my-5">

          
              <h1 class="display-4 fw-normal " >Tu powinna być karuzela</h1>
              <p class="lead fw-normal">Ale jeszcze nie mam zdjęć</p>
              <a class="btn btn-outline-secondary" href="#">Rezerwację zrobisz później</a>
              </div>
            -->
    <div class="position-relative text-center bg-dark ">
      <div class="col-md-5 p-3 mx-auto">
        <h2 class="fw-light text-white">Jedziemy w drogę?</h2>
        <button class="btn btn-outline-dark bg-warning text-dark px-5 rounded"
          onclick="window.location='oferta.php'">Przeglądaj ofertę</button>
      </div>
    </div>
    <!-- Mapa kontakt -->

    <div class="text-center bg-dark bg-gradient">
      <div class="container-fluid p-5 pb-5">
        <iframe style="filter: invert(90%) hue-rotate(180deg)"
          src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9257.850752069942!2d18.5461962!3d54.5429687!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6144d17db5b3ddb1!2sAkademia%20Marynarki%20Wojennej%20im.%20Bohater%C3%B3w%20Westerplatte!5e0!3m2!1spl!2spl!4v1671020353761!5m2!1spl!2spl"
          width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="col-md-5 pb-3 mx-auto ">
        <p class="h2 text-light fw-light">Skontaktuj sie z nami</p>
      </div>
      <div class="col-md-5 pb-5 mx-auto ">
        <form id="contactForm" action="contactUs.php" method="POST">
          <div class="form-floating m-3">
            <input name="email" type="email" class="form-control bg-light" id="floatingInput" required>
            <label for="floatingInput">Adres E-mail</label>
          </div>
          <div class="form-floating m-3">
            <input name="subject" type="text" class="form-control" id="floatingInput" required>
            <label for="subjectd">Temat</label>
          </div>

          <div class="form-floating m-3">
            <textarea class="form-control" name="message" required></textarea>
            <label for="message">W czym możemy ci pomóc?</label>
          </div>
          <div class="form-floating m-3">
            <div class="mx-auto g-recaptcha" data-sitekey="6LfWsukjAAAAAC2hSiSZOJsf3UeZFMOfmPu21Kae"
              data-callback='onSubmit' data-action='submit'></div>
          </div>
          <button class="w-50 btn btn-lg btn-warning" type="submit" name="submit">Wyślij</button>
        </form>

      </div>
    </div>
  </main>

  <!-- Stopka -->
  <?php include("footer.php"); ?>
</body>

</html>