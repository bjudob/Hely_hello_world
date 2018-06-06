
<!DOCTYPE html>
<html>
<?php
	include('../../navbar_lvl1.php');
?>
<head>
	<title>Tájegységek</title>
	<link rel="stylesheet" type="text/css" href="../../css/mainpage.css">

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>   


</head>
<body>
	<div id="container">
		<br><br>
		<div id="title">Statisztika</div>

		<br><br><br><br>

		<div id="menuOption">
		<input id="btn" type="button" value="Adatmennyiségek megtekintése" onclick="window.location.href='./statisztika_show.php'">
		</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Adatmennyiség tájegységek szerint" onclick="window.location.href='./statisztika_adatok_tajegysegenkent.php'">
		</div>
		<br>
	</div>

</body>
</html>