<!DOCTYPE html>
<html>
<?php
    require ("../../db/HelynevDatabase.php");
    include("../../config.php");

    $db=new HelynevDatabase();
    $helynevek = $db->getAllHelynev();
    $jsonHelynevek = json_encode($helynevek);
?>

<?php
    include('../../navbar_lvl1.php');
?>

<head>
    <title>Helynevek</title>
    <link rel="stylesheet" type="text/css" href="../../css/helynevek_show.css">
    <link rel="stylesheet" type="text/css" href="../../css/mainpage.css">

    <script src="jquery-3.2.1.min.js"></script>
    <script type='text/javascript'>
        <?php
            echo "var helynevek = $jsonHelynevek; \n";
        ?>
        function updateHelynevek(){
            var nevszerkezetSelect = document.getElementById("nevszerkezetSelect");
            var nevszerkezetFilter = document.getElementById("nevszerkezetFilter");

            nevszerkezetSelect.onchange = updateHelynevek;

            var selectedNevszerkezet=nevszerkezetSelect.value;
            nevszerkezetFilter.value = selectedNevszerkezet;

            var table = document.getElementById("helynevekTable");
            var rows = table.rows.length;

            for(var i=1;i<rows;i++){
                table.deleteRow(1);
            }

        sorszam=1;
        for(var i = 0; i < helynevek.length; i++){
            if(helynevek[i].nevszerkezetNev===selectedNevszerkezet){
                
                // Create an empty <tr> element and add it to the 1st position of the table:
                var row = table.insertRow();

                // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);
                var cell7 = row.insertCell(6);
                var cell8 = row.insertCell(7);
                var cell9 = row.insertCell(8);
                var cell10 = row.insertCell(9);
                var cell11= row.insertCell(10);
                var cell12= row.insertCell(11);
                var cell13= row.insertCell(12);

                // Add some text to the new cells:
                cell1.innerHTML = sorszam;
                cell2.innerHTML = '<b>'+helynevek[i].standard+'</b>';
                cell3.innerHTML = helynevek[i].telepulesNev;
                cell4.innerHTML = helynevek[i].helyfajtaNev;
                cell5.innerHTML = helynevek[i].nevszerkezetNev;
                cell6.innerHTML =  helynevek[i].rKod+helynevek[i].r;
                cell7.innerHTML = helynevek[i].lmKod+helynevek[i].lm;
                cell8.innerHTML = helynevek[i].arKod+helynevek[i].ar;
                cell9.innerHTML = helynevek[i].almKod+helynevek[i].alm;
                cell10.innerHTML = helynevek[i].brKod+helynevek[i].br;
                cell11.innerHTML = helynevek[i].blmKod+helynevek[i].blm;
                cell12.innerHTML = helynevek[i].nevalkotasiszabaly;
                cell13.innerHTML = "<a href='helynevek_details.php?id="+helynevek[i].id+"'>Adatok</a>";
            
                sorszam++;
            }
        }
    }
    </script>

</head>
<body onload='updateHelynevek()'>
    <div id="container">
        <div id="blockcontainer">
            <div id="title">Helynevek</div>
            <br>
            <div id="telepules_select" style="margin: auto; text-align: center;font-size: 200%">
                <form action = "" method = "post">
                    <label>Névszerkezettípus:</label>
                    <select id='nevszerkezetSelect' >
                        <?php
                                $query = "SELECT * FROM `nevszerkezettipus`";
                                            /*WHERE Is_Active=1";*/
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                while($row=mysqli_fetch_array($result)){
                                    $id=$row['ID'];
                                    $nev=$row['Nev'];
                                    $egyreszes=$row['Egyreszes'];

                                    echo "<option value=".$nev.">".$nev."</option>";
                                }
                                
                            ?>
                    </select>
                    <br>
                </form>
                <br>
                <form method="post" action="export.php">
                    <input type="submit" name="export" id="btn" value="Excel letöltése" />
                    <input type="hidden" id="nevszerkezetFilter" name="nevszerkezet" value=""/>
                </form>
            </div>
        </div>
        <br>
        <table id='helynevekTable'>
        <thead>
        <tr>
            <th>Sorszám</th>
            <th>Standard</th>
            <th>Település</th>
            <th>Helyfajta</th>
            <th>Névszerkezet</th>
            <th>Névrész</th>
            <th>LM</th>
            <th>Alaprész</th>
            <th>ALM</th>
            <th>Bővítményrész</th>
            <th>BLM</th>
            <th>Névalkotási szabály</th>
            <th></th>
        </tr>
        </thead>
        <tbody id='helynevekTBody'>
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