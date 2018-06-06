<!DOCTYPE html>
<html>
<?php
    include('../../navbar_lvl1.php');
?>

<head>
    <title>Helynevek</title>
    <link rel="stylesheet" type="text/css" href="../../css/helynevek_show.css">
    <link rel="stylesheet" type="text/css" href="../../mainpage.css">
</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            

       }
    ?>
    <div id="container">
        <div id="title">Helynevek</div>
        <br>
        <div id="telepules_select" style="margin: auto; text-align: center;font-size: 200%">
        <form action = "" method = "post">
            <label>Tájegység:</label>
            <select name="tajegyseg" >
            <?php
                include("../../config.php");
                $query = "SELECT * FROM `tajegyseg`";
                        /*WHERE Is_Active=1";*/
                mysqli_query($con, $query);
                $result=mysqli_query($con,$query) or die('hiba');

                while($row=mysqli_fetch_array($result)){
                    $id=$row['ID'];
                    $megye=$row['Nev'];

                    echo "<option value=".$id.">".$megye."</option>";
                }

            ?>
            </select>
            <br>
            <label>Település:</label>
            <select name="telepules" >
            <?php
                include("../../config.php");
                $query = "SELECT * FROM `telepules`";
                        /*WHERE Is_Active=1";*/
                mysqli_query($con, $query);
                $result=mysqli_query($con,$query) or die('hiba');

                while($row=mysqli_fetch_array($result)){
                    $id=$row['ID'];
                    $megye=$row['Nev'];

                    echo "<option value=".$id.">".$megye."</option>";
                }

            ?>
            </select>
            <br>
        </form>
        </div>
        <br>
        <table>
        <thead>
        <tr>
            <th>Helynevek</th>
            <th>Helynevek</th>
            <th>Helynevek</th>
        </tr>
        </thead>
        <tbody>
            <?php      
                $query="SELECT * 
                        FROM helynev";
                $result=mysqli_query($con,$query) or die('Hiba tortent');
               
                while($row=mysqli_fetch_array($result)){
                    $nev=$row['Standard'];
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
        <div id="menuOption"><input id="btn" type="button" value="Vissza"       onclick="window.location.href='./helynevek_menu.php'">
        </div>
        <br>
        <br>
    </div>


</body>
</html>