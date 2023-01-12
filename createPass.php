<?php
session_start();
require_once "connect.php";
$poloczenie = new mysqli($host, $db_user, $db_pass, $db_name);
if ($poloczenie->connect_errno != 0) {
  echo "Error: " . $poloczenie->connect_errno . " Opis: " . $poloczenie->connect_error;
} else {

  $email = $_POST['email'];
  $kod = $_POST['kod'];
  $pass1 = $_POST['newpass1'];
  $pass2 = $_POST['newpass2'];
  $sql = "SELECT * from users where kod='$kod'";
  if ($rezultat = @$poloczenie->query($sql)) {
    $zalogowane = $rezultat->num_rows;
    if ($zalogowane > 0) {
      $_SESSION['newPass'] = true;
      unset($_SESSION['error2']);
      if ((strlen($pass1) < 6) || (strlen($pass1) > 16)) {
        $validation = false;
        $_SESSION['error_pass1'] = "Hasło musi składać się z 6 do 16 znaków!";
      } else if ($pass1 != $pass2) {
        $validation = false;
        $_SESSION['error_pass2'] = "Podane hasła są różne!";
      }
      $sql2 = "UPDATE users SET password='$pass1' WHERE email='$email'";
      $rezultat2 = @$poloczenie->query($sql2);
      $rezultat->free_result();
      header('Location:passChangedSuccess.php');
    } else {
      $_SESSION['error2'] = 'źle coś wpisałeś';
      header('Location: changePass.php');
    }
  }
}
?>