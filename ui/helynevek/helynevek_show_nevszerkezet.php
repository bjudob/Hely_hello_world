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
            telepules.ID as telepulesId,
            telepules.nev as telepulesNev,
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
            t.Kod as Tkod,
            nar.Nev as AR,
            nar.Kod as ARkod,
            alm.Nev as ALM,
            alm.Kod as ALMkod,
            at.Rovidites as AT,
            at.Kod as ATkod,
            nbr.Nev as BR,
            nbr.Kod as BRkod,
            blm.Nev as BLM,
            blm.Kod as BLMkod,
            bt.Rovidites as BT,
            bt.Kod as BTkod,
            `nevalkotasszabaly`.Nev as nevalkotasiszabaly,
            `nevalkotasszabaly`.Kod as nevalkotasiszabalyKod
            FROM `helynev` 
            LEFT JOIN `telepules` ON `helynev`.Telepules=`telepules`.ID
            LEFT JOIN `nevszerkezettipus` ON `helynev`.Nevszerkezettipus=`nevszerkezettipus`.ID
            LEFT JOIN `helyfajta` ON `helynev`.Helyfajta=`helyfajta`.ID
            LEFT JOIN `nevresz` nr ON `helynev`.R=nr.ID
            LEFT JOIN `nevresz` nar ON `helynev`.AR=nar.ID
            LEFT JOIN `nevresz` nbr ON `helynev`.BR=nbr.ID
            LEFT JOIN `lexikalis` lm ON `helynev`.LM=lm.ID
            LEFT JOIN `lexikalis` alm ON `helynev`.ALM=alm.ID
            LEFT JOIN `lexikalis` blm ON `helynev`.BLM=blm.ID
            LEFT JOIN `toldalek` t ON `helynev`.T=t.ID
            LEFT JOIN `toldalek` at ON `helynev`.AT=at.ID
            LEFT JOIN `toldalek` bt ON `helynev`.BT=bt.ID
            LEFT JOIN `nyelv` ON `helynev`.Nyelv=`nyelv`.ID
            LEFT JOIN `nevalkotasszabaly` ON `helynev`.`Nevalkotasi Szabaly`=`nevalkotasszabaly`.ID
            ORDER BY Standard_Hash";
    
    mysqli_query($con, $query);
    $result=mysqli_query($con,$query) or die('hiba');

    while($row=mysqli_fetch_array($result)){
        $id=$row['ID'];
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
        $rKod=$row['Rkod'];
        $lm=$row['LMkod'].$row['LM']."-".$row['T'];
        $lmKod=$row['LMkod'];
        $tKod=$row['Tkod'];
        $ar=$row['ARkod'].$row['AR'];
        $arKod=$row['ARkod'];
        $alm=$row['ALMkod'].$row['ALM']."-".$row['AT'];
        $almKod=$row['ALMkod'];
        $atKod=$row['ATkod'];
        $br=$row['BRkod'].$row['BR'];
        $brKod=$row['BRkod'];
        $blm=$row['BLMkod'].$row['BLM']."-".$row['BT'];
        $blmKod=$row['BLMkod'];
        $btKod=$row['BTkod'];
        $nevalkotasiszabaly=$row['nevalkotasiszabalyKod'].$row['nevalkotasiszabaly'];
        $nevalkotasiszabalyKod=$row['nevalkotasiszabalyKod'];
        
        if($egyreszes==1){
            $ar="-";
            $arKod="-";
            $alm="-";
            $almKod="-";
            $atKod="-";
            $br="-";
            $brKod="-";
            $blm="-";
            $blmKod="-";
            $btKod="-";
        }
        else{
            $r="-";
            $rKod="-";
            $lm="-";
            $lmKod="-";
            $tKod="-";
        }

        if($row["Termeszetes"]==1){
            $termeszetesNev='Természetes';
        }
        else{
            $termeszetesNev='Mesterséges';
        }
        if($row["Mikro"]==1){
            $mikroNev='Mikro';
        }
        else{
            $mikroNev='Makro';
        }

        $helynevek[]=array(
            "telepules"=>$row['telepulesId'],
            "telepulesNev"=>$row['telepulesNev'],
            "id"=>$id,
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
            "termeszetesNev"=>$termeszetesNev,
            "mikro"=>$mikro,
            "mikroNev"=>$mikroNev,
            "nevvarians"=>$nevvarians,
            "nevszerkezet"=>$nevszerkezet,
            "r"=>$r,
            "rKod"=>$rKod,
            "lm"=>$lm,
            "lmKod"=>$lmKod,
            "tKod"=>$tKod,
            "ar"=>$ar,
            "arKod"=>$arKod,
            "alm"=>$alm,
            "almKod"=>$almKod,
            "atKod"=>$atKod,
            "br"=>$br,
            "brKod"=>$brKod,
            "blm"=>$blm,
            "blmKod"=>$blmKod,
            "btKod"=>$btKod,
            "nevalkotasiszabaly"=>$nevalkotasiszabaly,
            "nevalkotasiszabalyKod"=>$nevalkotasiszabalyKod,
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script> 
        $(document).ready(function(){
            $("#ketreszes").hide();
            
            $('#nevszerkezetSelect').on('change', function() {
                if ( this.options[this.selectedIndex].text.includes("+"))
                //.....................^.......
                {
                    $("#ketreszes").show();
                    $("#egyreszes").hide();

                    $("#rSelect").val("all");
                    $("#lmSelect").val("all");
                    $("#tSelect").val("all");

                    $("#nevalkotasiszabalySelect").val("all");
                }
                else
                {
                    $("#ketreszes").hide();
                    $("#egyreszes").show();

                    $("#arSelect").val("all");
                    $("#almSelect").val("all");
                    $("#atSelect").val("all");

                    $("#brSelect").val("all");
                    $("#blmSelect").val("all");
                    $("#btSelect").val("all");

                    $("#nevalkotasiszabalySelect").val("all");
                }
            });
        });
    </script>
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
        //form
        var telepulesekSelect = document.getElementById("telepulesekSelect");
        var nevszerkezetSelect = document.getElementById("nevszerkezetSelect");
        var termeszetesSelect = document.getElementById("termeszetesSelect");
        var mikroSelect = document.getElementById("mikroSelect");
        var rSelect = document.getElementById("rSelect");
        var lmSelect = document.getElementById("lmSelect");
        var tSelect = document.getElementById("tSelect");
        var arSelect = document.getElementById("arSelect");
        var almSelect = document.getElementById("almSelect");
        var atSelect = document.getElementById("atSelect");
        var brSelect = document.getElementById("brSelect");
        var blmSelect = document.getElementById("blmSelect");
        var btSelect = document.getElementById("btSelect");
        var szabalySelect = document.getElementById("nevalkotasiszabalySelect");

        //filters
        var telepulesFilter = document.getElementById("telepulesFilter");
        var nevszerkezetFilter = document.getElementById("nevszerkezetFilter");
        var termeszetesFilter = document.getElementById("termeszetesFilter");
        var mikroFilter = document.getElementById("mikroFilter");
        var rFilter = document.getElementById("rFilter");
        var lmFilter = document.getElementById("lmFilter");
        var tFilter = document.getElementById("tFilter");
        var arFilter = document.getElementById("arFilter");
        var almFilter = document.getElementById("almFilter");
        var atFilter = document.getElementById("atFilter");
        var brFilter = document.getElementById("brFilter");
        var blmFilter = document.getElementById("blmFilter");
        var btFilter = document.getElementById("btFilter");
        var szabalyFilter = document.getElementById("nevalkotasiszabalyFilter");

        //set
        nevszerkezetSelect.onchange = updateHelynevek;
        termeszetesSelect.onchange=updateHelynevek;
        mikroSelect.onchange=updateHelynevek;
        rSelect.onchange = updateHelynevek;
        lmSelect.onchange = updateHelynevek;
        tSelect.onchange = updateHelynevek;
        arSelect.onchange = updateHelynevek;
        almSelect.onchange = updateHelynevek;
        atSelect.onchange = updateHelynevek;
        brSelect.onchange = updateHelynevek;
        blmSelect.onchange = updateHelynevek;
        btSelect.onchange = updateHelynevek;
        szabalySelect.onchange = updateHelynevek;
        var id = telepulesekSelect.value;
        var selectedNevszerkezet=nevszerkezetSelect.value;
        var selectedTermeszetes=termeszetesSelect.value;
        var selectedMikro=mikroSelect.value;
        var selectedR=rSelect.value;
        var selectedLM=lmSelect.value;
        var selectedT=tSelect.value;
        var selectedAR=arSelect.value;
        var selectedALM=almSelect.value;
        var selectedAT=atSelect.value;
        var selectedBR=brSelect.value;
        var selectedBLM=blmSelect.value;
        var selectedBT=btSelect.value;
        var selectedSzabaly=szabalySelect.value;

        //set filters
        telepulesFilter.value=id;
        nevszerkezetFilter.value=selectedNevszerkezet;
        termeszetesFilter.value=selectedTermeszetes;
        mikroFilter.value=selectedMikro;
        rFilter.value=selectedR;
        lmFilter.value=selectedLM;
        tFilter.value=selectedT;
        arFilter.value=selectedAR;
        almFilter.value=selectedALM;
        atFilter.value=selectedAT;
        brFilter.value=selectedBR;
        blmFilter.value=selectedBLM;
        btFilter.value=selectedBT;
        szabalyFilter.value=selectedSzabaly;

        //reload table
        var table = document.getElementById("helynevekTable");
        var rows = table.rows.length;

        for(var i=1;i<rows;i++){
            table.deleteRow(1);
        }
        
        var sorszam=1;
        for(var i = 0; i < helynevek.length; i++){
            $matching=true;
            if(!(id==="all" || helynevek[i].telepules==id)) $matching=false;
            if(!(selectedNevszerkezet==="all" || helynevek[i].nevszerkezet==selectedNevszerkezet)) $matching=false;

            if(!(selectedTermeszetes==="all" || helynevek[i].termeszetes==selectedTermeszetes)) $matching=false;
            if(!(selectedMikro==="all" || helynevek[i].mikro==selectedMikro)) $matching=false;

            if(!( selectedR==="all" || helynevek[i].rKod.startsWith(selectedR))) $matching=false;
            if(!( selectedLM==="all" || helynevek[i].lmKod.startsWith(selectedLM))) $matching=false;
            if(!( selectedT==="all" || helynevek[i].tKod.startsWith(selectedT))) $matching=false;

            if(!( selectedAR==="all" || helynevek[i].arKod.startsWith(selectedAR))) $matching=false;
            if(!( selectedALM==="all" || helynevek[i].almKod.startsWith(selectedALM))) $matching=false;
            if(!( selectedAT==="all" || helynevek[i].atKod.startsWith(selectedAT))) $matching=false;

            if(!( selectedBR==="all" || helynevek[i].brKod.startsWith(selectedBR))) $matching=false;
            if(!( selectedBLM==="all" || helynevek[i].blmKod.startsWith(selectedBLM))) $matching=false;
            if(!( selectedBT==="all" || helynevek[i].btKod.startsWith(selectedBT))) $matching=false;

            if(!( selectedSzabaly==="all" || helynevek[i].nevalkotasiszabalyKod.startsWith(selectedSzabaly))) $matching=false;
            

            if( $matching ){
                
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
                var cell15 = row.insertCell(14);

                // Add some text to the new cells:
                cell1.innerHTML = sorszam;
                cell2.innerHTML = '<b>'+helynevek[i].standard+'</b>';
                cell3.innerHTML = helynevek[i].telepulesNev;
                cell4.innerHTML = helynevek[i].helyfajta;
                cell5.innerHTML = helynevek[i].nevszerkezet;
                cell6.innerHTML = helynevek[i].termeszetesNev;
                cell7.innerHTML = helynevek[i].mikroNev;
                cell8.innerHTML = helynevek[i].r;
                cell9.innerHTML = helynevek[i].lm;
                cell10.innerHTML = helynevek[i].ar;
                cell11.innerHTML = helynevek[i].alm;
                cell12.innerHTML = helynevek[i].br;
                cell13.innerHTML = helynevek[i].blm;
                cell14.innerHTML = helynevek[i].nevalkotasiszabaly;
                cell15.innerHTML = "<a href='helynevek_details.php?id="+helynevek[i].id+"'>Adatok</a>";

                sorszam++;
            }
        }
    }
      
    function updateHelyfajta(){

    }
    </script>
</head>
<body onload='loadTajegysegek()'>
    <div id="container">
    <div id="menucontainer">
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
            <div class="inputrow">
                <label class="inputlabel">Természetes:</label>
                <select id="termeszetesSelect">
                    <option class='boldoption' value='all'>Összes</option>
                    <option value=1>Természetes</option>
                    <option value=0>Mesterséges</option>
                </select>
                <br>
            </div>
            <div class="inputrow">
                <label class="inputlabel">Mikro/makro:</label>
                <select  id='mikroSelect'>
                    <option class='boldoption' value='all'>Összes</option>
                    <option value=1>Mikronév</option>
                    <option value=0>Makronév</option>
                </select>
                <br>
            </div>
            <div class="inputrow">
                <label class="inputlabel">Névszerkezettípus:</label>
                <select id='nevszerkezetSelect' >
                    <?php
                        $query = "SELECT * FROM `nevszerkezettipus`";
                        
                        $result=mysqli_query($con,$query) or die('hiba');

                        echo "<option class='boldoption' value='all'>Összes</option>";

                        while($row=mysqli_fetch_array($result)){
                            $id=$row['ID'];
                            $nev=$row['Nev'];
                            $egyreszes=$row['Egyreszes'];

                            echo "<option value=".$nev.">".$nev."</option>";
                        }                     
                    ?>
            </select>
                    <br>
                </div>
                <div id="egyreszes" >
                    <div class="inputrow">
                        <label class="inputlabel">FSZ</label>
                        <select id="rSelect">
                            <?php
                                $query = "SELECT * FROM `nevresz`";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                echo "<option class='boldoption' value='all'>Összes</option>";

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
                    </div>
                    <div class="inputrow">
                        <label class="inputlabel">LM</label>
                        <select id="lmSelect">
                            <?php
                                $query = "SELECT * FROM `lexikalis` ORDER BY Kod";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                echo "<option class='boldoption' value='all'>Összes</option>";

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
                    </div>
                    <div class="inputrow">
                        <label class="inputlabel">Toldalék</label>
                        <select id="tSelect">
                            <?php
                                $query = "SELECT * FROM `toldalek`"
                                        . "ORDER BY Sorszam";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                echo "<option class='boldoption' value='all'>Összes</option>";

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
                    </div>
                </div>
                <div id="ketreszes" >
                    <div class="inputrow">
                        <label class="inputlabel">Alaprész:</label>
                        <select id="arSelect">
                            <?php
                                $query = "SELECT * FROM `nevresz`";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                echo "<option class='boldoption' value='all'>Összes</option>";

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
                    </div>
                    <div class="inputrow">
                        <label class="inputlabel">ALM</label>
                        <select id="almSelect">
                            <?php
                                $query = "SELECT * FROM `lexikalis` ORDER BY Kod";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                echo "<option class='boldoption' value='all'>Összes</option>";

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
                    </div>
                    <div class="inputrow">
                        <label class="inputlabel">AT</label>
                        <select id="atSelect">
                            <?php
                                $query = "SELECT * FROM `toldalek`"
                                        . "ORDER BY Sorszam";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                echo "<option class='boldoption' value='all'>Összes</option>";

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
                    </div>
                    <div class="inputrow">
                        <label class="inputlabel">Bővítményrész:</label>
                        <select id="brSelect">
                            <?php
                                $query = "SELECT * FROM `nevresz`";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                echo "<option class='boldoption' value='all'>Összes</option>";

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
                    </div>
                    <div class="inputrow">
                        <label class="inputlabel">BLM</label>
                        <select id="blmSelect">
                            <?php
                                $query = "SELECT * FROM `lexikalis` ORDER BY Kod";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                echo "<option class='boldoption' value='all'>Összes</option>";

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
                    </div>
                    <div class="inputrow">
                        <label class="inputlabel">BT</label>
                        <select id="btSelect">
                            <?php
                                $query = "SELECT * FROM `toldalek`"
                                        . "ORDER BY Sorszam";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                echo "<option class='boldoption' value='all'>Összes</option>";

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
                    </div>
                </div>
                <br>
                <div class="inputrow">
                    <label class="inputlabel">Névalkotási szabály:</label>
                    <select id="nevalkotasiszabalySelect">
                        <?php
                            $query = "SELECT * FROM `nevalkotasszabaly`";
                            
                            $result=mysqli_query($con,$query) or die('hiba');

                            echo "<option class='boldoption' value='all'>Összes</option>";

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
                </div>
        </form>
        <br>
        <form method="post" action="export.php">
            <input type="submit" name="export" id="btn" value="Excel letöltése" />
            <input type="hidden" id="telepulesFilter" name="telepules" value=""/>
            <input type="hidden" id="nevszerkezetFilter" name="nevszerkezet" value=""/>
            <input type="hidden" id="termeszetesFilter" name="termeszetes" value=""/>
            <input type="hidden" id="mikroFilter" name="mikro" value=""/>
            <input type="hidden" id="rFilter" name="r" value=""/>
            <input type="hidden" id="lmFilter" name="lm" value=""/>
            <input type="hidden" id="tFilter" name="t" value=""/>
            <input type="hidden" id="arFilter" name="ar" value=""/>
            <input type="hidden" id="almFilter" name="alm" value=""/>
            <input type="hidden" id="atFilter" name="at" value=""/>
            <input type="hidden" id="brFilter" name="br" value=""/>
            <input type="hidden" id="blmFilter" name="blm" value=""/>
            <input type="hidden" id="btFilter" name="bt" value=""/>
            <input type="hidden" id="nevalkotasiszabalyFilter" name="nevalkotasiszabaly" value=""/>
            
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
            <th>Névszerk.</th>
            <th>Term./ Mest.</th>
            <th>Mikro/ Makro</th>
            <th>Névrész</th>
            <th>LM</th>
            <th>Alaprész</th>
            <th>ALM</th>
            <th>Bővítmény rész</th>
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