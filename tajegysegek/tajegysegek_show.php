<!DOCTYPE html>
<html>
<?php
    include('../navbar_lvl1.php');
?>
<head>
	<title>Tájegységek</title>
    <link rel="stylesheet" type="text/css" href="../css/tajegysegek.css">
    <link rel="stylesheet" type="text/css" href="../mainpage.css">
</head>
<body>
    <div id="container">
        <div id="title">Tájegységek</div>
        <br>
        <br>
        <table>
        <thead>
        <tr>
            <th>Tájegység</th>
        </tr>
        </thead>
        <tbody>
    		<?php
        		include("../config.php");

                $query="SELECT * 
        			    FROM tajegyseg";
                $result=mysqli_query($con,$query) or die('Hiba tortent');
               
                while($row=mysqli_fetch_array($result)){
                    $nev=$row['Nev'];
                    echo '<tr>';
                    echo '<td>';
                    echo $nev;
                    echo '</td>';
                    echo '</tr>';
                }

                mysqli_close($con);
    	    ?>
        </tbody>
        </table>
        <br>
        <div id="menuOption"><input id="btn" type="button" value="Vissza"       onclick="window.location.href='./tajegysegek_menu.php'">
        </div>
        <br>
        <br>
    </div>


</body>
</html>