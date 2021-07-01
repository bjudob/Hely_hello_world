<?php
    include("../../config.php");
    include("./helynevek_abc_hash_utils.php");
        
    if($_SERVER["REQUEST_METHOD"] == "POST") {
	$telepules = mysqli_real_escape_string($con,$_POST['telepules']);
	$standard = mysqli_real_escape_string($con,$_POST['standard']);
	$ejtes = mysqli_real_escape_string($con,$_POST['ejtes']);
	$helyfajtaKod = mysqli_real_escape_string($con,$_POST['helyfajta']);
	$terkepszam = mysqli_real_escape_string($con,$_POST['terkepszam']);
	$ragosalak = mysqli_real_escape_string($con,$_POST['ragosalak']);
	$nyelv = mysqli_real_escape_string($con,$_POST['nyelv']);
	$forrasmunkaadat = mysqli_real_escape_string($con,$_POST['forrasmunkaadat']);
	$forrasmunkaev = mysqli_real_escape_string($con,$_POST['forrasmunkaev']);
	$forrasmunkatipus = mysqli_real_escape_string($con,$_POST['forrasmunkatipus']);
    $objektuminfo = mysqli_real_escape_string($con,$_POST['objektuminfo']);
    $helyinfo = mysqli_real_escape_string($con,$_POST['helyinfo']);
    $nevvaltozatok = mysqli_real_escape_string($con,$_POST['nevvaltozatok']);
    $termeszetes = mysqli_real_escape_string($con,$_POST['termeszetes']);
    $mikro = mysqli_real_escape_string($con,$_POST['mikro']);
    $nevszerkezet = mysqli_real_escape_string($con,$_POST['nevszerkezet']);
    $r = mysqli_real_escape_string($con,$_POST['r']);
    $r = mysqli_real_escape_string($con,$_POST['r']);
    $lm = mysqli_real_escape_string($con,$_POST['lm']);
    $t = mysqli_real_escape_string($con,$_POST['t']);
    $ar = mysqli_real_escape_string($con,$_POST['ar']);
    $alm = mysqli_real_escape_string($con,$_POST['alm']);
    $at= mysqli_real_escape_string($con,$_POST['at']);
    $br = mysqli_real_escape_string($con,$_POST['br']);
    $blm = mysqli_real_escape_string($con,$_POST['blm']);
    $bt = mysqli_real_escape_string($con,$_POST['bt']);
    $nevalkotasiszabaly = mysqli_real_escape_string($con,$_POST['nevalkotasiszabaly']);
    $standardhash=abcHash($standard);
            
    if ($terkepszam==''){$terkepszam=0;}
    if ($forrasmunkaev==''){$forrasmunkaev=0;}
    
    $query = "INSERT INTO helynev(
        `Standard`,
        `Telepules`,
        `Ejtes`,
        `Helyfajta`,
        `Terkepszam`,
        `Ragos_Alak`,
        `Nyelv`,
        `Forras_Adat`,
        `Forras_Ev`,
        `Forras_Tipus`,
        `Objektum_Info`,
        `Nev_Info`,
        `Nevvarians`,
        `Termeszetes`,
        `Mikro`,
        `Nevszerkezettipus`,
        `R`,
        `LM`,
        `T`,
        `AR`,
        `ALM`,
        `AT`,
        `BR`,
        `BLM`,
        `BT`,
        `Nevalkotasi Szabaly`,
        `Standard_Hash`) 
    VALUES (".
        "'$standard',".
        "'$telepules',".
        "'$ejtes',".
        "'$helyfajtaKod',".
        "'$terkepszam',".
        "'$ragosalak',".
        "'$nyelv',".
        "'$forrasmunkaadat',".
        "'$forrasmunkaev',".
        "'$forrasmunkatipus',".
        "'$objektuminfo',".
        "'$helyinfo',".
        "'$nevvaltozatok',".
        "'$termeszetes',".
        "'$mikro',".
        "'$nevszerkezet',".   
        "'$r',".
        "'$lm',".
        "'$t',".
        "'$ar',".
        "'$alm',".
        "'$at',".
        "'$br',".
        "'$blm',".
        "'$bt',".
        "'$nevalkotasiszabaly',".
        "'$standardhash')";

    mysqli_query($con, $query) or die('HIBA: '.$query);
    
          
	header("location: helynevek_add.php");

   }
