<?php  
//export.php  
require ("../../db/HelynevDatabase.php");
$output='';
function checkStarts($filter, $helynev, $attribute) {
    if (!isset($filter) || (isset($filter) && mb_substr( $helynev[$attribute], 0, strlen($filter) ) === $filter)) {
       return true;
    } else {
       return false;
    }
}

if(isset($_POST["export"]))
{
    if(isset($_POST["nevszerkezet"]) && $_POST["nevszerkezet"] != 'all'){
        $nevszerkezetFilter=$_POST["nevszerkezet"];
    }
    if(isset($_POST["tajegyseg"]) && $_POST["tajegyseg"] != 'all'){
        $tajegysegFilter=$_POST["tajegyseg"];
    }
    if(isset($_POST["telepules"]) && $_POST["telepules"] != 'all'){
        $telepulesFilter=$_POST["telepules"];
    }
    if(isset($_POST["firstLetter"]) && $_POST["firstLetter"] != 'all'){
        $firstLetterFilter=$_POST["firstLetter"];
    }
    if(isset($_POST["helyfajta"]) && $_POST["helyfajta"] != 'all'){
        $helyfajtaFilter=$_POST["helyfajta"];
    }
    if(isset($_POST["r"]) && $_POST["r"] != 'all'){
        $rFilter=$_POST["r"];
    }
    if(isset($_POST["lm"]) && $_POST["lm"] != 'all'){
        $lmFilter=$_POST["lm"];
    }
    if(isset($_POST["t"]) && $_POST["t"] != 'all'){
        $tFilter=$_POST["t"];
    }
    if(isset($_POST["ar"]) && $_POST["ar"] != 'all'){
        $arFilter=$_POST["ar"];
    }
    if(isset($_POST["alm"]) && $_POST["alm"] != 'all'){
        $almFilter=$_POST["alm"];
    }
    if(isset($_POST["at"]) && $_POST["at"] != 'all'){
        $atFilter=$_POST["at"];
    }
    if(isset($_POST["br"]) && $_POST["br"] != 'all'){
        $brFilter=$_POST["br"];
    }
    if(isset($_POST["blm"]) && $_POST["blm"] != 'all'){
        $blmFilter=$_POST["blm"];
    }
    if(isset($_POST["bt"]) && $_POST["bt"] != 'all'){
        $btFilter=$_POST["bt"];
    }
    if(isset($_POST["nevalkotasiszabaly"]) && $_POST["nevalkotasiszabaly"] != 'all'){
        $nevalkotasiszabalyFilter=$_POST["nevalkotasiszabaly"];
    }
    
    $db=new HelynevDatabase();

    $helynevek = $db->getAllHelynev();

    $output .= '
        <table class="table" bordered="1">  
            <tr>  
                <th>Standard</th>  
                <th>Település</th>  
                <th>Tájegység</th> 
                <th>Ejtés</th>  
                <th>Helyfajta</th>
                <th>Térképszám</th>
                <th>Helyrag</th>
                <th>Nyelv</th>  
                <th>Forrásadat</th>  
                <th>Forrásadat éve</th>  
                <th>Forrás és éve</th>
                <th>Objektum info</th>
                <th>Név info</th>
                <th>Névváltozatok</th>  
                <th>Természetes/mesterséges</th>  
                <th>Mikro/makro</th>  
                <th>Névszerkezettípus</th>
                <th>Funkcionális szemantikai</th>
                <th>Lexikális morfológiai</th>  
                <th>Toldalék</th>  
                <th>Alaprész</th>  
                <th>ALM</th>
                <th>AT</th>
                <th>Bővítményrész</th>
                <th>BLM</th>  
                <th>BT</th> 
                <th>Névalkotási szabály</th>  
            </tr>
    ';
    
    foreach ($helynevek as $helynev){  
        $a=mb_strtolower($helynev["standard"]);
        if(mb_substr($a,0,3)==="dzs"){
            $firstLetter = mb_substr($a,0,3);
        }
        else if(  mb_substr($a,0,2)=="cs"
        ||mb_substr($a,0,2)=="dz"
        ||mb_substr($a,0,2)=="gy"
        ||mb_substr($a,0,2)=="ly"
        ||mb_substr($a,0,2)=="ny"
        ||mb_substr($a,0,2)=="sz"
        ||mb_substr($a,0,2)=="ty"
        ||mb_substr($a,0,2)=="zs"){
            $firstLetter = mb_substr($a,0,2);
        }
        else{
            $firstLetter = mb_substr($a,0,1);
        }

        if(
            (!isset($nevszerkezetFilter) || (isset($nevszerkezetFilter) && $nevszerkezetFilter==$helynev["nevszerkezetNev"])) &&
            (!isset($tajegysegFilter) || (isset($tajegysegFilter) && $tajegysegFilter==$helynev["tajegysegId"])) &&
            (!isset($telepulesFilter) || (isset($telepulesFilter) && $telepulesFilter==$helynev["telepulesId"])) &&
            (!isset($helyfajtaFilter) || checkStarts($helyfajtaFilter,$helynev,"helyfajtaKod")) &&
            (!isset($firstLetterFilter) || (isset($firstLetterFilter) && $firstLetterFilter===$firstLetter)) &&
            (!isset($rFilter) || checkStarts($rFilter,$helynev,"rKod")) &&
            (!isset($lmFilter) || checkStarts($lmFilter,$helynev,"lmKod")) &&
            (!isset($tFilter) || checkStarts($tFilter,$helynev,"tKod")) &&
            (!isset($arFilter) || checkStarts($arFilter,$helynev,"arKod")) &&
            (!isset($almFilter) || checkStarts($almFilter,$helynev,"almKod")) &&
            (!isset($atFilter) || checkStarts($atFilter,$helynev,"atKod")) &&
            (!isset($brFilter) || checkStarts($brFilter,$helynev,"brKod")) &&
            (!isset($blmFilter) || checkStarts($blmFilter,$helynev,"blmKod")) &&
            (!isset($btFilter) ||  checkStarts($btFilter,$helynev,"btKod")) &&
            (!isset($nevalkotasiszabalyFilter) ||  checkStarts($nevalkotasiszabalyFilter,$helynev,"nevalkotasiszabalyKod"))
        ){
            $output .= '
                <tr>  
                    <td>'.$helynev["standard"].'</td>  
                    <td>'.$helynev["telepulesNev"].'</td>  
                    <td>'.$helynev["tajegysegNev"].'</td>  
                    <td>'.$helynev["ejtes"].'</td>  
                    <td>'.$helynev["helyfajtaKod"]." ".$helynev["helyfajtaNev"].'</td>  
                    <td>'.$helynev["terkepszam"].'</td>
                    <td>'.$helynev["ragos_alak"].'</td>
                    <td>'.$helynev["nyelv"].'</td>
                    <td>'.$helynev["forras_adat"].'</td>
                    <td>'.$helynev["forras_ev"].'</td>
                    <td>'.$helynev["forras_tipus"].'</td>
                    <td>'.$helynev["objektum_info"].'</td>
                    <td>'.$helynev["nev_info"].'</td>
                    <td>'.$helynev["nevvarians"].'</td>';
            if($helynev["termeszetes"]==1)
                $output .= '<td>Természetes</td>';
            else
                $output .= '<td>Mesterséges</td>';

            if($helynev["mikro"]==1)
                $output .= '<td>Mikro</td>';
            else
                $output .= '<td>Makro</td>';

            $output .= '<td>'.$helynev["nevszerkezetNev"].'</td>
                    <td>'.$helynev["rKod"]." ".$helynev["r"].'</td>
                    <td>'.$helynev["lmKod"]." ".$helynev["lm"].'</td>
                    <td>'.$helynev["tKod"]." ".$helynev["t"].'</td> 
                    <td>'.$helynev["arKod"]." ".$helynev["ar"].'</td>
                    <td>'.$helynev["almKod"]." ".$helynev["alm"].'</td>
                    <td>'.$helynev["atKod"]." ".$helynev["at"].'</td>
                    <td>'.$helynev["brKod"]." ".$helynev["br"].'</td>
                    <td>'.$helynev["blmKod"]." ".$helynev["blm"].'</td>
                    <td>'.$helynev["btKod"]." ".$helynev["bt"].'</td>
                    <td>'.$helynev["nevalkotasiszabalyKod"]." ".$helynev["nevalkotasiszabaly"].'</td>';
            

            $output .= '</tr>';
        }
    }
    $output .= '</table>';
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=helynevek.xls');
    echo $output;
}

?>