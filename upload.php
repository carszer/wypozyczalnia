<?php 

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
	require_once "connect.php";
    $connect = new mysqli($host, $db_user, $db_pass, $db_name);

	
    $nrrejestracyjny = $_POST['nrrejestracyjny'];
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $pojemnosc = $_POST['pojemnosc'];
    $moc = $_POST['moc'];
    $moment = $_POST['moment'];
    $opis = $_POST['opis'];
    $cena = $_POST['cena'];

    print_r($_FILES['my_image']);
    $img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];


	if (isset($_POST['marka'])) {

		$nrRej = $_POST['nrrejestracyjny'];
		$rejIstnieje = $connect->query("SELECT idcar FROM car WHERE nrrejestracyjny = '$nrRej'");
		$rejestracja = $rejIstnieje->num_rows;
		if ($rejestracja > 0) {
			$em = "Nr. rejestracyjny już istnieje w bazie!!";
			header("Location: dodawanieAut.php?error=$em");
		}
	}


	if ($error === 0) {
		if ($img_size > 3000000) {
			$em = "Zbyt duży rozmiar pliku";
		    header("Location: dodawanieAut.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("img/IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = $new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

                $sql = "INSERT INTO car(nrrejestracyjny, marka, model, cena, pojemnosc, moc_km, moment, opis, img) 
                VALUES ('$nrrejestracyjny','$marka','$model','$cena','$pojemnosc','$moc','$moment','$opis','$new_img_name')";
				mysqli_query($connect, $sql);
				header("Location: dodawanieAut.php");
			}else {
				$em = "Nieobsługiwany format pliku, wypełnij formularz ponownie";
		        header("Location: dodawanieAut.php?error=$em");
			}
		}
	}else {
		$em = "nwm";
		header("Location: dodawanieAut.php?error=$em");
	}

}else {
	header("Location: dodawanieAut.php");
}