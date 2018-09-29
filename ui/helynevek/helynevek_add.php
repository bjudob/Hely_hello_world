<?php
    include("../../config.php");
    require ("../../db/HelynevDatabase.php");
        
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

        $helynev= new Helynev();
        $helynev->setValues(
                $standard, 
                $telepules, 
                $ejtes, 
                "", 
                $helyfajtaKod, 
                $terkepszam, 
                $ragosalak, 
                $nyelv, 
                $forrasmunkaadat,
                $forrasmunkaev, 
                $forrasmunkatipus, 
                $objektuminfo, 
                $helyinfo, 
                $nevvaltozatok, 
                $termeszetes, 
                $mikro,
                $nevszerkezet,
                $r,
                $lm,
                $t,
                $ar,
                $alm,
                $at,
                $br,
                $blm,
                $bt,
                $nevalkotasiszabaly);
                
        $db=new HelynevDatabase();
                
        $db->addHelynev($helynev);
          
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
        </script>
        
</head>
<body>
    <div id="container">
        <br>
        <br>
        <div id="item">
            <form action = "" method = "post">
                <label>Standard: </label><input type = "text" name = "standard" class="inputfield"/>
                <br>
                <label>Település:</label>
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
                <label>Ejtés:</label><input type = "text" name = "ejtes" class="inputfield"/>
                <br>
                <label>Helyfajta:</label>
                <select name="helyfajta">
                    <?php
                        $query = "SELECT * FROM `helyfajta` ORDER BY Kod";
                                    /*WHERE Is_Active=1";*/
                        
                        $result=mysqli_query($con,$query) or die('hiba');

                        while($row=mysqli_fetch_array($result)){
                                $id=$row['ID'];
                                $nev=$row['Nev'];
                                $kod=$row['Kod'];
                                $bold="none";

                                if (strpos($kod, '.') == false) {
                                    $bold="boldoption";
                                }

                                echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                            }

                    ?>
                </select>
                <br>
                <label>Térképszám:</label><input type = "text" name = "terkepszam" class="inputfield"/>
                <br>
                <label>Helyrag:</label><input type = "text" name = "ragosalak" class="inputfield"/>
                <br>
                <label>Nyelv:</label>
                <select name="nyelv">
                    <?php
                        $query = "SELECT * FROM `nyelv`";
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
                <label>Forrásdat:</label><input type = "text" name = "forrasmunkaadat" class="inputfield"/>
                <br>
                <label>Forrásdat éve:</label><input type = "text" name = "forrasmunkaev" class="inputfield"/>
                <br>
                <label>Forrás és éve:</label><input type = "text" name = "forrasmunkatipus" class="inputfield" />
                <br>
                <label>Objektum info:</label><input type = "text" name = "objektuminfo" class="inputfield" />
                <br>
                <label>Név info:</label><input type = "text" name = "helyinfo" class="inputfield"/>
                <br>
                <label>Névváltozatok:</label><input type = "text" name = "nevvaltozatok"/>
                <br>
                <label>Természetes:</label>
                <select name="termeszetes">
                    <option value=1>Természetes</option>
                    <option value=0>Mesterséges</option>
                </select>
                <br>
                <label>Mikro/makro:</label>
                <select name="mikro">
                    <option value=1>Mikronév</option>
                    <option value=0>Makronév</option>
                </select>
                <br>
                <label>Névszerkezettípus:</label>
                <select name="nevszerkezet" id="nevszerkezet">
                    <?php
                        $query = "SELECT * FROM `nevszerkezettipus`";
                                    /*WHERE Is_Active=1";*/
                        
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
                <div id="egyreszes" >
                <label>FSZ</label>
                <select name="r">
                    <?php
                        $query = "SELECT * FROM `nevresz`";
                                    /*WHERE Is_Active=1";*/
                        
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
                <label>LM</label>
                <select name="lm">
                    <?php
                        $query = "SELECT * FROM `lexikalis`";
                                    /*WHERE Is_Active=1";*/
                        
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
                <label>Toldalék</label>
                <select name="t">
                    <?php
                        $query = "SELECT * FROM `toldalek`";
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
                <div id="ketreszes" >
                <label>Alaprész:</label>
                <select name="ar">
                    <?php
                        $query = "SELECT * FROM `nevresz`";
                                    /*WHERE Is_Active=1";*/
                        
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
                <label>ALM</label>
                <select name="alm">
                    <?php
                        $query = "SELECT * FROM `lexikalis`";
                                    /*WHERE Is_Active=1";*/
                        
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
                <label>AT</label>
                <select name="at">
                    <?php
                        $query = "SELECT * FROM `toldalek`";
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
                <label>Bővítményrész:</label>
                <select name="br">
                    <?php
                        $query = "SELECT * FROM `nevresz`";
                                    /*WHERE Is_Active=1";*/
                        
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
                <label>BLM</label>
                <select name="blm">
                    <?php
                        $query = "SELECT * FROM `lexikalis`";
                                    /*WHERE Is_Active=1";*/
                        
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
                <label>BT</label>
                <select name="bt">
                    <?php
                        $query = "SELECT * FROM `toldalek`";
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
                <br>
                <label>Névalkotási szabály:</label>
                <select name="nevalkotasiszabaly">
                    <?php
                        $query = "SELECT * FROM `nevalkotasszabaly`";
                                    /*WHERE Is_Active=1";*/
                        
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
                <br>
                <input id="btn" type = "submit" value = " Hozzáad "/>
                <br>
            </form>
        </div>
        <br><br>
        <div id="menuOption"
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