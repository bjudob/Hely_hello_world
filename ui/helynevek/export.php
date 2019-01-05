<?php  
//export.php  
require ("../../db/HelynevDatabase.php");
include("../../config.php");
$output='';

if(isset($_POST["export"]))
{
 $query = "SELECT * FROM `helynev` ";
 $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0)
    {
        $output .= '
            <table class="table" bordered="1">  
                <tr>  
                    <th>Standard</th>  
                    <th>Település</th>  
                    <th>Ejtés</th>  
                    <th>Helyfajta</th>
                    <th>Ragos Alak</th>
                </tr>
        ';
        while($row = mysqli_fetch_array($result))
        {
            $output .= '
                <tr>  
                    <td>'.$row["Standard"].'</td>  
                    <td>'.$row["Telepules"].'</td>  
                    <td>'.$row["Ejtes"].'</td>  
                    <td>'.$row["Helyfajta"].'</td>  
                    <td>'.$row["Ragos_Alak"].'</td>
                </tr>
        ';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=download.xls');
        echo $output;
    }
}
?>