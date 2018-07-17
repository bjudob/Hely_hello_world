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
                
                $root = realpath($_SERVER["DOCUMENT_ROOT"]);
                
                require ("$root\helynevek\db\HelynevDatabase.php");
                
                $db=new HelynevDatabase();
                
                $telepulesek = $db->getAllTelepules();
                
                foreach ($telepulesek as &$telepules) {
                    echo '<tr>';
                    echo '<td colspan="2">';
                    echo $telepules->nev;
                    echo '</td>';
                    echo '<td>';
                    echo $telepules->megye;
                    echo '</td>';
                    echo '<td>';
                    echo $telepules->tajegyseg;
                    echo '</td>';
                    echo '<td>';
                    echo $telepules->telepulestipus;
                    echo '</td>';
                    echo '<td>';
                    echo $telepules->nyelv;
                    echo '</td>';
                    echo "<td><a href='./telepulesek_details.php?id=".$telepules->id."'>Módosítás</a></td>";
                                    echo '</tr>';
                }
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