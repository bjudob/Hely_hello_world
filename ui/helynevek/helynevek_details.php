<?php
    include("../../config.php");
    require ("../../db/HelynevDatabase.php");
            
    if (isset($_POST['update_button'])) {
        
        $id = mysqli_real_escape_string($con, $_GET['id']);;
        $standard = mysqli_real_escape_string($con, $_POST['standard']);
        $ejtes = mysqli_real_escape_string($con, $_POST['ejtes']);
        $terkepszam = mysqli_real_escape_string($con, $_POST['terkepszam']);
        $ragosalak = mysqli_real_escape_string($con, $_POST['ragosalak']);
        $forrasmunkaadat = mysqli_real_escape_string($con, $_POST['forrasmunkaadat']);
        $forrasmunkaev = mysqli_real_escape_string($con, $_POST['forrasmunkaev']);
        $forrasmunkatipus = mysqli_real_escape_string($con, $_POST['forrasmunkatipus']);
        $objektuminfo = mysqli_real_escape_string($con, $_POST['objektuminfo']);
        $helyinfo = mysqli_real_escape_string($con, $_POST['helyinfo']);
        $nevvaltozatok = mysqli_real_escape_string($con, $_POST['nevvaltozatok']);
        $termeszetes = mysqli_real_escape_string($con, $_POST['termeszetes']);
        $mikro = mysqli_real_escape_string($con, $_POST['mikro']);
        
        $helynev=new Helynev();
        $helynev->setValues(
                $standard, 
                0, 
                $ejtes, 
                0, 
                0, 
                $terkepszam, 
                $ragosalak, 
                0, 
                $forrasmunkaadat, 
                $forrasmunkaev, 
                $forrasmunkatipus, 
                $objektuminfo, 
                $helyinfo, 
                $nevvaltozatok, 
                $termeszetes,
                $mikro,
                0,
                0,
                0,
                0,
                0,
                0,
                0
                );
        $helynev->id=$id;
                
        $db=new HelynevDatabase();
        $db->updateHelynev($helynev);
        
        header("location: helynevek_show.php");
    } 
    else if (isset($_POST['delete_button'])) {
        if ($con->connect_error) {
            die("Az adatbázis nem elérhető: " . $conn->connect_error);
        }

        $id = mysqli_real_escape_string($con, $_GET['id']);;

        $db=new HelynevDatabase();
        $db->deleteHelynev($id);

        header("location: helynevek_show.php");
    } 
    else if (isset($_POST['back_button'])) {
        header("location: helynevek_show.php");
    } 
    else {
        //no button pressed
    }

    $db=new HelynevDatabase();
                
    $helynev=$db->getHelynev($_GET["id"]);
?>

<!DOCTYPE html>
<html>
<?php
    include('../../navbar_lvl1.php');
?>
<head>
    <title>Törlés</title>
    <link rel="stylesheet" type="text/css" href="../../css/mainpage.css">
    <link rel="stylesheet" type="text/css" href="../../css/helynevek_show.css">
