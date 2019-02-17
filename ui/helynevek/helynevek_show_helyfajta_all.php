<!DOCTYPE html>
<html>
<?php
    require ("../../db/HelynevDatabase.php");
    include("../../config.php");
    
    $db=new HelynevDatabase();

    //$telepulesek = $db->getAllTelepules();

    $query = "SELECT
            helynev.ID, 
            Standard,
            Telepules,
            telepules.nev as TelepulesNev,
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
            INNER JOIN `telepules` ON `helynev`.Telepules=`telepules`.ID
            INNER JOIN `helyfajta` ON `helynev`.Helyfajta=`helyfajta`.ID
            INNER JOIN `nyelv` ON `helynev`.Nyelv=`nyelv`.ID
            ORDER BY Standard_Hash";
    
    mysqli_query($con, $query);
    $result=mysqli_query($con,$query) or die('hiba');

    while($row=mysqli_fetch_array($result)){
        $id=$row['ID'];
        $telepules=$row['TelepulesNev'];
        $standard=$row['Standard'];
        $ejtes=$row['Ejtes'];
        $helyfajta=$row['helyfajtaKod']." ".$row['joinHelyfajta'];
        $helyfajtaKod=$row['helyfajtaKod'];
        $terkepszam=$row['Terkepszam'];
        $ragos_alak=$row['Ragos_Alak'];
        $nyelv=$row['joinNyelv'];
        $forras_adat=$row['Forras_Adat'];
        $forras_ev=$row['Forras_Ev'];
        $forras_tipus=$row['Forras_Tipus'];
        $objektum_info=$row['Objektum_Info'];
        $nev_info=$row['Nev_Info'];
        $nevvarians=$row['Nevvarians'];

        $helynevek[]=array(
          "id"=>$id,
          "telepules"=>$telepules,
          "standard"=>$standard,
          "ejtes"=>$ejtes,
          "helyfajta"=>$helyfajta,
          "helyfajtaKod"=>$helyfajtaKod,
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
        var helyfajtaSelect = document.getElementById("helyfajtaSelect");
        var helyfajtaFilter = document.getElementById("helyfajtaFilter");
        helyfajtaSelect.onchange = updateHelynevek;
        var selectedHelyfajta=helyfajtaSelect.value;
        helyfajtaFilter.value=selectedHelyfajta;

        var table = document.getElementById("helynevekTable");
        var rows = table.rows.length;

        for(var i=1;i<rows;i++){
            table.deleteRow(1);
        }

        var sorszam=1;
        for(var i = 0; i < helynevek.length; i++){
            if(helynevek[i].helyfajtaKod.startsWith(selectedHelyfajta)){
                var hely_id=helynevek[i].id;
                var telepules=helynevek[i].telepules;
                var standard=helynevek[i].standard;
                var ejtes=helynevek[i].ejtes;
                var helyfajta=helynevek[i].helyfajta;
                var ragos_alak=helynevek[i].ragos_alak;
                var nyelv=helynevek[i].nyelv;
                var forras_adat=helynevek[i].forras_adat;
                var forras_ev=helynevek[i].forras_ev;
                var forras_tipus=helynevek[i].forras_tipus;
                var objektum_info=helynevek[i].objektum_info;
                var nev_info=helynevek[i].nev_info;
                var nevvarians=helynevek[i].nevvarians;

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
                cell2.innerHTML = '<b>'+standard+'</b>';
                cell3.innerHTML = telepules;
                cell4.innerHTML = ejtes;
                cell5.innerHTML = helyfajta;
                cell6.innerHTML = ragos_alak;
                cell7.innerHTML = nyelv;
                cell8.innerHTML = forras_adat;
                cell9.innerHTML = forras_ev;
                cell10.innerHTML = forras_tipus;
                cell11.innerHTML = objektum_info;
                cell12.innerHTML = nev_info;
                cell13.innerHTML = nevvarians;
                cell14.innerHTML = "<a href='helynevek_details.php?id="+hely_id+"'>Adatok</a>";

                sorszam++;
            }
        }
    }
      
    function updateHelyfajta(){

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
                    <label>Helyfajta:</label>
                    <select id='helyfajtaSelect' >
                        <?php
                            $query = "SELECT * FROM `helyfajta`  ORDER BY Kod";
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