<?php
    $conn = mysqli_connect("localhost", "root", "", "portal");
    if (mysqli_connect_errno()) {
        echo "Connnection failed: " . mysqli_connect_error();
    }
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    function log(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = test_input($_POST["email"]);
            $password = test_input($_POST["password"]);
        }
        if (mysqli_query($conn, 'SELECT haslo from uzytkownicy where login = "' . $login . '";')) {
            $q3 = mysqli_query($conn, 'SELECT haslo from uzytkownicy where login = "' . $login . '";');
            if (mysqli_num_rows($q3) > 0) {
                $row = mysqli_fetch_assoc($q3);
                $haslo = $row['haslo'];
                $hhaslo = sha1($fhaslo);
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