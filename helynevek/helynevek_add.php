<?php
   include("../config.php");
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
	  $mytelepules = mysqli_real_escape_string($con,$_POST['telepules']);
	  $mystandard = mysqli_real_escape_string($con,$_POST['standard']);
	  $myejtes = mysqli_real_escape_string($con,$_POST['ejtes']);
	  $myhelyfajta = mysqli_real_escape_string($con,$_POST['helyfajta']);
	  $myterkepszam = mysqli_real_escape_string($con,$_POST['terkepszam']);
	  $myragosalak = mysqli_real_escape_string($con,$_POST['ragosalak']);
	  $mynyelv = mysqli_real_escape_string($con,$_POST['nyelv']);
	  $myforrasmunkaadat = mysqli_real_escape_string($con,$_POST['forrasmunkaadat']);
	  $myforrasmunkaev = mysqli_real_escape_string($con,$_POST['forrasmunkaev']);
	  $myforrasmunkatipus = mysqli_real_escape_string($con,$_POST['forrasmunkatipus']);
      $myobjektuminfo = mysqli_real_escape_string($con,$_POST['objektuminfo']);
      $myhelyinfo = mysqli_real_escape_string($con,$_POST['helyinfo']);
      $mynevvaltozatok = mysqli_real_escape_string($con,$_POST['nevvaltozatok']);

	  $query = "INSERT INTO helynev(`Standard`, `Telepules`,`Ejtes`,`Helyfajta`,`Terkepszam`,`Ragos_Alak`,`Nyelv`,`Forras_Adat`,`Forras_Ev`,`Forras_Tipus`,`Objektum_Info`,`Nev_Info`,`Nevvarians`) 
	  VALUES ('$mystandard', '$mytelepules', '$myejtes','$myhelyfajta','$myterkepszam','$myragosalak','$mynyelv','$myforrasmunkaadat','$myforrasmunkaev','$myforrasmunkatipus','$myobjektuminfo','$myhelyinfo','$mynevvaltozatok')";

	  $result=mysqli_query($con,$query) or die('hiba');

	  mysqli_close($con);
	  header("location: helynevek_add.php");

   }
?>
<!DOCTYPE html>
<html>
<?php
	include('../navbar_lvl1.php');
?>
<head>
	<title>Helynevek</title>
	<link rel="stylesheet" type="text/css" href="helynevek_show.css">
	<link rel="stylesheet" type="text/css" href="../mainpage.css">

</head>
<body>
	<div id="container">

		<br>
		<br>
		<div id="item">
			<form action = "" method = "post">
		      <label>Standardizált helynév:</label><input type = "text" name = "standard" class="inputfield"/>
			  <br>
			    
			  <label>Település:</label>
			  <select name="telepules">
			  	<?php
				    $query = "SELECT * FROM `telepules`";
				      		/*WHERE Is_Active=1";*/
					mysqli_query($con, $query);
					$result=mysqli_query($con,$query) or die('hiba');

					while($row=mysqli_fetch_array($result)){
					    $id=$row['ID'];
		                $megye=$row['Nev'];

						echo "<option value=".$id.">".$megye."</option>";
					}

				?>
				</select>
			  <br>
			  <label>Ejtés:</label><input type = "text" name = "ejtes" class="inputfield"/>
			  <br>
			  <label>Helyfajta:</label>
			  <select name="helyfajta">
			  	<?php
				    $query = "SELECT * FROM `helyfajta`";
				      		/*WHERE Is_Active=1";*/
					mysqli_query($con, $query);
					$result=mysqli_query($con,$query) or die('hiba');

					while($row=mysqli_fetch_array($result)){
					    $id=$row['ID'];
		                $nev=$row['Nev'];
		                $kod=$row['Kod'];

		                $bold="none";

		               	if (strpos($kod, '.') == false) {
						    $bold="boldoption";
						}

						echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
					}

				?>
				</select>
			  <br>
			  <label>Térképszám:</label><input type = "text" name = "terkepszam" class="inputfield"/>
			  <br>
			  <label>Ragos alak:</label><input type = "text" name = "ragosalak" class="inputfield"/>
			  <br>
			  <label>Nyelv:</label>
			  <select name="nyelv">
			  	<?php
				    $query = "SELECT * FROM `nyelv`";
				      		/*WHERE Is_Active=1";*/
					mysqli_query($con, $query);
					$result=mysqli_query($con,$query) or die('hiba');

					while($row=mysqli_fetch_array($result)){
					    $id=$row['ID'];
		                $megye=$row['Nev'];

						echo "<option value=".$id.">".$megye."</option>";
					}

            		mysqli_close($con);

				?>
			  </select>
			  <br>
			  <label>Forrásmunka adat:</label><input type = "text" name = "forrasmunkaadat" class="inputfield"/>
			  <br>
			  <label>Forrásmunka év:</label><input type = "text" name = "forrasmunkaev" class="inputfield"/>
			  <br>
			  <label>Forrásmunka típus/év:</label><input type = "text" name = "forrasmunkatipus" class="inputfield" />
			  <br>
			  <label>Objektum info:</label><input type = "text" name = "objektuminfo" class="inputfield" />
			  <br>
			  <label>Név info:</label><input type = "text" name = "helyinfo" class="inputfield"/>
			  <br>
			  <label>Névváltozatok:</label><input type = "text" name = "nevvaltozatok"/>
			  <br>

			  <br>
		      <input id="btn" type = "submit" value = " Hozzáad "/>
			  <br>
		   </form>
	   </div>
	   <br><br>
	   <div id="menuOption"><input id="btn" type="button" value="Vissza"  onclick="window.location.href='./helynevek_menu.php'">
        </div>
	   <br>
	   <br>
   </div>
</body>
</html>