?>
<!DOCTYPE html>
<html>
<?php
	include('../../navbar_lvl1.php');
?>
<head>
	<title>Helynevek</title>
        <link rel="stylesheet" type="text/css" href="../../css/mainpage.css">
	<link rel="stylesheet" type="text/css" href="../../css/helynevek_show.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script> 
            $(document).ready(function(){
                $("#ketreszes").hide();
                
                $('#nevszerkezet').on('change', function() {
                  if ( this.options[this.selectedIndex].text.includes("+"))
                  //.....................^.......
                  {
                    $("#ketreszes").show();
                    $("#egyreszes").hide();
                  }
                  else
                  {
                    $("#ketreszes").hide();
                    $("#egyreszes").show();
                  }
                });
            });
            
            function addIndex(a){
                document.getElementById("standardInput").value = document.getElementById("standardInput").value.concat(a);
                
            }
            
            function addLetter(a){
                document.getElementById("ejtesInput").value = document.getElementById("ejtesInput").value.concat(a);
                
            }
            
        </script>
        
</head>
<body>
    <div id="menucontainer">
        <br><br>
        <div style="text-align:center;">
            <form action = "" method = "post" class="inputform">
                <br>
                <div class="inputrow">
                    <label class="inputlabel">Standard: </label>
                    <input id="standardInput" type = "text" name = "standard" class="inputfield"/>
                    <br>
                    <label class="inputlabel"></label>
                    <input class="charButton" value="¹" type = "button" onclick="addIndex('¹');"></button>
                    <input class="charButton" value="²" type = "button" onclick="addIndex('²');"></button>
                    <input class="charButton" value="³" type = "button" onclick="addIndex('³');"></button>
                    <br>
                </div>
                <div class="inputrow">
                    <label class="inputlabel">Település:</label>
                    <select name="telepules">
                        <?php
                            $query = "SELECT * FROM `telepules`";
                                        /*WHERE Is_Active=1";*/
                            
                            $result=mysqli_query($con,$query) or die('hiba');

                            while($row=mysqli_fetch_array($result)){
                                $id=$row['ID'];
                                $nev=$row['Nev'];
                                echo "<option value=".$id.">".$nev."</option>";
                            }

                        ?>
                    </select>
                    <br>
                </div>
                <div class="inputrow">
                    <label class="inputlabel">Ejtés:</label><input id="ejtesInput" type = "text" name = "ejtes" class="inputfield"/>              
                    <br>
                    <label class="inputlabel"></label>
                    <input class="charButton" value="ā" type = "button" onclick="addLetter('ā');"></button>
                    <input class="charButton" value="Ā" type = "button" onclick="addLetter('Ā');"></button>
                    <input class="charButton" value="ȧ" type = "button" onclick="addLetter('ȧ');"></button>
                    <input class="charButton" value="Ȧ" type = "button" onclick="addLetter('Ȧ');"></button>
                    <input class="charButton" value="ä" type = "button" onclick="addLetter('ä');"></button>
                    <input class="charButton" value="Ä" type = "button" onclick="addLetter('Ä');"></button>
                    <input class="charButton" value="ë" type = "button" onclick="addLetter('ë');"></button>
                    <input class="charButton" value="Ë" type = "button" onclick="addLetter('Ë');"></button>
                    <input class="charButton" value="ē" type = "button" onclick="addLetter('ē');"></button>
                    <input class="charButton" value="Ē" type = "button" onclick="addLetter('Ē');"></button>
                    <br>
                </div>
                <div class="inputrow">
                    <label class="inputlabel">Helyfajta:</label>
                    <select name="helyfajta">
                        <?php
                            $query = "SELECT * FROM `helyfajta` ORDER BY Sorszam";
                            
                            $result=mysqli_query($con,$query) or die('hiba');

                            while($row=mysqli_fetch_array($result)){
                                    $id=$row['ID'];
                                    $nev=$row['Nev'];
                                    $kod=$row['Kod'];
                                    $bold="none";

                                    if (strlen($kod) == 2) {
                                        $bold="boldoption";
                                    }

                                    echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                                }

                        ?>
                    </select>
                    <br>
                </div>
                <div class="inputrow">
                    <label class="inputlabel">Térképszám:</label><input type = "text" name = "terkepszam" class="inputfield"/>
                    <br>
                </div>
                <div class="inputrow">
                    <label class="inputlabel">Helyrag:</label><input type = "text" name = "ragosalak" class="inputfield"/>
                    <br>
                </div>
                <div class="inputrow">
                    <label class="inputlabel">Nyelv:</label>
                    <select name="nyelv">
                        <?php
                            $query = "SELECT * FROM `nyelv`";
                            
                            $result=mysqli_query($con,$query) or die('hiba');

                            while($row=mysqli_fetch_array($result)){
                                $id=$row['ID'];
                                $nev=$row['Nev'];

                                echo "<option value=".$id.">".$nev."</option>";
                            }            
                        ?>
                    </select>
                    <br>
                </div>
                <div class="inputrow">
                    <label class="inputlabel">Forrásadat:</label><input type = "text" name = "forrasmunkaadat" class="inputfield"/>
                    <br>
                </div>
                <div class="inputrow">
                    <label class="inputlabel">Forrásadat éve:</label><input type = "text" name = "forrasmunkaev" class="inputfield"/>
                    <br>
                </div>
                <div class="inputrow">
                    <label class="inputlabel">Forrás és éve:</label><input type = "text" name = "forrasmunkatipus" class="inputfield" />
                    <br>
                </div>
                <div class="inputrow">
                    <label class="inputlabel">Objektum info:</label><input type = "text" name = "objektuminfo" class="inputfield" />
                    <br>
                </div>
                <div class="inputrow">
                    <label class="inputlabel">Név info:</label><input type = "text" name = "helyinfo" class="inputfield"/>
                    <br>
                </div>
                <div class="inputrow">
                    <label class="inputlabel">Névváltozatok:</label><input type = "text" name = "nevvaltozatok"/>
                    <br>
                </div>
                <div class="inputrow">
                    <label class="inputlabel">Term./ Mest.:</label>
                    <select name="termeszetes">
                        <option value=1>Természetes</option>
                        <option value=0>Mesterséges</option>
                    </select>
                    <br>
                </div>
                <div class="inputrow">
                    <label class="inputlabel">Mikro/ Makro:</label>
                    <select name="mikro">
                        <option value=1>Mikronév</option>
                        <option value=0>Makronév</option>
                    </select>
                    <br>
                </div>
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

                                echo "<option value=".$id.">".$nev."</option>";
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
                                $query = "SELECT * FROM `nevresz` ORDER BY Sorszam";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                while($row=mysqli_fetch_array($result)){
                                    $id=$row['ID'];
                                    $nev=$row['Nev'];
                                    $kod=$row['Kod'];
                                    $bold="none";

                                    if (strlen($kod) == 2) {
                                        $bold="boldoption";
                                    }

                                    //echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                                    echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
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
                                    
                                    echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
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
                                    
                                    echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
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
                                $query = "SELECT * FROM `nevresz` ORDER BY Sorszam";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                while($row=mysqli_fetch_array($result)){
                                    $id=$row['ID'];
                                    $nev=$row['Nev'];
                                    $kod=$row['Kod'];
                                    $bold="none";

                                    if (strlen($kod) == 2) {
                                        $bold="boldoption";
                                    }
                                    
                                    echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
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
                                    
                                    echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
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
                                    
                                    echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                                }
                                
                            ?>
                        </select>
                        <br>
                    </div>
                    <div class="inputrow">
                        <label class="inputlabel">Bővítményrész:</label>
                        <select name="br">
                            <?php
                                $query = "SELECT * FROM `nevresz` ORDER BY Sorszam";
                                
                                $result=mysqli_query($con,$query) or die('hiba');

                                while($row=mysqli_fetch_array($result)){
                                    $id=$row['ID'];
                                    $nev=$row['Nev'];
                                    $kod=$row['Kod'];
                                    $bold="none";

                                    if (strlen($kod) == 2) {
                                        $bold="boldoption";
                                    }
                                    
                                    echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
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
                                    
                                    echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                                
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
                                    
                                    echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                                }
                                
                            ?>
                        </select>
                        <br>
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
                                
                                echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                            }
                            
                        ?>
                    </select>
                    <br>
                </div>
                <br>
                <input id="btn" type = "submit" value = " Hozzáad "/>
                <br>
            </form>
        </div>
        <br><br>
        <div id="menuOption">
            <input id="btn" type="button" value="Vissza"  onclick="window.location.href='./helynevek_menu.php'">
        </div>
    <br>
    <br>
    </div>
</body>
</html>

<?php
    mysqli_close($con);   
?>