<!DOCTYPE html>
<html>
<?php
    require ("../../db/HelynevDatabase.php");
    include("../../config.php");
    
    $query = "SELECT * FROM `tajegyseg`";
          /*WHERE Is_Active=1";*/
    $result=mysqli_query($con,$query) or die('hiba');

    while($row=mysqli_fetch_array($result)){
        $id=$row['ID'];
        $nev=$row['Nev'];

        $tajegysegek[]=array("id"=>$id,"val"=>$nev);
  }

    $query = "SELECT * FROM `telepules`";
          /*WHERE Is_Active=1";*/
    $result=mysqli_query($con,$query) or die('hiba');

    while($row=mysqli_fetch_array($result)){
        $id=$row['ID'];
        $nev=$row['Nev'];

        $telepulesek[$row['Tajegyseg']][]=array("id"=>$id,"val"=>$nev);
    }

    $db=new HelynevDatabase();

    $helynevek = $db->getAllHelynev();

    $jsonTajegysegek = json_encode($tajegysegek);
    $jsonTelepulesek = json_encode($telepulesek);
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
        echo "var tajegysegek = $jsonTajegysegek; \n";
        echo "var telepulesek = $jsonTelepulesek; \n";
        echo "var helynevek = $jsonHelynevek; \n";
      ?>
      function loadTajegysegek(){
        var select = document.getElementById("tajegysegekSelect");
        select.onchange = updateTelepulesek;
        select.options[0] = new Option("Összes","all");
        for(var i = 0; i < tajegysegek.length; i++){
          select.options[i+1] = new Option(tajegysegek[i].val,tajegysegek[i].id);          
        }
        updateTelepulesek();
      }
      function updateTelepulesek(){
        var tajegysegekSelect = document.getElementById("tajegysegekSelect");
        var selectedTajegyseg = tajegysegekSelect.value;
        var telepulesekSelect = document.getElementById("telepulesekSelect");
        telepulesekSelect.onchange = updateHelynevek;
        telepulesekSelect.options.length = 0; //delete all options if any present
        telepulesekSelect.options[0] = new Option("Összes","all");
        if(selectedTajegyseg != 'all'){
            for(var i = 0; i < telepulesek[selectedTajegyseg].length; i++){
            telepulesekSelect.options[i+1] = new Option(telepulesek[selectedTajegyseg][i].val,telepulesek[selectedTajegyseg][i].id);
            }
        }
        updateHelynevek();
      }
      function updateHelynevek(){
        var tajegysegekSelect = document.getElementById("tajegysegekSelect");
        var telepulesekSelect = document.getElementById("telepulesekSelect");
        var helyfajtaSelect = document.getElementById("helyfajtaSelect");
        var helyfajtaFilter = document.getElementById("helyfajtaFilter");
        var telepulesFilter = document.getElementById("telepulesFilter");
        var tajegysegFilter = document.getElementById("tajegysegFilter");
        helyfajtaSelect.onchange = updateHelynevek;
        var selectedTelepules = telepulesekSelect.value;
        var selectedTajegyseg = tajegysegekSelect.value;
        var selectedHelyfajta=helyfajtaSelect.value;
        telepulesFilter.value=selectedTelepules;
        helyfajtaFilter.value=selectedHelyfajta;
        tajegysegFilter.value=selectedTajegyseg;

        var table = document.getElementById("helynevekTable");
        var rows = table.rows.length;

        for(var i=1;i<rows;i++){
            table.deleteRow(1);
        }

        var sorszam=1;
        for(var i = 0; i < helynevek.length; i++){
            if( (selectedTajegyseg==='all' || (
                    helynevek[i].tajegysegId==selectedTajegyseg && (
                        selectedTelepules==='all' || 
                        helynevek[i].telepulesId==selectedTelepules
                        )
                    )
                )
                && helynevek[i].helyfajtaKod != null
                && helynevek[i].helyfajtaKod.startsWith(selectedHelyfajta)
            ){
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
                var cell12 = row.insertCell(11);
                var cell13 = row.insertCell(12);
                var cell14 = row.insertCell(13);

                // Add some text to the new cells:
                cell1.innerHTML = sorszam;
                cell2.innerHTML = '<b>'+helynevek[i].standard+'</b>';
                cell3.innerHTML = helynevek[i].telepulesNev;
                cell4.innerHTML = helynevek[i].ejtes;
                cell5.innerHTML = helynevek[i].helyfajtaKod+helynevek[i].helyfajtaNev;
                cell6.innerHTML = helynevek[i].ragos_alak;
                cell7.innerHTML = helynevek[i].nyelv;
                cell8.innerHTML = helynevek[i].forras_adat;
                cell9.innerHTML = helynevek[i].forras_ev;
                cell10.innerHTML = helynevek[i].forras_tipus;
                cell11.innerHTML = helynevek[i].objektum_info;
                cell12.innerHTML = helynevek[i].nev_info;
                cell13.innerHTML = helynevek[i].nevvarians;
                cell14.innerHTML = "<a href='helynevek_details.php?id="+helynevek[i].id+"'>Adatok</a>";

                sorszam++;
            }
        }
    }
    </script>
</head>
<body onload='loadTajegysegek()'>
    <div id="container">
        <div id="blockcontainer">
            <div id="title">Helynevek</div>
            <br>
            <div id="telepules_select" style="margin: auto; text-align: center;font-size: 200%">
            <form action = "" method = "post">
                <label>Tájegység:</label>
                <select id='tajegysegekSelect' >
                </select>
                <br>
                <label>Település:</label>
                <select id='telepulesekSelect' >
                </select>
                <br>
                <label>Helyfajta:</label>
                <select id='helyfajtaSelect' >
                    <?php
                        $query = "SELECT * FROM `helyfajta` ORDER BY Sorszam";
                                    /*WHERE Is_Active=1";*/

                        $result=mysqli_query($con,$query) or die('hiba');

                        while($row=mysqli_fetch_array($result)){
                                $id=$row['ID'];
                                $nev=$row['Nev'];
                                $kod=$row['Kod'];
                                $bold="none";

                                if (strlen($kod) == 2) {
                                    $bold="boldoption";
                                }
                                
                                echo "<option class='$bold' value=".$kod.">".$kod." ".$nev."</option>";
                            }

                    ?>
                </select>
                <br>
            </form>
            <br>
            <form method="post" action="export.php">
                <input type="submit" name="export" id="btn" value="Excel letöltése" />
                <input type="hidden" id="helyfajtaFilter" name="helyfajta" value=""/>
                <input type="hidden" id="telepulesFilter" name="telepules" value=""/>
                <input type="hidden" id="tajegysegFilter" name="tajegyseg" value=""/>
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
            <th>Ejtés</th>
            <th>Helyfajta</th>
            <th>Helyrag</th>
            <th>Nyelv</th>
            <th>Forrásadat</th>
            <th>Forrásdat éve</th>
            <th>Forrás típus</th>
            <th>Objektum info</th>
            <th>Név info</th>
            <th>Névváltozatok</th>
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