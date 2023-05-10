<?php
session_start();
if(empty($_SESSION['resOK']) || empty($_SESSION['zalogowany']))
{
  header('Location:userDash.php');
}
?>
<?php

              include("deleteok.php");
              require_once "connect.php";
              $idreservation=$_POST['idreservation'];
              $connect = new mysqli($host, $db_user, $db_pass, $db_name);
              if(isset($_POST['idreservation'])) {
              $sql = "DELETE FROM reservation WHERE idreservation = $idreservation";
              $connect->query($sql); 
              unset($_SESSION['resOK']);
            }
?>