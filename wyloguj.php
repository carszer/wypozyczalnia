<?php
session_start();
unset($_SESSION['zalogowany']);
unset($_SESSION['admin']);
session_destroy();
header('Location:index.php');
?>