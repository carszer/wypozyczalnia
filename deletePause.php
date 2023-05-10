<?php
session_start();
if (isset($_SESSION['admin'])) {
  header('Location:adminDashPrzerwaTech.php');
}
?>
<?php
              require_once "connect.php";
              $idreservation=$_POST['idreservation'];
              $connect = new mysqli($host, $db_user, $db_pass, $db_name);
              if(isset($_POST['idreservation'])) {
              $sql = "DELETE FROM reservation WHERE idreservation = $idreservation";
              $connect->query($sql); 
            }
?>