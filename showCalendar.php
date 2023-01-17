<?php
$idcar = 1;
include 'Calendar.php';
$calendar = new Calendar(date("Y-m-d"));
require_once "connect.php";
$connect = new mysqli($host, $db_user, $db_pass, $db_name);
$sql = "SELECT data_start, ile_dni FROM reservation where idcar = $idcar";
$result = mysqli_query($connect, $sql);
while ($pole = $result->fetch_assoc()) {
    $calendar->add_event('Zajety', $pole['data_start'], $pole['ile_dni']);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Event Calendar</title>
		<link href="calendar.css" rel="stylesheet" type="text/css">
        <link href="showCalendar.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	    <nav class="navtop">
	    	<div>
	    		<h1>Event Calendar</h1>
	    	</div>
	    </nav>
		<div class="content home">
			<?=$calendar?>
		</div>
	</body>
</html>