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

        $helynev= new Helynev();
        $helynev->setValues($standard, $telepules, $ejtes, "", $helyfajtaKod, $terkepszam, $ragosalak, $nyelv, $forrasmunkaadat, $forrasmunkaev, $forrasmunkatipus, $objektuminfo, $helyinfo, $nevvaltozatok, $termeszetes, $mikro);
                
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

</head>
<body>
    <div id="container">
        <br>
        <br>
        <div id="item">
            <form action = "" method = "post">
                <label>Standardizált helynév:</label><input type = "text" name = "standard" class="inputfield"/>
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
                        $query = "SELECT * FROM `helyfajta`";
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
                <label>Ragos alak:</label><input type = "text" name = "ragosalak" class="inputfield"/>
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
                <label>Forrásmunka adat:</label><input type = "text" name = "forrasmunkaadat" class="inputfield"/>
                <br>
                <label>Forrásmunka év:</label><input type = "text" name = "forrasmunkaev" class="inputfield"/>
                <br>
                <label>Forrásmunka típus/év:</label><input type = "text" name = "forrasmunkatipus" class="inputfield" />
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
                <select name="nevszerkezettipus">
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
                <label>Alaprész:</label>
                <select name="alapresz">
                    <?php
                        $query = "SELECT * FROM `nevresz`";
                                    /*WHERE Is_Active=1";*/
                        
                        $result=mysqli_query($con,$query) or die('hiba');

                        while($row=mysqli_fetch_array($result)){
                            $id=$row['ID'];
                            $nev=$row['Nev'];
                            $kod=$row['Kod'];

                            echo "<option value=".$id.">".$kod." ".$nev."</option>";
                        }
                        
                    ?>
                </select>
                <br>
                <label>ALM</label>
                <select name="alapresz_lex">
                    <?php
                        $query = "SELECT * FROM `lexikalis`";
                                    /*WHERE Is_Active=1";*/
                        
                        $result=mysqli_query($con,$query) or die('hiba');

                        while($row=mysqli_fetch_array($result)){
                            $id=$row['ID'];
                            $nev=$row['Nev'];
                            $kod=$row['Kod'];

                            echo "<option value=".$id.">".$kod." ".$nev."</option>";
                        }
                        
                    ?>
                </select>
                <br>
                <label>Bővítmény:</label>
                <select name="bovitmeny">
                    <?php
                        $query = "SELECT * FROM `nevresz`";
                                    /*WHERE Is_Active=1";*/
                        
                        $result=mysqli_query($con,$query) or die('hiba');

                        while($row=mysqli_fetch_array($result)){
                            $id=$row['ID'];
                            $nev=$row['Nev'];
                            $kod=$row['Kod'];

                            echo "<option value=".$id.">".$kod." ".$nev."</option>";
                        }
                        
                    ?>
                </select>
                <br>
                <label>BLM</label>
                <select name="bovitmeny_lex">
                    <?php
                        $query = "SELECT * FROM `lexikalis`";
                                    /*WHERE Is_Active=1";*/
                        
                        $result=mysqli_query($con,$query) or die('hiba');

                        while($row=mysqli_fetch_array($result)){
                            $id=$row['ID'];
                            $nev=$row['Nev'];
                            $kod=$row['Kod'];

                            echo "<option value=".$id.">".$kod." ".$nev."</option>";
                        }
                        
                    ?>
                </select>
                <br>
                <label>Névalkotási szabály:</label>
                <select name="bovitmeny">
                    <?php
                        $query = "SELECT * FROM `nevalkotasszabaly`";
                                    /*WHERE Is_Active=1";*/
                        
                        $result=mysqli_query($con,$query) or die('hiba');

                        while($row=mysqli_fetch_array($result)){
                            $id=$row['ID'];
                            $nev=$row['Nev'];
                            $kod=$row['Kod'];

                            echo "<option value=".$id.">".$kod." ".$nev."</option>";
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