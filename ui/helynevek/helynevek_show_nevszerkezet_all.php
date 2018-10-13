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
            Nevvarians,
            Termeszetes,
            Mikro,
            nevszerkezettipus.Nev as nevszerkezet,
            nevszerkezettipus.Egyreszes as egyreszes,
            nr.Nev as R,
            nr.Kod as Rkod,
            lm.Nev as LM,
            lm.Kod as LMkod,
            t.Rovidites as T,
            nar.Nev as AR,
            nar.Kod as ARkod,
            alm.Nev as ALM,
            alm.Kod as ALMkod,
            at.Rovidites as AT,
            nbr.Nev as BR,
            nbr.Kod as BRkod,
            blm.Nev as BLM,
            blm.Kod as BLMkod,
            bt.Rovidites as BT,
            `Nevalkotasi Szabaly` as nevalkotasiszabaly	
            FROM `helynev` 
            INNER JOIN `telepules` ON `helynev`.Telepules=`telepules`.ID
            INNER JOIN `nevszerkezettipus` ON `helynev`.Nevszerkezettipus=`nevszerkezettipus`.ID
            INNER JOIN `helyfajta` ON `helynev`.Helyfajta=`helyfajta`.ID
            INNER JOIN `nevresz` nr ON `helynev`.R=nr.ID
            INNER JOIN `nevresz` nar ON `helynev`.AR=nar.ID
            INNER JOIN `nevresz` nbr ON `helynev`.BR=nbr.ID
            INNER JOIN `lexikalis` lm ON `helynev`.LM=lm.ID
            INNER JOIN `lexikalis` alm ON `helynev`.ALM=alm.ID
            INNER JOIN `lexikalis` blm ON `helynev`.BLM=blm.ID
            INNER JOIN `toldalek` t ON `helynev`.T=t.ID
            INNER JOIN `toldalek` at ON `helynev`.AT=at.ID
            INNER JOIN `toldalek` bt ON `helynev`.BT=bt.ID
            INNER JOIN `nyelv` ON `helynev`.Nyelv=`nyelv`.ID
            ORDER BY TelepulesNev DESC";
          /*WHERE Is_Active=1";*/
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
        $termeszetes=$row['Termeszetes'];
        $mikro=$row['Mikro'];
        $nevszerkezet=$row['nevszerkezet'];
        $egyreszes=$row['egyreszes'];
        $r=$row['Rkod'].$row['R'];
        $lm=$row['LMkod'].$row['LM']."-".$row['T'];
        $ar=$row['ARkod'].$row['AR'];
        $alm=$row['ALMkod'].$row['ALM']."-".$row['AT'];
        $br=$row['BRkod'].$row['BR'];
        $blm=$row['BLMkod'].$row['BLM']."-".$row['BT'];
        $nevalkotasiszabaly=$row['nevalkotasiszabaly'];
        
        if($egyreszes==1){
            $ar="-";
            $alm="-";
            $br="-";
            $blm="-";
        }
        else{
            $r="-";
            $lm="-";
        }

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
            "termeszetes"=>$termeszetes,
            "mikro"=>$mikro,
            "nevvarians"=>$nevvarians,
            "nevszerkezet"=>$nevszerkezet,
            "r"=>$r,
            "lm"=>$lm,
            "ar"=>$ar,
            "alm"=>$alm,
            "br"=>$br,
            "blm"=>$blm,
            "nevalkotasiszabaly"=>$nevalkotasiszabaly,
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
        var nevszerkezetSelect = document.getElementById("nevszerkezetSelect");
        nevszerkezetSelect.onchange = updateHelynevek;
        var selectedNevszerkezet=nevszerkezetSelect.value;

        var table = document.getElementById("helynevekTable");
        var rows = table.rows.length;

        for(var i=1;i<rows;i++){
            table.deleteRow(1);
        }

        for(var i = 0; i < helynevek.length; i++){
            if(helynevek[i].nevszerkezet===selectedNevszerkezet){
                
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
                var cell12= row.insertCell(11);

                // Add some text to the new cells:
                cell1.innerHTML = helynevek[i].telepules;
                cell2.innerHTML = helynevek[i].standard;
                cell3.innerHTML = helynevek[i].helyfajta;
                cell4.innerHTML = helynevek[i].nevszerkezet;
                cell5.innerHTML = helynevek[i].r;
                cell6.innerHTML = helynevek[i].lm;
                cell7.innerHTML = helynevek[i].ar;
                cell8.innerHTML = helynevek[i].alm;
                cell9.innerHTML = helynevek[i].br;
                cell10.innerHTML = helynevek[i].blm;
                cell11.innerHTML = helynevek[i].nevalkotasiszabaly;
                cell12.innerHTML = "<a href='helynevek_details.php?id="+helynevek[i].id+"'>Adatok</a>";
            }
        }
    }
      
    function updateHelyfajta(){

    }
    </script>
</head>
<body onload='updateHelynevek()'>
    <div id="container">
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
        </div>
        <br>
        <table id='helynevekTable'>
        <thead>
        <tr>
            <th>Település</th>
            <th>Standard</th>
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