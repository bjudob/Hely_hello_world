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

    //$telepulesek = $db->getAllTelepules();

    $query = "SELECT
            helynev.ID, 
            Standard,
            Telepules,
            Ejtes,
            helyfajta.Nev as joinHelyfajta,
            helyfajta.Kod as helyfajtaKod,
            Terkepszam,
            Ragos_Alak,
            nyelv.Nev as joinNyelv,
            Forras_Adat,
            Forras_Ev,
            Forras_Tipus,
            Objektum_Info,
            Nev_Info,
            Nevvarians
            FROM `helynev` 
            INNER JOIN `helyfajta` ON `helynev`.Helyfajta=`helyfajta`.ID
            INNER JOIN `nyelv` ON `helynev`.Nyelv=`nyelv`.ID
            ORDER BY Standard desc";
    
    mysqli_query($con, $query);
    $result=mysqli_query($con,$query) or die('hiba');

    while($row=mysqli_fetch_array($result)){
        $id=$row['ID'];
        $standard=$row['Standard'];
        $ejtes=$row['Ejtes'];
        $helyfajta=$row['helyfajtaKod']." ".$row['joinHelyfajta'];
        $terkepszam=$row['Terkepszam'];
        $ragos_alak=$row['Ragos_Alak'];
        $nyelv=$row['joinNyelv'];
        $forras_adat=$row['Forras_Adat'];
        $forras_ev=$row['Forras_Ev'];
        $forras_tipus=$row['Forras_Tipus'];
        $objektum_info=$row['Objektum_Info'];
        $nev_info=$row['Nev_Info'];
        $nevvarians=$row['Nevvarians'];

        $helynevek[$row['Telepules']][]=array(
          "id"=>$id,
          "standard"=>$standard,
          "ejtes"=>$ejtes,
          "helyfajta"=>$helyfajta,
          "terkepszam"=>$terkepszam,
          "ragos_alak"=>$ragos_alak,
          "nyelv"=>$nyelv,
          "forras_adat"=>$forras_adat,
          "forras_ev"=>$forras_ev,
          "forras_tipus"=>$forras_tipus,
          "objektum_info"=>$objektum_info,
          "nev_info"=>$nev_info,
          "nevvarians"=>$nevvarians
          );
  }

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
        for(var i = 0; i < tajegysegek.length; i++){
          select.options[i] = new Option(tajegysegek[i].val,tajegysegek[i].id);          
        }
        updateTelepulesek();
      }
      function updateTelepulesek(){
        var tajegysegekSelect = document.getElementById("tajegysegekSelect");
        var id = tajegysegekSelect.value;
        var telepulesekSelect = document.getElementById("telepulesekSelect");
        telepulesekSelect.onchange = updateHelynevek;
        telepulesekSelect.options.length = 0; //delete all options if any present
        for(var i = 0; i < telepulesek[id].length; i++){
          telepulesekSelect.options[i] = new Option(telepulesek[id][i].val,telepulesek[id][i].id);
        }
        updateHelynevek();
      }
      function updateHelynevek(){
        var telepulesekSelect = document.getElementById("telepulesekSelect");
        var id = telepulesekSelect.value;

        var table = document.getElementById("helynevekTable");
        var rows = table.rows.length;

        for(var i=1;i<rows;i++){
            table.deleteRow(1);
        }

        for(var i = 0; i < helynevek[id].length; i++){
            var hely_id=helynevek[id][i].id;
            var standard=helynevek[id][i].standard;
            var ejtes=helynevek[id][i].ejtes;
            var helyfajta=helynevek[id][i].helyfajta;
            var terkepszam=helynevek[id][i].terkepszam;
            var ragos_alak=helynevek[id][i].ragos_alak;
            var nyelv=helynevek[id][i].nyelv;
            var forras_adat=helynevek[id][i].forras_adat;
            var forras_ev=helynevek[id][i].forras_ev;
            var forras_tipus=helynevek[id][i].forras_tipus;
            var objektum_info=helynevek[id][i].objektum_info;
            var nev_info=helynevek[id][i].nev_info;
            var nevvarians=helynevek[id][i].nevvarians;

            // Create an empty <tr> element and add it to the 1st position of the table:
            var row = table.insertRow(1);

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
            //var cell13 = row.insertCell(12);

            // Add some text to the new cells:
            cell1.innerHTML = helynevek[id].length-i;
            cell2.innerHTML = standard;
            cell3.innerHTML = ejtes;
            cell4.innerHTML = helyfajta;
            cell5.innerHTML = terkepszam;
            cell6.innerHTML = ragos_alak;
            cell7.innerHTML = nyelv;
            cell8.innerHTML = forras_adat;
            //cell8.innerHTML = forras_ev;
            //cell9.innerHTML = forras_tipus;
            cell9.innerHTML = objektum_info;
            cell10.innerHTML = nev_info;
            cell11.innerHTML = nevvarians;
            cell12.innerHTML = "<a href='helynevek_details.php?id="+hely_id+"'>Adatok</a>";
        }
      }
    </script>
</head>
<body onload='loadTajegysegek()'>
    <div id="container">
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
        </form>
        </div>
        <br>
        <table id='helynevekTable'>
        <thead>
        <tr>
            <th>Sorszám</th>
            <th>Standard</th>
            <th>Ejtés</th>
            <th>Helyfajta</th>
            <th>Térképszám</th>
            <th>Helyrag</th>
            <th>Nyelv</th>
            <th>Forrásadat</th>
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