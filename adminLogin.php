<?php
session_start();
require_once "connect.php";
$poloczenie = new mysqli($host, $db_user, $db_pass, $db_name);
if (isset($_POST['email'])) {
    if ($poloczenie->connect_errno != 0) {
        echo "Error: " . $poloczenie->connect_errno . " Opis: " . $poloczenie->connect_error;
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * from user where email='$email' AND password='$password'";

        if ($rezultat = @$poloczenie->query($sql)) {
            $zalogowane = $rezultat->num_rows;
            if ($zalogowane > 0) {
                $sql2 = mysqli_query($poloczenie,"SELECT status FROM user WHERE email='$email'");
                while ($row = mysqli_fetch_array($sql2)) {
                    $_SESSION['admin'] = true;
                    $_SESSION['admin'] = $row['status'];
                }
                $rezultat->free_result();
                header('Location:adminDash.php');
            } else {
                $_SESSION['blad_admin'] = 'Nieprawidłowy login lub hasło do panelu administratora';
                header('Location: admin.php');
            }
        }
        $poloczenie->close();
    }
}
?>