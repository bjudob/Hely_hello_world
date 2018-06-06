<!DOCTYPE html>
<html>
<?php
    include('../../navbar_lvl1.php');
?>

<head>
	<title>Települések</title>
    <link rel="stylesheet" type="text/css" href="../../css/telepulesek.css">
    <link rel="stylesheet" type="text/css" href="../../css/mainpage.css">
</head>
<body>
    <div id="container">
        <div id="title">Települések</div>
        <br>
        <br>
		<table>
        <thead>
        <tr>
            <th colspan="2">Település</th>
            <th>Megye</th>
			<th>Tájegység</th>
			<th>Típus</th>
			<th>Nyelv</th>
            <th> </th>
        </tr>
        </thead>
        <tbody>
		<?php
    		include("../../config.php");
            mysqli_set_charset($con,"UTF8");
    		if(!$con){
                die('Az adatbázis nem elérhető!');
            }
            $query="SELECT 
			
					telepules.ID as id,
					telepules.Nev as nev,
					megye.Nev as megye,
					tajegyseg.Nev as tajegyseg,
					telepulestipus.Nev as telepulestipus,
					nyelv.Nev as nyelv
					
					FROM telepules
					INNER JOIN megye ON megye.ID=telepules.Megye
					INNER JOIN tajegyseg ON tajegyseg.ID=telepules.Tajegyseg
					INNER JOIN telepulestipus ON telepulestipus.ID=telepules.Telepules_Tipus
					INNER JOIN nyelv ON nyelv.ID=telepules.Nyelv";
            $result=mysqli_query($con,$query) or die('Hiba tortent');
           
            while($row=mysqli_fetch_array($result)){
                $nev=$row['nev'];
                $megye=$row['megye'];
				$tajegyseg=$row['tajegyseg'];
				$tipus=$row['telepulestipus'];
				$nyelv=$row['nyelv'];
				
				echo '<tr>';
                echo '<td colspan="2">';
                echo $nev;
                echo '</td>';
                echo '<td>';
                echo $megye;
                echo '</td>';
				echo '<td>';
                echo $tajegyseg;
                echo '</td>';
				echo '<td>';
                echo $tipus;
                echo '</td>';
				echo '<td>';
                echo $nyelv;
                echo '</td>';
                echo "<td><a href='./telepulesek_details.php?id=".$row['id']."'>Módosítás</a></td>";
				echo '</tr>';
            }

            mysqli_close($con);
	    ?>
        </tbody>
		</table>
        <br>
        <div id="menuOption"><input id="btn" type="button" value="Vissza"       onclick="window.location.href='./telepulesek_menu.php'">
        </div>
        <br>
    </div>


</body>
</html>