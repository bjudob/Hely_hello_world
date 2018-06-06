<!DOCTYPE html>
<html>
<?php
    include('../navbar_lvl1.php');
?>
<head>
    <title>Statisztika</title>
    <link rel="stylesheet" type="text/css" href="../css/statisztika.css">
    <link rel="stylesheet" type="text/css" href="../mainpage.css">
</head>
<body>
    <div id="container">
        <div id="title" >Statisztika</div>
        <br><br>
        <h1 style="margin: auto; text-align: center;">
        Tájegységek száma az adatbázisban:
        <?php
            include("../config.php");
            mysqli_set_charset($con,"UTF8");
            if(!$con){
                die('Az adatbázis nem elérhető!');
            }
            $query="SELECT count(*) as helyneveknr 
                    FROM `tajegyseg`";
            $result=mysqli_query($con,$query) or die('Hiba tortent');
           
            $data=mysqli_fetch_assoc($result);
            echo $data['helyneveknr'];
        ?>
        <br><br>
        Települések száma az adatbázisban:
        <?php
            $query="SELECT count(*) as helyneveknr 
                    FROM `telepules`";
            $result=mysqli_query($con,$query) or die('Hiba tortent');
           
            $data=mysqli_fetch_assoc($result);
            echo $data['helyneveknr'];
        ?>
        <br><br>
        Helynevek száma az adatbázisban:
        <?php
            $query="SELECT count(*) as helyneveknr 
                    FROM `helynev`";
            $result=mysqli_query($con,$query) or die('Hiba tortent');
           
            $data=mysqli_fetch_assoc($result);
            echo $data['helyneveknr'];

            mysqli_close($con);
        ?>
        </h1>

        <br>
        <br>
        <div id="menuOption"><input id="btn" type="button" value="Vissza"       onclick="window.location.href='./statisztika_menu.php'">
        </div>
        <br>
        <br>
    </div>


</body>
</html>