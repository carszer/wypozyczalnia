<?php
session_start();
?>
<?php if(empty($_SESSION['admin'])):{
   header('Location: admin.php');
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
  <title>CarSzer_registerSucess</title>
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
  <header>
  <?php if(isset($_SESSION['zalogowany'])):{
          include("userNav.php");
      }?>
      <?php endif;?>
    <!-- Fixed navbar -->
  <main>
    <div class="position-relative overflow-hidden p-3 p-md-5  text-center bg-dark bg-gradient">
      <div class="col-md-5 p-lg-5 mx-auto my-5 ">
        <form method="POST">
          <img class="mb-4" src="img/matiz.png" alt="" width="150">
          <h1 class="h1 mb-5 fw-light text-light m-3">Samochód został zarezerwowany!</h1>
          <p1 class="p1 mb-5 fw-light text-light m-3">Zobacz rezerwacje klikając przycisk poniżej</p>
          <button type="button" class="w-50 btn btn-lg btn-warning" onclick="window.location='adminDash.php'">Moje rezerwacje</button>
          <p class="mt-5 mb-3 text-muted">&copy; 2022–2023</p>
        </form>
      </div>
      <div class="product-device shadow-sm d-none d-md-block"></div>
      <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>

    </div>
  </main>
  <!-- Remove the container if you want to extend the Footer to full width. -->

  <!-- Footer -->
  <!-- Stopka -->
  <?php include("footer.php"); ?>


  <!-- End of .container -->
</body>
</html>
<?php endif;?>