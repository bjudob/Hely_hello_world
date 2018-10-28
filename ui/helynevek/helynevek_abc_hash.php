<!DOCTYPE html>
<html>
<?php
    include("../../config.php");
    include("./helynevek_abc_hash_utils.php");

    $query = "SELECT
            ID, 
            Standard
            FROM `helynev`";
    
    $result=mysqli_query($con,$query) or die('hiba');

    while($row=mysqli_fetch_array($result)){
        $id=$row['ID'];
        $standard=$row['Standard'];
        
        //$low=mb_strtolower(mb_substr($standard, 0, 1));
        //echo "$id  $standard  $low";
        //echo '<br>';
        
        updateHashCode($id, $standard, $con);
    }
