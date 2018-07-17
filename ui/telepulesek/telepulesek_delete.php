
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
            <th>Település</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <?php
                require ("../../db/HelynevDatabase.php");
                
                $db=new HelynevDatabase();
                
                $telepulesek = $db->getAllTelepules();
                
                foreach ($telepulesek as &$telepules) {
            
                echo '<tr>';
                echo '<td>';
                echo $telepules->nev;
                echo '</td>';
                echo "<td><a href='delete.php?id=".$telepules->id."&name=".$telepules->nev."'>Törlés</a></td>";
                echo '</tr>';

            }
            mysqli_close($con);
	    ?>
        </tbody>
        </table>
        <br><br>

        <div id="menuOption"><input id="btn" type="button" value="Vissza"       onclick="window.location.href='./telepulesek_menu.php'">
        </div>
        <br>
    </div>


</body>
</html>