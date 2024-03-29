<?php
	require ("../../db/HelynevDatabase.php");
   	include("../../config.php");
   
   	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$myname = mysqli_real_escape_string($con,$_POST['nev']);
		$mymegye = mysqli_real_escape_string($con,$_POST['megye']);
		$mytajegyseg = mysqli_real_escape_string($con,$_POST['tajegyseg']);
		$mytipus = mysqli_real_escape_string($con,$_POST['tipus']);
		$mynyelv = mysqli_real_escape_string($con,$_POST['nyelv']);

		$query = "INSERT INTO telepules(`Nev`,`Megye`,`Tajegyseg`,`Telepules_Tipus`,`Nyelv`) VALUES ('$myname','$mymegye','$mytajegyseg','$mytipus','$mynyelv')";
		mysqli_query($con, $query);
		
		mysqli_close($con);

		header("location: telepulesek_show.php");
	}
?>
<!DOCTYPE html>
<html>
<?php
	include('../../navbar_lvl1.php');
?>
<head>
	<title>Települések</title>
	<link rel="stylesheet" type="text/css" href="../../../css/telepulesek.css">
	<link rel="stylesheet" type="text/css" href="../../css/mainpage.css">

</head>
<body>
	<div id="menucontainer">
		<br>
		<br>
		<div style="text-align:center;">
			<form action = "" method = "post" accept-charset="UTF-8">
				<div class="inputrow">
					<label class="inputlabel">Név:</label><input type = "text" name = "nev"/>
					<br>
				</div>
				<div class="inputrow">
					<label class="inputlabel">Megye:</label>
					<select name="megye">
					<?php
						$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
						mysqli_set_charset($con,"UTF8");

						$query = "SELECT * FROM `megye`";
								/*WHERE Is_Active=1";*/
						$result=mysqli_query($con,$query) or die('hiba');

						while($row=mysqli_fetch_array($result)){
							$id=$row['ID'];
							$megye=$row['Nev'];

							
							echo $id.$megye;
							echo "<option value=".$id.">".$megye."</option>";
						}

					?>
					</select>
					<br>
				</div>
				<div class="inputrow">
					<label class="inputlabel">Tájegység:</label>
					<select name="tajegyseg">
						<?php
							$query = "SELECT * FROM `tajegyseg`";
									/*WHERE Is_Active=1";*/
							$result=mysqli_query($con,$query) or die('hiba');

							while($row=mysqli_fetch_array($result)){
								$id=$row['ID'];
								$megye=$row['Nev'];

								
								echo $id.$megye;
								echo "<option value=".$id.">".$megye."</option>";
							}

						?>
						</select>
					<br>
				</div>
				<div class="inputrow">
					<label class="inputlabel">Típus:</label>
					<select name="tipus">
						<?php
							$query = "SELECT * FROM `telepulestipus`";
									/*WHERE Is_Active=1";*/
							$result=mysqli_query($con,$query) or die('hiba');

							while($row=mysqli_fetch_array($result)){
								$id=$row['ID'];
								$megye=$row['Nev'];

								
								echo $id.$megye;
								echo "<option value=".$id.">".$megye."</option>";
							}
						?>
						</select>
					<br>
				</div>
				<div class="inputrow">
					<label class="inputlabel">Nyelv:</label>
					<select name="nyelv">
						<?php
							$query = "SELECT * FROM `nyelv`";
									/*WHERE Is_Active=1";*/
							$result=mysqli_query($con,$query) or die('hiba');

							while($row=mysqli_fetch_array($result)){
								$id=$row['ID'];
								$megye=$row['Nev'];

								
								echo $id.$megye;
								echo "<option value=".$id.">".$megye."</option>";
							}

							mysqli_close($con);

						?>
						</select>
					<br>
				</div>
				<br>
		      <input id="btn" type = "submit" value = " Hozzáad "/>
			  <br>
		   </form>
	   </div>
	   <br>
	   <div id="menuOption"><input id="btn" type="button" value="Vissza"       onclick="window.location.href='telepulesek_menu.php'">
        </div>
	   <br>
	   <br>
   </div>
</body>
</html>