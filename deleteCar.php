<?php
session_start();
if (isset($_SESSION['admin'])) {
    header('Location:usuwanieAut.php');
}
?>
<?php
require_once "connect.php";
$idcar = $_POST['car'];
$connect = new mysqli($host, $db_user, $db_pass, $db_name);

if (isset($_POST['car'])) {
    $idcar = $_POST['car'];
    $rezIstnieje = $connect->query("SELECT reservation.idcar FROM reservation INNER JOIN car ON reservation.idcar = $idcar'");
    $rezerwacja = $rezIstnieje->num_rows;
    if ($rezerwacja > 0) {
        $sql1 = "UPDATE car SET visible = 0 WHERE idcar = $idcar";
        $connect->query($sql1);
    } else {
        $sql = "DELETE FROM car WHERE idcar = $idcar";
        $connect->query($sql);
        $connect->close();
    }
}
?>