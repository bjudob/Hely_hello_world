<?php
   include('session.php');
?>
<!DOCTYPE html>
<html>

<head>
	<title>Helynevek</title>
	<link rel="stylesheet" type="text/css" href="mainpage.css">

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>   


</head>
<body>
	<div id="container">
		<br><br>
		<div id="title">Üdvözöljük a helynév adatbázis adminisztrátor oldalán, <?php echo $login_session ?> </div>!</div>
		<br><br><br><br>

		<div id="menuOption">
		<input id="btn" type="button" value="Helynevek kezelése" onclick="window.location.href='./helynevek/helynevek_menu.php'">
		</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Tájegységek kezelése" onclick="window.location.href='./tajegysegek/tajegysegek_menu.php'">
		</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Települések kezelése" onclick="window.location.href='./telepulesek/telepulesek_menu.php'">
		</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Statisztika" onclick="window.location.href='./helynevek/helynevek_menu.php'">
		</div>
		<br>
		<div id="menuOption">
		<input id="btn" type="button" value="Kilépés" onclick="window.location.href='./helynevek/helynevek_menu.php'">
		</div>
		<br>
	</div>

</body>
</html>