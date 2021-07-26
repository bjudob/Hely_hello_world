<?php
    include("../../config.php");

    if (!function_exists('charToNumber'))   {
        function letterToHash($a){
            $abc = array("a","ā","Ā","ȧ","Ȧ","ä","Ä","0", "á", "b","c","cs","d","dz","dzs","e","ë","Ë","ē","Ē","é","f","g","gy","h","i","í","j","k","l","ly","m","n","ny","o","ó","ö","ő","p","q","r","s","sz","t","ty","u","ú","ü","ű","v","w","x","y","z","zs","¹","²","³");
            $utf = array(
                "¹"=>"!",
                "²"=>"#",
                "³"=>"%",
                "1"=>"&",
                "2"=>"(",
                "3"=>")",
                "4"=>"*",
                "5"=>"+",
                "6"=>",",
                "7"=>"-",
                "8"=>".",            
                "9"=>"/",
                "a"=>"0",
                "ā"=>"0",
                "Ā"=>"0",
                "ȧ"=>"0",
                "Ȧ"=>"0",
                "ä"=>"0",
                "Ä"=>"0",
                "á"=>"0",
                "b"=>"8",
                "c"=>"9",
                "cs"=>":",
                "ccs"=>"::",
                "d"=>"<",
                "dz"=>"=",
                "ddz"=>"==",
                "dzs"=>">",
                "e"=>"?",
                "ë"=>"?",
                "Ë"=>"?",
                "ē"=>"?",
                "Ē"=>"?",
                "é"=>"?",
                "f"=>"E",
                "g"=>"F",
                "gy"=>"G",
                "ggy"=>"GG",
                "h"=>"H",
                "i"=>"I",
                "í"=>"I",
                "j"=>"K",
                "k"=>"L",
                "l"=>"M",
                "ly"=>"N",
                "lly"=>"NN",
                "m"=>"O",
                "n"=>"P",
                "ny"=>"Q",
                "nny"=>"QQ",
                "o"=>"S",
                "ó"=>"S",
                "ö"=>"T",
                "ő"=>"T",
                "p"=>"U",
                "q"=>"V",
                "r"=>"W",
                "s"=>"X",
                "sz"=>"Y",
                "ssz"=>"YY",
                "t"=>"Z",
                "ty"=>"[",
                "tty"=>"[[",
                "u"=>"]",
                "ú"=>"]",
                "ü"=>"|",
                "ű"=>"|",
                "v"=>"~",
                "w"=>"¡",
                "x"=>"¢",
                "y"=>"£",
                "z"=>"¤",
                "zs"=>"¦",
                "zzs"=>"¦¦",
                "i."=>"&.",
                "ii."=>"(.",
                "iii."=>").",
                "iv."=>"*.",
                "v."=>"+.",
                "vi."=>",.",
                );
           
            if(array_key_exists ($a,$utf)){
                $value=$utf[$a];
                //echo "Found value ($value) for key ($a)";
                //echo '<br>';
                
                return $value;
            } else{
                //echo "Caught exception for key ($a)";
                //echo '<br>';
                return "¥";
            }         
        }
    }
    
    if (!function_exists('firstLetter'))   {
        function firstLetter($str){            
            $a= mb_strtolower($str);
            if(mb_substr($str, 0, 4)=="iii."){
                return mb_substr($str, 0, 4);
            }
            if(mb_substr($str, 0, 3)==="dzs"
                ||mb_substr($str, 0, 3)==="ccs"
                ||mb_substr($str, 0, 3)==="ddz"
                ||mb_substr($str, 0, 3)==="ggy"
                ||mb_substr($str, 0, 3)==="lly"
                ||mb_substr($str, 0, 3)==="nny"
                ||mb_substr($str, 0, 3)==="ssz"
                ||mb_substr($str, 0, 3)==="tty"
                ||mb_substr($str, 0, 3)==="zzs"
                ||mb_substr($str, 0, 3)==="ii."
                ||mb_substr($str, 0, 3)==="iv."
                ||mb_substr($str, 0, 3)==="vi."
            ){
                return mb_substr($str, 0, 3);
            }
            if(  mb_substr($str, 0, 2)=="cs"
               ||mb_substr($str, 0, 2)=="dz"
               ||mb_substr($str, 0, 2)=="gy"
               ||mb_substr($str, 0, 2)=="ly"
               ||mb_substr($str, 0, 2)=="ny"
               ||mb_substr($str, 0, 2)=="sz"
               ||mb_substr($str, 0, 2)=="ty"
               ||mb_substr($str, 0, 2)=="zs"
               ||mb_substr($str, 0, 2)=="i."
               ||mb_substr($str, 0, 2)=="v."){
                return mb_substr($str, 0, 2);
            }
            return mb_substr($str, 0, 1);
        }
    }
    
    if (!function_exists('abcHash'))   {
        function abcHash($str){
            //remove white spaces
            $nospace = mb_strtolower(preg_replace('/\s+/', '', $str));
            $standard = preg_replace('/-/', '', $nospace);
                    
            //remove *
            if(mb_substr($standard, 0, 1)==="*"){
                $standard = mb_substr($standard, 1);
            }
            
            // kulonleges esetek e.g. csz=c+sz or cs+z
            if($standard==='piacszer'){
                return 'UI09Y?W';
            }

            $hash="";
            
            while(true){                                      
                if($standard===""){
                    //echo "Found hash ($hash) for key ($str)";
                    //echo '<br>';
                    return $hash;
                }

                $firstLetter=firstLetter($standard);
                $hash=$hash.letterToHash($firstLetter);
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
