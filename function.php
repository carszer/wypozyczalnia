<?php

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    function log(){
        $conn = mysqli_connect("localhost","root","","portal");
        if(mysqli_connect_errno()) { 
            echo "Connnection failed: ".mysqli_connect_error();
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = test_input($_POST["email"]);
            $password = test_input($_POST["password"]);
        }
        if (mysqli_query($conn, 'SELECT haslo from uzytkownicy where email = "' . $email . '";')) {
            $q3 = mysqli_query($conn, 'SELECT haslo from uzytkownicy where email = "' . $email . '";');
            if (mysqli_num_rows($q3) > 0) {
                $row = mysqli_fetch_assoc($q3);
                $haslo = $row['haslo'];
                $hhaslo = sha1($password);
                if ($haslo == $hhaslo) {

                } else {
                    echo "Nieprawidłowe hasło";
                }
            } else {
                echo "Login nie istnieje";
            }
        }
    }
?>