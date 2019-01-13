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
            `nevalkotasszabaly`.Nev as nevalkotasiszabaly	
            FROM `helynev` 
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
            INNER JOIN `nevalkotasszabaly` ON `helynev`.`Nevalkotasi Szabaly`=`nevalkotasszabaly`.ID
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

        $helynevek[$row['Telepules']][]=array(
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
        var nevszerkezetSelect = document.getElementById("nevszerkezetSelect");
        nevszerkezetSelect.onchange = updateHelynevek;
        var id = telepulesekSelect.value;
        var selectedNevszerkezet=nevszerkezetSelect.value;

        var table = document.getElementById("helynevekTable");
        var rows = table.rows.length;

        for(var i=1;i<rows;i++){
            table.deleteRow(1);
        }
        
        var sorszam=1;
        for(var i = 0; i < helynevek[id].length; i++){
            //helynevek[id][i].nevszerkezet===selectedNevszerkezet
            if(helynevek[id][i].nevszerkezet===selectedNevszerkezet){
                
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

                // Add some text to the new cells:
                cell1.innerHTML = sorszam;
                cell2.innerHTML = '<b>'+helynevek[id][i].standard+'</b>';
                cell3.innerHTML = helynevek[id][i].helyfajta;
                cell4.innerHTML = helynevek[id][i].nevszerkezet;
                cell5.innerHTML = helynevek[id][i].r;
                cell6.innerHTML = helynevek[id][i].lm;
                cell7.innerHTML = helynevek[id][i].ar;
                cell8.innerHTML = helynevek[id][i].alm;
                cell9.innerHTML = helynevek[id][i].br;
                cell10.innerHTML = helynevek[id][i].blm;
                cell11.innerHTML = helynevek[id][i].nevalkotasiszabaly;
                cell12.innerHTML = "<a href='helynevek_details.php?id="+helynevek[id][i].id+"'>Adatok</a>";

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
                    <label class="inputlabel">Névszerkezettípus:</label>
                    <select name="nevszerkezet" id="nevszerkezet">
                        <?php
                            $query = "SELECT * FROM `nevszerkezettipus`";
                            
                            $result=mysqli_query($con,$query) or die('hiba');

                            while($row=mysqli_fetch_array($result)){
                                $id=$row['ID'];
                                $nev=$row['Nev'];
                                $egyreszes=$row['Egyreszes'];


                                if($id===$helynev->nevszerkezet){
                                        echo "<option selected='selected' value=".$id.">".$nev."</option>";
                                }
                                else{
                                    echo "<option value=".$id.">".$nev."</option>";
                                }
                            }
                            
                        ?>
                    </select>
                    <br>
                </div>
                <div id="egyreszes" >
                    <div class="inputrow">
                        <label class="inputlabel">FSZ</label>
                        <select name="r">
                            <?php
                                $query = "SELECT * FROM `nevresz`";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                while($row=mysqli_fetch_array($result)){
                                    $id=$row['ID'];
                                    $nev=$row['Nev'];
                                    $kod=$row['Kod'];
                                    $bold="none";

                                    if (strlen($kod) == 2) {
                                        $bold="boldoption";
                                    }
                                    
                                    if($id===$helynev->r){
                                        echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                    else{
                                        echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                }
                                
                            ?>
                        </select>
                        <br>
                    </div>
                    <div class="inputrow">
                        <label class="inputlabel">LM</label>
                        <select name="lm">
                            <?php
                                $query = "SELECT * FROM `lexikalis` ORDER BY Kod";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                while($row=mysqli_fetch_array($result)){
                                    $id=$row['ID'];
                                    $nev=$row['Nev'];
                                    $kod=$row['Kod'];
                                    $bold="none";

                                    if (strlen($kod) == 2) {
                                        $bold="boldoption";
                                    }
                                    
                                    if($id===$helynev->lm){
                                        echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                    else{
                                        echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                }
                                
                            ?>
                        </select>
                        <br>
                    </div>
                    <div class="inputrow">
                        <label class="inputlabel">Toldalék</label>
                        <select name="t">
                            <?php
                                $query = "SELECT * FROM `toldalek`"
                                        . "ORDER BY Sorszam";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                while($row=mysqli_fetch_array($result)){
                                    $id=$row['ID'];
                                    $nev=$row['Nev'];
                                    $kod=$row['Kod'];
                                    $bold="none";

                                    if (strlen($kod) == 2) {
                                        $bold="boldoption";
                                    }
                                    
                                    if($id===$helynev->t){
                                        echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                    else{
                                        echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                                    } 
                                }
                                
                            ?>
                        </select>
                        <br>
                    </div>
                </div>
                <div id="ketreszes" >
                    <div class="inputrow">
                        <label class="inputlabel">Alaprész:</label>
                        <select name="ar">
                            <?php
                                $query = "SELECT * FROM `nevresz`";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                while($row=mysqli_fetch_array($result)){
                                    $id=$row['ID'];
                                    $nev=$row['Nev'];
                                    $kod=$row['Kod'];
                                    $bold="none";

                                    if (strlen($kod) == 2) {
                                        $bold="boldoption";
                                    }
                                    
                                    if($id===$helynev->ar){
                                        echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                    else{
                                        echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                }
                                
                            ?>
                        </select>
                        <br>
                    </div>
                    <div class="inputrow">
                        <label class="inputlabel">ALM</label>
                        <select name="alm">
                            <?php
                                $query = "SELECT * FROM `lexikalis` ORDER BY Kod";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                while($row=mysqli_fetch_array($result)){
                                    $id=$row['ID'];
                                    $nev=$row['Nev'];
                                    $kod=$row['Kod'];
                                    $bold="none";

                                    if (strlen($kod) == 2) {
                                        $bold="boldoption";
                                    }
                                    
                                    if($id===$helynev->alm){
                                        echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                    else{
                                        echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                }
                                
                            ?>
                        </select>
                        <br>
                    </div>
                    <div class="inputrow">
                        <label class="inputlabel">AT</label>
                        <select name="at">
                            <?php
                                $query = "SELECT * FROM `toldalek`"
                                        . "ORDER BY Sorszam";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                while($row=mysqli_fetch_array($result)){
                                    $id=$row['ID'];
                                    $nev=$row['Nev'];
                                    $kod=$row['Kod'];
                                    $bold="none";

                                    if (strlen($kod) == 2) {
                                        $bold="boldoption";
                                    }
                                    
                                    if($id===$helynev->at){
                                        echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                    else{
                                        echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                }
                                
                            ?>
                        </select>
                        <br>
                    </div>
                    <div class="inputrow">
                        <label class="inputlabel">Bővítményrész:</label>
                        <select name="br">
                            <?php
                                $query = "SELECT * FROM `nevresz`";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                while($row=mysqli_fetch_array($result)){
                                    $id=$row['ID'];
                                    $nev=$row['Nev'];
                                    $kod=$row['Kod'];
                                    $bold="none";

                                    if (strlen($kod) == 2) {
                                        $bold="boldoption";
                                    }
                                    
                                    if($id===$helynev->br){
                                        echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                    else{
                                        echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                }
                                
                            ?>
                        </select>
                        <br>
                    </div>
                    <div class="inputrow">
                        <label class="inputlabel">BLM</label>
                        <select name="blm">
                            <?php
                                $query = "SELECT * FROM `lexikalis` ORDER BY Kod";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                while($row=mysqli_fetch_array($result)){
                                    $id=$row['ID'];
                                    $nev=$row['Nev'];
                                    $kod=$row['Kod'];
                                    $bold="none";

                                    if (strlen($kod) == 2) {
                                        $bold="boldoption";
                                    }
                                    
                                    if($id===$helynev->blm){
                                        echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                    else{
                                        echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                
                                }
                                
                            ?>
                        </select>
                        <br>
                    </div>
                    <div class="inputrow">
                        <label class="inputlabel">BT</label>
                        <select name="bt">
                            <?php
                                $query = "SELECT * FROM `toldalek`"
                                        . "ORDER BY Sorszam";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                while($row=mysqli_fetch_array($result)){
                                    $id=$row['ID'];
                                    $nev=$row['Nev'];
                                    $kod=$row['Kod'];
                                    $bold="none";

                                    if (strlen($kod) == 2) {
                                        $bold="boldoption";
                                    }
                                    
                                    if($id===$helynev->bt){
                                        echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                    else{
                                        echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                                    }
                                }
                                
                            ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="inputrow">
                    <label class="inputlabel">Névalkotási szabály:</label>
                    <select name="nevalkotasiszabaly">
                        <?php
                            $query = "SELECT * FROM `nevalkotasszabaly`";
                            
                            $result=mysqli_query($con,$query) or die('hiba');

                            while($row=mysqli_fetch_array($result)){
                                $id=$row['ID'];
                                $nev=$row['Nev'];
                                $kod=$row['Kod'];
                                $bold="none";

                                if (strlen($kod) == 2) {
                                    $bold="boldoption";
                                }
                                
                                if($id===$helynev->nevalkotasiszabaly){
                                    echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                                }
                                else{
                                    echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                                }
                            }
                            
                        ?>
                    </select>
                    <br>             
                </div>
                <br>
        </form>
        </div>
        </div>
        <br>
        <table id='helynevekTable'>
        <thead>
        <tr>
            <th>Sorszám</th>
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