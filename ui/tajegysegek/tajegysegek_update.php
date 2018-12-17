
<!DOCTYPE html>
<html>
<?php
    require ("../../db/HelynevDatabase.php");
    include("../../config.php");
    include('../../navbar_lvl1.php');
?>
<head>
	<title>Tájegységek</title>
    <link rel="stylesheet" type="text/css" href="../../css/helynevek_show.css">
    <link rel="stylesheet" type="text/css" href="../../css/mainpage.css">
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
            <th></th>
        </tr>
        </thead>
        <tbody>
            <?php
                $db=new HelynevDatabase();
                
                $tajegysegek = $db->getAllTajegyseg();
                
                foreach ($tajegysegek as &$tajegyseg) {
                    echo '<tr>';
                    echo '<td>';
                    echo $tajegyseg->nev;
                    echo '</td>';
                    echo "<td><a href='update.php?id=".$tajegyseg->id."&name=".$tajegyseg->nev."'>Átnevez</a></td>";
                    echo '</tr>';

                }
	    ?>
	    </tbody>
        </table>
        <br><br>

        <div id="menuOption"><input id="btn" type="button" value="Vissza"       onclick="window.location.href='./tajegysegek_menu.php'">
        </div>
        <br>
        <br>
    </div>


</body>
</html>