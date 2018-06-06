<?php
	include("../../config.php");

	if (isset($_POST['update_button'])) {
	      if ($con->connect_error) {
	        die("Az adatbázis nem elérhető: " . $conn->connect_error);
	      } 

	      $myid = mysqli_real_escape_string($con, $_GET['id']);;
	      $new_standard = mysqli_real_escape_string($con, $_POST['standard']);
	      $new_ejtes = mysqli_real_escape_string($con, $_POST['ejtes']);
	      $new_terkepszam = mysqli_real_escape_string($con, $_POST['terkepszam']);
	      $new_ragosalak = mysqli_real_escape_string($con, $_POST['ragosalak']);
	      $new_forrasmunkaadat = mysqli_real_escape_string($con, $_POST['forrasmunkaadat']);
	      $new_forrasmunkaev = mysqli_real_escape_string($con, $_POST['forrasmunkaev']);
	      $new_forrasmunkatipus = mysqli_real_escape_string($con, $_POST['forrasmunkatipus']);
	      $new_objektuminfo = mysqli_real_escape_string($con, $_POST['objektuminfo']);
	      $new_helyinfo = mysqli_real_escape_string($con, $_POST['helyinfo']);
	      $new_nevvaltozatok = mysqli_real_escape_string($con, $_POST['nevvaltozatok']);


	      $sql = "UPDATE helynev 
	          	  SET Standard = '$new_standard',
	          	   Ejtes = '$new_ejtes',
	          	   Terkepszam = '$new_terkepszam',
	          	   Ragos_Alak = '$new_ragosalak',
	          	   Forras_Adat = '$new_forrasmunkaadat',
	          	   Forras_Ev = '$new_forrasmunkaev',
	          	   Forras_Tipus = '$new_forrasmunkatipus',
	          	   Objektum_Info = '$new_objektuminfo',
	          	   Nev_Info = '$new_helyinfo',
	          	   Nevvarians = '$new_nevvaltozatok'

	              WHERE ID = '$myid'";
	      
	      mysqli_query($con, $sql);

      	  header("location: helynevek_show.php");
	} else if (isset($_POST['delete_button'])) {
    	  if ($con->connect_error) {
	        die("Az adatbázis nem elérhető: " . $conn->connect_error);
	      }

	      $myid = mysqli_real_escape_string($con, $_GET['id']);;

	      $sql = "DELETE FROM helynev 
	              WHERE ID = '$myid'";
	      
	      mysqli_query($con, $sql);

      	  header("location: helynevek_show.php");
	} else if (isset($_POST['back_button'])) {
    	  header("location: helynevek_show.php");
	} else {
    //no button pressed
	}

	$query = "SELECT
            helynev.ID, 
            Standard,
            telepules.Nev as joinTelepules,
            Ejtes,
            helyfajta.Nev as joinHelyfajta,
            Terkepszam,
            Ragos_Alak,
            nyelv.Nev as joinNyelv,
            Forras_Adat,
            Forras_Ev,
            Forras_Tipus,
            Objektum_Info,
            Nev_Info,
            Nevvarians
            FROM `helynev` 
            INNER JOIN `telepules` ON `helynev`.Telepules=`telepules`.ID
            INNER JOIN `helyfajta` ON `helynev`.Helyfajta=`helyfajta`.ID
            INNER JOIN `nyelv` ON `helynev`.Nyelv=`nyelv`.ID
            WHERE `helynev`.ID=".$_GET["id"];
  mysqli_query($con, $query);
  $result=mysqli_query($con,$query) or die('hiba');
  $row=mysqli_fetch_array($result);

  $id=$row['ID'];
  $standard=$row['Standard'];
  $ejtes=$row['Ejtes'];
  $telepules=$row['joinTelepules'];
  $helyfajta=$row['joinHelyfajta'];
  $terkepszam=$row['Terkepszam'];
  $ragos_alak=$row['Ragos_Alak'];
  $nyelv=$row['joinNyelv'];
  $forras_adat=$row['Forras_Adat'];
  $forras_ev=$row['Forras_Ev'];
  $forras_tipus=$row['Forras_Tipus'];
  $objektum_info=$row['Objektum_Info'];
  $nev_info=$row['Nev_Info'];
  $nevvarians=$row['Nevvarians'];

?>

<!DOCTYPE html>
<html>
<?php
	include('../../navbar_lvl1.php');
