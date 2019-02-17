<?php  
//export.php  
require ("../../db/HelynevDatabase.php");
$output='';

if(isset($_POST["export"]))
{
    if(isset($_POST["nevszerkezet"])){
        $nevszerkezetFilter=$_POST["nevszerkezet"];
    }
    if(isset($_POST["telepules"])){
        $telepulesFilter=$_POST["telepules"];
    }
    if(isset($_POST["firstLetter"]) && $_POST["firstLetter"] != 'all'){
        $firstLetterFilter=$_POST["firstLetter"];
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
            (!isset($telepulesFilter) || (isset($telepulesFilter) && $telepulesFilter==$helynev["telepulesId"])) &&
            (!isset($firstLetterFilter) || (isset($firstLetterFilter) && $firstLetterFilter===$firstLetter))
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