</head>
<body>
    <div id="container">
        <br><br>
        <div id="item">
            <form action = "" method = "post">
                <label id="smallLabel">Standard:</label><input type = "text" name = "standard" class="inputfield" value="<?php echo $helynev->standard; ?>"/>
                <br>
                <label id="smallLabel">Település:</label><input type = "text" name = "telepules" class="inputfield" value="<?php echo $helynev->telepules; ?>" disabled/>
                <br>
                <label id="smallLabel">Ejtés:</label><input type = "text" name = "ejtes" class="inputfield" value="<?php echo $helynev->ejtes; ?>"/>
                <br>
                <label id="smallLabel">Helyfajta:</label>
                <select name="helyfajta">
                    <?php
                        $query = "SELECT * FROM `helyfajta`";
                                    /*WHERE Is_Active=1";*/
                        mysqli_query($con, $query);
                        $result=mysqli_query($con,$query) or die('hiba');

                        while($row=mysqli_fetch_array($result)){
                            $id=$row['ID'];
                            $helyfajta_option=$row['Nev'];
                            $kod=$row['Kod'];

                            $bold="none";

                            if (strpos($kod, '.') == false) {
                                $bold="boldoption";
                            }
                            if($helyfajta_option==$helynev->helyfajtaNev){
                                echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$helyfajta_option."</option>";
                            }
                            else{
                                echo "<option class='$bold' value=".$id.">".$kod." ".$helyfajta_option."</option>";
                            }
                        }
                    ?>
                </select>
                <br>
                <label id="smallLabel">Térképszám:</label><input type = "text" name = "terkepszam" class="inputfield" value="<?php echo $helynev->terkepszam; ?>"/>
                <br>
                <label id="smallLabel">Helyrag:</label><input type = "text" name = "ragosalak" class="inputfield" value="<?php echo $helynev->ragosalak; ?>"/>
                <br>
                <label id="smallLabel">Nyelv:</label>
                <select name="nyelv">
                    <?php
                        $query = "SELECT * FROM `nyelv`";
                                    /*WHERE Is_Active=1";*/
                        mysqli_query($con, $query);
                        $result=mysqli_query($con,$query) or die('hiba');

                        while($row=mysqli_fetch_array($result)){
                            $id=$row['ID'];
                            $nyelv_option=$row['Nev'];

                            if($nyelv_option==$helynev->nyelv){
                                    echo "<option selected='selected' value=".$id.">".$nyelv_option."</option>";
                            }
                            else{
                                echo "<option value=".$id.">".$nyelv_option."</option>";
                            }
                        }

                        mysqli_close($con);

                    ?>
                </select>
                <br>
                <label id="smallLabel">Forrásadat:</label><input type = "text" name = "forrasmunkaadat" class="inputfield" value="<?php echo $helynev->forrasmunkaadat; ?>"/>
                <br>
                <label id="smallLabel">Forrásdat éve:</label><input type = "text" name = "forrasmunkaev" class="inputfield" value="<?php  echo $helynev->forrasmunkaev; ?>"/>
                <br>
                <label id="smallLabel">Forrás és éve:</label><input type = "text" name = "forrasmunkatipus" class="inputfield" value="<?php  echo $helynev->forrasmunkatipus; ?>"/>
                <br>
                <label id="smallLabel">Objektum info:</label><input type = "text" name = "objektuminfo" class="inputfield" value="<?php  echo $helynev->objektuminfo; ?>"/>
                <br>
                <label id="smallLabel">Név info:</label><input type = "text" name = "helyinfo" class="inputfield" value="<?php  echo $helynev->helyinfo; ?>"/>
                <br>
                <label id="smallLabel">Névváltozatok:</label><input type = "text" name = "nevvaltozatok" value="<?php  echo $helynev->nevvaltozatok; ?>"/>
                <br>
                <label>Természetes:</label>
                <select name="termeszetes">
                    <?php
                        if($helynev->termeszetes!=0){
                            echo "<option selected='selected' value=1>Természetes</option>".
                                  "<option value=0>Mesterséges</option>";
                        }
                        else{
                            echo "<option value=1>Természetes</option>".
                                 "<option selected='selected' value=0>Mesterséges</option>";
                        }
                    ?>
                </select>
                <br>
                <label>Mikro/makro:</label>
                <select name="mikro">
                    <?php
                        if($helynev->mikro!=0){
                            echo "<option selected='selected' value=1>Mikronév</option>".
                                  "<option value=0>Makronév</option>";
                        }
                        else{
                            echo "<option value=1>Mikronév</option>".
                                  "<option selected='selected' value=0>Makronév</option>";
                        }
                    ?>
                    
                </select>
                <br>
                <br>
                <input id="btn" type = "submit"  name="update_button" value = " Módosítás "/>
                <input id="btn" type = "submit"  name="delete_button" value = " Törlés "/>
                <br><br>
                <input id="btn" type = "submit"  name="back_button" value = " Vissza "/>
            </form>
        </div>
        <br>
        <br>
    </div>
</body>
</html>