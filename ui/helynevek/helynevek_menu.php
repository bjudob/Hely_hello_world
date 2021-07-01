
<!DOCTYPE html>
<html>
<?php
	include('../../navbar_lvl1.php');
?>
<head>
	<title>Helynevek</title>
	<link rel="stylesheet" type="text/css" href="../../css/helynevek_show.css">
	<link rel="stylesheet" type="text/css" href="../../css/mainpage.css">

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>


</head>
<body>
	<div id="menucontainer">
		<br><br>
		<div id="title">Helynevek</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Új helynév" onclick="window.location.href='./helynevek_add.php'">
		</div>
		<br>
		<div id="menuOption">
		<form method="post" action="export.php">
			<input type="submit" name="export" id="btn" value="Összes letöltése" />
		</form>
		</div>
		<br><br>
		<div id="subtitle">Helynevek megtekintése</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Település szerint" onclick="window.location.href='./helynevek_show.php'">
		</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Névszerkezettípus szerint" onclick="window.location.href='./helynevek_show_nevszerkezet.php'">
		</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Helyfajta szerint" onclick="window.location.href='./helynevek_show_helyfajta.php'">
		</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Ábécé szerint" onclick="window.location.href='./helynevek_show_abc_all.php'">
		</div>
		<br>

		
	</div>

</body>
</html>