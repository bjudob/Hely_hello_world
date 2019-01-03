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

    <script type='text/javascript'>
    <?php
        echo "var helynevek = $jsonHelynevek; \n";

    ?>
    function charToNumber(a){
        var abc = ["a", "á", "b","c","cs","d","dz","dzs","e","é","f","g","gy","h","i","í","j","k","l","ly","m","n","ny","o","ó","ö","ő","p","q","r","s","sz","t","ty","u","ú","ü","ű","v","w","x","y","z","zs"];
        
        for(var i=0;i<abc.length;i++){
            if(a===abc[i]){
                return i;
            }
        }
        return -1;
    }
    function compareLetter(a,b){
        nrA=charToNumber(a);
        nrB=charToNumber(b);
        
        return nrA<nrB;
    }
    
    function firstLetter(a){
        a=a.toLowerCase();
        if(a.substr(0,3)==="dzs"){
            return a.substr(0,3);
        }
        if(  a.substr(0,2)=="cs"
           ||a.substr(0,2)=="dz"
           ||a.substr(0,2)=="gy"
           ||a.substr(0,2)=="ly"
           ||a.substr(0,2)=="ny"
           ||a.substr(0,2)=="sz"
           ||a.substr(0,2)=="ty"
           ||a.substr(0,2)=="zs"){
            return a.substr(0,2);
        }
        return a.substr(0,1);
    }
   
    function bubbleSortHelynev(a) {
       var swapped;
       do {
           swapped = false;
           for (var i=0; i < a.length-1; i++) {
               if (azEnMagyarulIsTudoOsszehasonlitom(a[i].standard, a[i+1].standard)) {
                   var temp = a[i];
                   a[i] = a[i+1];
                   a[i+1] = temp;
                   swapped = true;
               }
           }
       } while (swapped);
   }
    
    function updateHelynevek(){
        var abcSelect = document.getElementById("abcSelect");
        abcSelect.onchange = updateHelynevek;
        var selectedAbc=abcSelect.value;

        var table = document.getElementById("helynevekTable");
        var rows = table.rows.length;

        for(var i=1;i<rows;i++){
            table.deleteRow(1);
        }
        
        var sorszam=1;
        for(var i = 0; i < helynevek.length; i++){
            var show=false; 
            if(firstLetter(helynevek[i].standard)===selectedAbc){                    
                show=true;
            }
            if(selectedAbc==="all" || show){
                var hely_id=helynevek[i].id;
                var standard=helynevek[i].standard;
                var telepules=helynevek[i].telepules;
                var helyfajta=helynevek[i].helyfajta;
                var nevvaltozatok=helynevek[i].nevvarians;
                               
                // Create an empty <tr> element and add it to the 1st position of the table:
                var row = table.insertRow();

                // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);
                
                // Add some text to the new cells:
                cell1.innerHTML = sorszam;
                cell2.innerHTML = '<b>'+standard+'</b>';
                cell3.innerHTML = telepules;
                cell4.innerHTML = helyfajta;
                cell5.innerHTML = nevvaltozatok;
                cell6.innerHTML = "<a href='helynevek_details.php?id="+hely_id+"'>Adatok</a>";
                
                sorszam++;
            }
        }
    }
      
    </script>
</head>
<body onload='updateHelynevek()'>
    <div id="container">
        <div id="title">Helynevek ábécé sorrendben</div>
        <br>
        <div id="telepules_select" style="margin: auto; text-align: center;font-size: 200%">
            <select id='abcSelect' >
                <option class="boldoption" value="all">Összes</option>
                <option value="a">A</option>
                <option value="á">Á</option>
                <option value="b">B</option>
                <option value="c">C</option>
                <option value="cs">CS</option>
                <option value="d">D</option>
                <option value="dz">DZ</option>
                <option value="dzs">DZS</option>
                <option value="e">E</option>
                <option value="é">É</option>
                <option value="f">F</option>
                <option value="g">G</option>
                <option value="gy">GY</option>
                <option value="h">H</option>
                <option value="i">I</option>
                <option value="í">Í</option>
                <option value="j">J</option>
                <option value="k">K</option>
                <option value="l">L</option>
                <option value="ly">LY</option>
                <option value="m">M</option>
                <option value="n">N</option>
                <option value="ny">NY</option>
                <option value="o">O</option>
                <option value="ó">Ó</option>
                <option value="ö">Ö</option>
                <option value="ő">Ő</option>
                <option value="p">P</option>
                <option value="q">Q</option>
                <option value="r">R</option>
                <option value="s">S</option>
                <option value="sz">SZ</option>
                <option value="t">T</option>
                <option value="ty">TY</option>
                <option value="u">U</option>
                <option value="ú">Ú</option>
                <option value="ü">Ü</option>
                <option value="ű">Ű</option>
                <option value="v">V</option>
                <option value="w">W</option>
                <option value="x">X</option>
                <option value="y">Y</option>
                <option value="z">Z</option>
                <option value="zs">ZS</option>
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
            <th>Település</th>
            <th>Helyfajta</th>          
            <th>Névváltozatok</th>
            <th></th>
        </tr>
        </thead>
        <tbody id='helynevekTBody'>
        </tbody>
        </table>
        <br>
        <div id="menuOption"><input id="btn" type="button" value="Vissza" onclick="window.location.href='./helynevek_menu.php'">
        </div>
        <br>
        <br>
    </div>


</body>
</html>