?>
<head>
	<title>Törlés</title>
	<link rel="stylesheet" type="text/css" href="../mainpage.css">
	<link rel="stylesheet" type="text/css" href="../../css/helynevek_show.css">
</head>
<body>
	<div id="container">
		<br><br>
		<div id="item">
		<form action = "" method = "post">
		      <label id="smallLabel">Standard:</label><input type = "text" name = "standard" class="inputfield" value="<?php if(isset($standard)) echo $standard; ?>"/>
			  <br>
			    
			  <label id="smallLabel">Település:</label><input type = "text" name = "telepules" class="inputfield" value="<?php if(isset($telepules)) echo $telepules; ?>" disabled/>
			  <br>
			  <label id="smallLabel">Ejtés:</label><input type = "text" name = "ejtes" class="inputfield" value="<?php if(isset($ejtes)) echo $ejtes; ?>"/>
			  <br>
			  <label id="smallLabel">Helyfajta:</label>
			  <select name="helyfajta">
			  	<?php
				    $query = "SELECT * FROM `helyfajta`";
				      		/*WHERE Is_Active=1";*/
					mysqli_query($con, $query);
					$result=mysqli_query($con,$query) or die('hiba');

					while($row=mysqli_fetch_array($result)){
					    $id=$row['ID'];
		                $helyfajta_option=$row['Nev'];
		                $kod=$row['Kod'];

						$bold="none";

		               	if (strpos($kod, '.') == false) {
						    $bold="boldoption";
						}

						if($helyfajta_option==$helyfajta){
		                	echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$helyfajta_option."</option>";
		                }
		                else{
							echo "<option class='$bold' value=".$id.">".$kod." ".$helyfajta_option."</option>";
						}
					}

				?>
				</select>
			  <br>
			  <label id="smallLabel">Térképszám:</label><input type = "text" name = "terkepszam" class="inputfield" value="<?php if(isset($terkepszam)) echo $terkepszam; ?>"/>
			  <br>
			  <label id="smallLabel">Ragos alak:</label><input type = "text" name = "ragosalak" class="inputfield" value="<?php if(isset($ragos_alak)) echo $ragos_alak; ?>"/>
			  <br>
			  <label id="smallLabel">Nyelv:</label>
			  <select name="nyelv">
			  	<?php
				    $query = "SELECT * FROM `nyelv`";
				      		/*WHERE Is_Active=1";*/
					mysqli_query($con, $query);
					$result=mysqli_query($con,$query) or die('hiba');

					while($row=mysqli_fetch_array($result)){
					    $id=$row['ID'];
		                $nyelv_option=$row['Nev'];

		                if($nyelv_option==$nyelv){
		                	echo "<option selected='selected' value=".$id.">".$nyelv_option."</option>";
		                }
		                else{
							echo "<option value=".$id.">".$nyelv_option."</option>";
						}
					}

            		mysqli_close($con);

				?>
			  </select>
			  <br>
			  <label id="smallLabel">Forrás adat:</label><input type = "text" name = "forrasmunkaadat" class="inputfield" value="<?php if(isset($forras_adat)) echo $forras_adat; ?>"/>
			  <br>
			  <label id="smallLabel">Forrás év:</label><input type = "text" name = "forrasmunkaev" class="inputfield" value="<?php if(isset($forras_ev)) echo $forras_ev; ?>"/>
			  <br>
			  <label id="smallLabel">Forrás típus:</label><input type = "text" name = "forrasmunkatipus" class="inputfield" value="<?php if(isset($forras_tipus)) echo $forras_tipus; ?>"/>
			  <br>
			  <label id="smallLabel">Objektum info:</label><input type = "text" name = "objektuminfo" class="inputfield" value="<?php if(isset($objektum_info)) echo $objektum_info; ?>"/>
			  <br>
			  <label id="smallLabel">Név info:</label><input type = "text" name = "helyinfo" class="inputfield" value="<?php if(isset($nev_info)) echo $nev_info; ?>"/>
			  <br>
			  <label id="smallLabel">Névváltozatok:</label><input type = "text" name = "nevvaltozatok" value="<?php if(isset($nevvarians)) echo $nevvarians; ?>"/>
			  <br>

			  <br>
		      <input id="btn" type = "submit"  name="update_button" value = " Módosítás "/>
		      <input id="btn" type = "submit"  name="delete_button" value = " Törlés "/>
			  <br><br>
			  <input id="btn" type = "submit"  name="back_button" value = " Vissza "/>
		   </form>
		   </div>
	    <br>
	    <br>
	</div>
</body>
</html>