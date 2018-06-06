<?php
	include("../config.php");

	if (isset($_POST['update_button'])) {
	      if ($con->connect_error) {
	        die("Az adatbázis nem elérhető: " . $conn->connect_error);
	      } 

	      $id = mysqli_real_escape_string($con, $_GET['id']);;
	      $new_nev = mysqli_real_escape_string($con, $_POST['nev']);
	      $new_megye = mysqli_real_escape_string($con, $_POST['megye']);
	      $new_tajegyseg = mysqli_real_escape_string($con, $_POST['tajegyseg']);
	      $new_tipus = mysqli_real_escape_string($con, $_POST['telepulestipus']);
	      $new_nyelv = mysqli_real_escape_string($con, $_POST['nyelv']);


	      $sql = "UPDATE telepules 
	          	  SET 
	          	   Nev = '$new_nev',
	          	   Megye = '$new_megye',
	          	   Tajegyseg = '$new_tajegyseg',
	          	   Telepules_Tipus = '$new_tipus',
	          	   Nyelv = '$new_nyelv'
	              WHERE ID = '$id'";
	      
	      mysqli_query($con, $sql) or die("hiba");

      	  header("location: telepulesek_show.php");
	}  else if (isset($_POST['back_button'])) {
    	  header("location: telepulesek_show.php");
	} else {
    //no button pressed
	}

	$query = "SELECT
			telepules.ID,
			telepules.Nev,
			megye.ID as megyeId,
			megye.Nev as megyeNev,
			tajegyseg.ID as tajegysegId,
			tajegyseg.Nev as tajegysegNev,
			nyelv.ID as nyelvId,
			nyelv.Nev as nyelvNev,
			telepulestipus.ID as tipusId,
			telepulestipus.Nev as tipusNev
            FROM `telepules` 
            INNER JOIN `megye` ON `telepules`.Megye=`megye`.ID
            INNER JOIN `tajegyseg` ON `telepules`.Tajegyseg=`tajegyseg`.ID
            INNER JOIN `nyelv` ON `telepules`.Nyelv=`nyelv`.ID 
            INNER JOIN `telepulestipus` ON `telepules`.Telepules_Tipus=`telepulestipus`.ID
            WHERE `telepules`.ID=".$_GET["id"];

  mysqli_query($con, $query);
  $result=mysqli_query($con,$query) or die('hiba1');
  $row=mysqli_fetch_array($result);

  $id=$row['ID'];
  $nev=$row['Nev'];
  $megyeId=$row['megyeId'];
  $megyeNev=$row['megyeNev'];
  $tajegysegId=$row['tajegysegId'];
  $tajegysegNev=$row['tajegysegNev'];
  $nyelvId=$row['nyelvId'];
  $nyelvNev=$row['nyelvNev'];
  $tipusId=$row['tipusId'];
  $tipusNev=$row['tipusNev'];

?>

<!DOCTYPE html>
<html>
<?php
	include('../navbar_lvl1.php');
?>
<head>
	<title>Törlés</title>
	<link rel="stylesheet" type="text/css" href="../mainpage.css">
	<link rel="stylesheet" type="text/css" href="./helynevek_show.css">
</head>
<body>
	<div id="container">
		<br><br>
		<div id="item">
		<form action = "" method = "post">
			  <br>
			  <label id="smallLabel">Név:</label><input type = "text" name = "nev" class="inputfield" value="<?php if(isset($nev)) echo $nev; ?>"/>
			  <br>
			  <label id="smallLabel">Megye:</label>
			  <select name="megye">
			  	<?php
				    $query = "SELECT * FROM `megye`";
				      		/*WHERE Is_Active=1";*/
					mysqli_query($con, $query);
					$result=mysqli_query($con,$query) or die('hiba2');

					while($row=mysqli_fetch_array($result)){
					    $id=$row['ID'];
		                $megye_option=$row['Nev'];

						if($megye_option==$megyeNev){
		                	echo "<option selected='selected' value=".$id.">".$megye_option."</option>";
		                }
		                else{
							echo "<option value=".$id.">".$megye_option."</option>";
						}
					}

				?>
				</select>
			  <br>
			  <label id="smallLabel">Tájegység:</label>
			  <select name="tajegyseg">
			  	<?php
				    $query = "SELECT * FROM `tajegyseg`";
				      		/*WHERE Is_Active=1";*/
					mysqli_query($con, $query);
					$result=mysqli_query($con,$query) or die('hiba2');

					while($row=mysqli_fetch_array($result)){
					    $id=$row['ID'];
		                $tajegyseg_option=$row['Nev'];

						if($tajegyseg_option==$tajegysegNev){
		                	echo "<option selected='selected' value=".$id.">".$tajegyseg_option."</option>";
		                }
		                else{
							echo "<option value=".$id.">".$tajegyseg_option."</option>";
						}
					}

				?>
				</select>
			  <br>
			  <label id="smallLabel">Típus:</label>
			  <select name="telepulestipus">
			  	<?php
				    $query = "SELECT * FROM `telepulestipus`";
				      		/*WHERE Is_Active=1";*/
					mysqli_query($con, $query);
					$result=mysqli_query($con,$query) or die('hiba2');

					while($row=mysqli_fetch_array($result)){
					    $id=$row['ID'];
		                $telepulestipus_option=$row['Nev'];

						if($telepulestipus_option==$tipusNev){
		                	echo "<option selected='selected' value=".$id.">".$telepulestipus_option."</option>";
		                }
		                else{
							echo "<option value=".$id.">".$telepulestipus_option."</option>";
						}
					}

				?>
				</select>
			  <br>
			  <label id="smallLabel">Nyelv:</label>
			  <select name="nyelv">
			  	<?php
				    $query = "SELECT * FROM `nyelv`";
				      		/*WHERE Is_Active=1";*/
					mysqli_query($con, $query);
					$result=mysqli_query($con,$query) or die('hiba2');

					while($row=mysqli_fetch_array($result)){
					    $id=$row['ID'];
		                $nyelv_option=$row['Nev'];

						if($nyelv_option==$nyelvNev){
		                	echo "<option selected='selected' value=".$id.">".$nyelv_option."</option>";
		                }
		                else{
							echo "<option value=".$id.">".$nyelv_option."</option>";
						}
					}

				?>
				</select>
			  <br>
			 

			  <br>
		      <input id="btn" type = "submit"  name="update_button" value = " Módosítás "/>
			  <br><br>
			  <input id="btn" type = "submit"  name="back_button" value = " Vissza "/>
		   </form>
		   </div>
	    <br>
	    <br>
	</div>
</body>
</html>