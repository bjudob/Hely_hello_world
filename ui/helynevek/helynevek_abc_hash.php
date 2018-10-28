<!DOCTYPE html>
<html>
<?php
    include("../../config.php");

    if (!function_exists('charToNumber'))   {
        function charToNumber($a){
            $abc = array("a"," "á", "b","c","cs","d","dz","dzs","e","é","f","g","gy","h","i","í","j","k","l","ly","m","n","ny","o","ó","ö","ő","p","q","r","s","sz","t","ty","u","ú","ü","ű","v","w","x","y","z","zs");
          
            foreach ($abc as $letter){
                if(a===letter){
                    return i;
                }
            }
            return -1;
        }
    }
    
    if (!function_exists('hash'))   {
        function hash($standard){
            
        }
    }
    
    if (!function_exists('hash'))   {
        function hash($standard){
            $abc = array("a", "á", "b","c","cs","d","dz","dzs","e","é","f","g","gy","h","i","í","j","k","l","ly","m","n","ny","o","ó","ö","ő","p","q","r","s","sz","t","ty","u","ú","ü","ű","v","w","x","y","z","zs");
            
            return $standard;
        }
    }
    
    if (!function_exists('updateHashCode'))   {
        function updateHashCode($id, $standard, $con) {
            //$hash=hash($standard);

            $query = "UPDATE `helynev`
                SET Standard_Hash='$standard'
                WHERE ID='$id';";
            
            mysqli_query($con, $query) or die('hiba');
        }
    }
    
    $query = "SELECT
            ID, 
            Standard
            FROM `helynev`";
    
    $result=mysqli_query($con,$query) or die('hiba');

    while($row=mysqli_fetch_array($result)){
        $id=$row['ID'];
        $standard=$row['Standard'];
        
        updateHashCode($id, $standard, $con);
    }
    
    
?>
