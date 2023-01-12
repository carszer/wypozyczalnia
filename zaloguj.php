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
        $sql = "SELECT * from users where email='$email' AND password='$password'";

        if ($rezultat = @$poloczenie->query($sql)) {
            $zalogowane = $rezultat->num_rows;
            if ($zalogowane > 0) {
                $_SESSION['zalogowany'] = true;
                unset($_SESSION['blad']);
                $rezultat->free_result();
                header('Location:userIndex.php');

            } else {
                $_SESSION['blad'] = 'Nieprawidłowy login lub hasło!!!';
                header('Location: loginForm.php');

            }
        }
        $poloczenie->close();
    }
}
?>