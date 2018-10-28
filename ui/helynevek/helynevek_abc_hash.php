<!DOCTYPE html>
<html>
<?php
    include("../../config.php");

    if (!function_exists('charToNumber'))   {
        function letterToHash($a){
            $abc = array("a","ā","Ā","ȧ","Ȧ","ä","Ä","0", "á", "b","c","cs","d","dz","dzs","e","ë","Ë","ē","Ē","é","f","g","gy","h","i","í","j","k","l","ly","m","n","ny","o","ó","ö","ő","p","q","r","s","sz","t","ty","u","ú","ü","ű","v","w","x","y","z","zs","¹","²","³");
            $utf = array(
                "a"=>"0",
                "ā"=>"1",
                "Ā"=>"2",
                "ȧ"=>"3",
                "Ȧ"=>"4",
                "ä"=>"5",
                "Ä"=>"6",
                "á"=>"8",
                "b"=>"9",
                "c"=>":",
                "cs"=>";",
                "d"=>"<",
                "dz"=>"=",
                "dzs"=>">",
                "e"=>"?",
                "ë"=>"@",
                "Ë"=>"A",
                "ē"=>"B",
                "Ē"=>"C",
                "é"=>"D",
                "f"=>"E",
                "g"=>"F",
                "gy"=>"G",
                "h"=>"H",
                "i"=>"I",
                "í"=>"J",
                "j"=>"K",
                "k"=>"L",
                "l"=>"M",
                "ly"=>"M",
                "m"=>"N",
                "n"=>"O",
                "ny"=>"P",
                "o"=>"Q",
                "ó"=>"R",
                "ö"=>"S",
                "ő"=>"T",
                "p"=>"U",
                "q"=>"V",
                "r"=>"W",
                "s"=>"X",
                "sz"=>"Y",
                "t"=>"Z",
                "ty"=>"[",
                "u"=>"]",
                "ú"=>"a",
                "ü"=>"b",
                "ű"=>"c",
                "v"=>"d",
                "w"=>"e",
                "x"=>"xf",
                "y"=>"g",
                "z"=>"h",
                "zs"=>"i",
                "¹"=>"j",
                "²"=>"k",
                "³"=>"l",
                "1"=>"m",
                "2"=>"n",
                "3"=>"o",
                "4"=>"p",
                "5"=>"q",
                "6"=>"r",
                "7"=>"s",
                "8"=>"t",            
                "9"=>"u");
           
            if(array_key_exists ($a,$utf)){
                $value=$utf[$a];
                //echo "Found value ($value) for key ($a)";
                //echo '<br>';
                
                return $value;
            } else{
                echo "Caught exception for key ($a)";
                echo '<br>';
                return "¥";
            }         
        }
    }
    
    if (!function_exists('firstLetter'))   {
        function firstLetter($str){            
            $a= mb_strtolower($str);
            if(mb_substr($str, 0, 3)==="dzs"){
                return mb_substr($str, 0, 3);
            }
            if(  mb_substr($str, 0, 2)=="cs"
               ||mb_substr($str, 0, 2)=="dz"
               ||mb_substr($str, 0, 2)=="gy"
               ||mb_substr($str, 0, 2)=="ly"
               ||mb_substr($str, 0, 2)=="ny"
               ||mb_substr($str, 0, 2)=="sz"
               ||mb_substr($str, 0, 2)=="ty"
               ||mb_substr($str, 0, 2)=="zs"){
                return mb_substr($str, 0, 2);
            }
            return mb_substr($str, 0, 1);
        }
    }
    
    if (!function_exists('abcHash'))   {
        function abcHash($str){
            //remove white spaces
            $standard = preg_replace('/\s+/', '', $str);
            
            //remove *
            if(mb_substr($standard, 0, 1)==="*"){
                $standard = mb_substr($standard, 1);
            }
            
            $hash="";
            
            while(true){                                      
                if($standard===""){
                    echo "Found hash ($hash) for key ($str)";
                    echo '<br>';
                    return $hash;
                }

                $firstLetter=firstLetter($standard);
                $hash=$hash.letterToHash(mb_strtolower(mb_substr($firstLetter, 0, 1)));
                $standard =substr( $standard,strlen($firstLetter));
            }
        }
    }
    
    if (!function_exists('updateHashCode'))   {
        function updateHashCode($id, $standard, $con) {
            $hash=abcHash($standard);

            $query = "UPDATE `helynev`
                SET Standard_Hash='$hash'
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
        
        //$low=mb_strtolower(mb_substr($standard, 0, 1));
        //echo "$id  $standard  $low";
        //echo '<br>';
        
        updateHashCode($id, $standard, $con);
    }
    
    
?>