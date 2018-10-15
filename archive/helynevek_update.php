
<!DOCTYPE html>
<html>
<?php
    include('../../navbar_lvl1.php');
?>
<head>
	<title>Helynevek</title>
    <link rel="stylesheet" type="text/css" href="../../css/helynevek_show.css">
    <link rel="stylesheet" type="text/css" href="../../css/mainpage.css">
</head>
<body>
    <div id="container">
        <div id="title">Helynevek</div>
        <br>
        <br>
        <table>
        <thead>
        <tr>
            <th>Helynevek</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
		<?php
    		include("../../config.php");
            mysqli_set_charset($con,"UTF8");
    		if(!$con){
                die('Az adatbázis nem elérhető!');
            }
            $query="SELECT * 
    			    FROM helynev";
            $result=mysqli_query($con,$query) or die('error');
           
            while($row=mysqli_fetch_array($result)){
                $nev=$row['Standard'];
                $id=$row['ID'];

                echo '<tr>';
                echo '<td>';
                echo $nev;
                echo '</td>';
                echo "<td><a href='update.php?id=".$id."&name=".$nev."'>Átnevez</a></td>";
                echo '</tr>';

            }
            mysqli_close($con);
	    ?>
        </tbody>
        </table>
        <br><br>

        <div id="menuOption"><input id="btn" type="button" value="Vissza"       onclick="window.location.href='./helynevek_menu.php'">
        </div>
        <br>
    </div>


</body>
</html>