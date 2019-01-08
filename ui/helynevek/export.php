<?php  
//export.php  
require ("../../db/HelynevDatabase.php");
include("../../config.php");
$output='';

if(isset($_POST["export"]))
{
    $query = "SELECT
        helynev.ID, 
        Standard,
        Telepules,
        telepules.nev as telepulesNev,
        tajegyseg.Nev as tajegysegNev,
        Ejtes,
        helyfajta.Nev as helyfajtaNev,
        helyfajta.Kod as helyfajtaKod,
        Terkepszam,
        Ragos_Alak,
        nyelv.Nev as nyelvNev,
        Forras_Adat,
        Forras_Ev,
        Forras_Tipus,
        Objektum_Info,
        Nev_Info,
        Nevvarians,
        Termeszetes,
        Mikro,
        nevszerkezettipus.Nev as nevszerkezetNev,
        nevszerkezettipus.Egyreszes as egyreszes,
        nr.Nev as R,
        nr.Kod as Rkod,
        lm.Nev as LM,
        lm.Kod as LMkod,
        t.Nev as T,
        t.Kod as Tkod,
        nar.Nev as AR,
        nar.Kod as ARkod,
        alm.Nev as ALM,
        alm.Kod as ALMkod,
        at.Nev as AT,
        at.Kod as ATkod,
        nbr.Nev as BR,
        nbr.Kod as BRkod,
        blm.Nev as BLM,
        blm.Kod as BLMkod,
        bt.Nev as BT,
        bt.Kod as BTkod,
        `nevalkotasszabaly`.Nev as nevalkotasiszabaly	
        FROM `helynev` 
        INNER JOIN `telepules` ON `helynev`.Telepules=`telepules`.ID
        INNER JOIN `tajegyseg` ON `telepules`.Tajegyseg=`tajegyseg`.ID
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

    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0)
    {
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
        while($row = mysqli_fetch_array($result))
        {
            $output .= '
                <tr>  
                    <td>'.$row["Standard"].'</td>  
                    <td>'.$row["telepulesNev"].'</td>  
                    <td>'.$row["tajegysegNev"].'</td>  
                    <td>'.$row["Ejtes"].'</td>  
                    <td>'.$row["helyfajtaKod"]." ".$row["helyfajtaNev"].'</td>  
                    <td>'.$row["Terkepszam"].'</td>
                    <td>'.$row["Ragos_Alak"].'</td>
                    <td>'.$row["nyelvNev"].'</td>
                    <td>'.$row["Forras_Adat"].'</td>
                    <td>'.$row["Forras_Ev"].'</td>
                    <td>'.$row["Forras_Tipus"].'</td>
                    <td>'.$row["Objektum_Info"].'</td>
                    <td>'.$row["Nev_Info"].'</td>
                    <td>'.$row["Nevvarians"].'</td>';
            if($row["Termeszetes"]==1)
                $output .= '<td>Természetes</td>';
            else
                $output .= '<td>Mesterséges</td>';
    
            if($row["Mikro"]==1)
                $output .= '<td>Mikro</td>';
            else
                $output .= '<td>Makro</td>';

            if($row["egyreszes"]==1){
                $output .= '<td>'.$row["nevszerkezetNev"].'</td>
                        <td>'.$row["Rkod"]." ".$row["R"].'</td>
                        <td>'.$row["LMkod"]." ".$row["LM"].'</td>
                        <td>'.$row["Tkod"]." ".$row["T"].'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>'.$row["nevalkotasiszabaly"].'</td>';
            }
            else{
                $output .= '<td>'.$row["nevszerkezetNev"].'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>'.$row["ARkod"]." ".$row["AR"].'</td>
                        <td>'.$row["ALMkod"]." ".$row["ALM"].'</td>
                        <td>'.$row["ATkod"]." ".$row["AT"].'</td>
                        <td>'.$row["BRkod"]." ".$row["BR"].'</td>
                        <td>'.$row["BLMkod"]." ".$row["BLM"].'</td>
                        <td>'.$row["BTkod"]." ".$row["BT"].'</td>
                        <td>'.$row["nevalkotasiszabaly"].'</td>';
            }

            $output .= '</tr>';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=download.xls');
        echo $output;
    }
}
?>