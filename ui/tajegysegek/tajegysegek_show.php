<!DOCTYPE html>
<html>
<?php
    include('../../navbar_lvl1.php');
?>
<head>
	<title>Tájegységek</title>
    <link rel="stylesheet" type="text/css" href="../../css/tajegysegek.css">
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
        </tr>
        </thead>
        <tbody>
            <?php
                $root = realpath($_SERVER["DOCUMENT_ROOT"]);
                
                require ("$root\helynevek\db\HelynevDatabase.php");
                
                $db=new HelynevDatabase();
                
                $tajegysegek = $db->getAllTajegyseg();
                
                foreach ($tajegysegek as &$tajegyseg) {
                    echo '<tr>';
                    echo '<td>';
                    echo $tajegyseg->nev;
                    echo '</td>';
                    echo '</tr>';
                }  
                
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