<?php
    include("../../config.php");
    require ("../../db/HelynevDatabase.php");
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    
    if (isset($_POST['update_button'])) {
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        
        $id = mysqli_real_escape_string($con, $_GET['id']);;
        $standard = mysqli_real_escape_string($con, $_POST['standard']);
        $ejtes = mysqli_real_escape_string($con, $_POST['ejtes']);
        $helyfajta = mysqli_real_escape_string($con, $_POST['helyfajta']);
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
        $nevszerkezet = mysqli_real_escape_string($con, $_POST['nevszerkezet']);
        $r = mysqli_real_escape_string($con, $_POST['r']);
        $lm = mysqli_real_escape_string($con, $_POST['lm']);
        $t = mysqli_real_escape_string($con, $_POST['t']);
        $ar = mysqli_real_escape_string($con, $_POST['ar']);
        $alm = mysqli_real_escape_string($con, $_POST['alm']);
        $at = mysqli_real_escape_string($con, $_POST['at']);
        $br = mysqli_real_escape_string($con, $_POST['br']);
        $blm = mysqli_real_escape_string($con, $_POST['blm']);
        $bt = mysqli_real_escape_string($con, $_POST['bt']);
        $nevalkotasiszabaly = mysqli_real_escape_string($con, $_POST['nevalkotasiszabaly']);

        
        
        $helynev=new Helynev();
        $helynev->setValues(
                $standard, 
                0, 
                $ejtes, 
                0, 
                $helyfajta, 
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
                $nevalkotasiszabaly
                );
        $helynev->id=$id;
                
        $db=new HelynevDatabase();
        $db->updateHelynev($helynev);
        
        //header('location: ' . $_SERVER['HTTP_REFERER']);
        //header("location:javascript://history.go(-2)");
        header("location: ". $_SESSION["backlink"]);
        exit;
    } 
    else if (isset($_POST['delete_button'])) {
        if ($con->connect_error) {
            die("Az adatbázis nem elérhető: " . $conn->connect_error);
        }

        $id = mysqli_real_escape_string($con, $_GET['id']);;

        $db=new HelynevDatabase();
        $db->deleteHelynev($id);

        header("location: ". $_SESSION["backlink"]);
        exit;
    } 
    else if (isset($_POST['back_button'])) {
        //header("location: helynevek_show.php");
    } 
    else {
        //no button pressed
    }
    $_SESSION["backlink"] = $_SERVER['HTTP_REFERER'];

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
                
                var element = document.getElementById('nevszerkezet');
                var event = new Event('change');
                element.dispatchEvent(event);
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
    <div id="container">
        <br><br>
        <div id="item">
            <form action = "" method = "post">
                <label id="smallLabel">Standard:</label><input id="standardInput" type = "text" name = "standard" class="inputfield" value="<?php echo $helynev->standard; ?>"/>
                <br>
                <label></label>
                <input class="charButton" value="¹" type = "button" onclick="addIndex('¹');"></button>
                <input class="charButton" value="²" type = "button" onclick="addIndex('²');"></button>
                <input class="charButton" value="³" type = "button" onclick="addIndex('³');"></button>
                <br>
                <label id="smallLabel">Település:</label><input type = "text" name = "telepules" class="inputfield" value="<?php echo $helynev->telepules; ?>" disabled/>
                <br>
                <label id="smallLabel">Ejtés:</label><input id="ejtesInput" type = "text" name = "ejtes" class="inputfield" value="<?php echo $helynev->ejtes; ?>"/>
                <br>
                <label></label>
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
                <label id="smallLabel">Helyfajta:</label>
                <select name="helyfajta">
                    <?php
                        $query = "SELECT * FROM `helyfajta` ORDER BY Kod";
                        
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
                            if($helyfajta_option===$helynev->helyfajtaNev){
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

                    ?>
                </select>
                <br>
                <label id="smallLabel">Forrásadat:</label><input type = "text" name = "forrasmunkaadat" class="inputfield" value="<?php echo $helynev->forrasmunkaadat; ?>"/>
                <br>
                <label id="smallLabel">Forrásadat éve:</label><input type = "text" name = "forrasmunkaev" class="inputfield" value="<?php  echo $helynev->forrasmunkaev; ?>"/>
                <br>
                <label id="smallLabel">Forrás és éve:</label><input type = "text" name = "forrasmunkatipus" class="inputfield" value="<?php  echo $helynev->forrasmunkatipus; ?>"/>
                <br>
                <label id="smallLabel">Objektum info:</label><input type = "text" name = "objektuminfo" class="inputfield" value="<?php  echo $helynev->objektuminfo; ?>"/>
                <br>
                <label id="smallLabel">Név info:</label><input type = "text" name = "helyinfo" class="inputfield" value="<?php  echo $helynev->helyinfo; ?>"/>
                <br>
                <label id="smallLabel">Névváltozatok:</label><input type = "text" name = "nevvaltozatok" value="<?php  echo $helynev->nevvaltozatok; ?>"/>
                <br>
                <label id="smallLabel">Természetes:</label>
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
                <label id="smallLabel">Mikro/makro:</label>
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
                <label id="smallLabel">Névszerkezettípus:</label>
                <select name="nevszerkezet" id="nevszerkezet">
                    <?php
                        $query = "SELECT * FROM `nevszerkezettipus`";
                        
                        $result=mysqli_query($con,$query) or die('hiba');

                        while($row=mysqli_fetch_array($result)){
                            $id=$row['ID'];
                            $nev=$row['Nev'];
                            $egyreszes=$row['Egyreszes'];


                            if($id===$helynev->nevszerkezet){
                                    echo "<option selected='selected' value=".$id.">".$nev."</option>";
                            }
                            else{
                                echo "<option value=".$id.">".$nev."</option>";
                            }
                        }
                        
                    ?>
                </select>
                <br>
                <div id="egyreszes" >
                <label id="smallLabel">FSZ</label>
                <select name="r">
                    <?php
                        $query = "SELECT * FROM `nevresz`";
                        
                        $result=mysqli_query($con,$query) or die('hiba');

                        while($row=mysqli_fetch_array($result)){
                            $id=$row['ID'];
                            $nev=$row['Nev'];
                            $kod=$row['Kod'];
                            $bold="none";

                            if (strlen($kod) == 2) {
                                $bold="boldoption";
                            }
                            
                            if($id===$helynev->r){
                                echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                            }
                            else{
                                echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                            }
                        }
                        
                    ?>
                </select>
                <br>
                <label id="smallLabel">LM</label>
                <select name="lm">
                    <?php
                        $query = "SELECT * FROM `lexikalis`";
                        
                        $result=mysqli_query($con,$query) or die('hiba');

                        while($row=mysqli_fetch_array($result)){
                            $id=$row['ID'];
                            $nev=$row['Nev'];
                            $kod=$row['Kod'];
                            $bold="none";

                            if (strlen($kod) == 2) {
                                $bold="boldoption";
                            }
                            
                            if($id===$helynev->lm){
                                echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                            }
                            else{
                                echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                            }
                        }
                        
                    ?>
                </select>
                <br>
                <label id="smallLabel">Toldalék</label>
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
                            
                            if($id===$helynev->t){
                                echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                            }
                            else{
                                echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                            } 
                        }
                        
                    ?>
                </select>
                <br>
                </div>
                <div id="ketreszes" >
                <label id="smallLabel">Alaprész:</label>
                <select name="ar">
                    <?php
                        $query = "SELECT * FROM `nevresz`";
                        
                        $result=mysqli_query($con,$query) or die('hiba');

                        while($row=mysqli_fetch_array($result)){
                            $id=$row['ID'];
                            $nev=$row['Nev'];
                            $kod=$row['Kod'];
                            $bold="none";

                            if (strlen($kod) == 2) {
                                $bold="boldoption";
                            }
                            
                            if($id===$helynev->ar){
                                echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                            }
                            else{
                                echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                            }
                        }
                        
                    ?>
                </select>
                <br>
                <label id="smallLabel">ALM</label>
                <select name="alm">
                    <?php
                        $query = "SELECT * FROM `lexikalis`";
                        
                        $result=mysqli_query($con,$query) or die('hiba');

                        while($row=mysqli_fetch_array($result)){
                            $id=$row['ID'];
                            $nev=$row['Nev'];
                            $kod=$row['Kod'];
                            $bold="none";

                            if (strlen($kod) == 2) {
                                $bold="boldoption";
                            }
                            
                            if($id===$helynev->alm){
                                echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                            }
                            else{
                                echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                            }
                        }
                        
                    ?>
                </select>
                <br>
                <label id="smallLabel">AT</label>
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
                            
                            if($id===$helynev->at){
                                echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                            }
                            else{
                                echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                            }
                        }
                        
                    ?>
                </select>
                <br>
                <label id="smallLabel">Bővítményrész:</label>
                <select name="br">
                    <?php
                        $query = "SELECT * FROM `nevresz`";
                        
                        $result=mysqli_query($con,$query) or die('hiba');

                        while($row=mysqli_fetch_array($result)){
                            $id=$row['ID'];
                            $nev=$row['Nev'];
                            $kod=$row['Kod'];
                            $bold="none";

                            if (strlen($kod) == 2) {
                                $bold="boldoption";
                            }
                            
                            if($id===$helynev->br){
                                echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                            }
                            else{
                                echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                            }
                        }
                        
                    ?>
                </select>
                <br>
                <label id="smallLabel">BLM</label>
                <select name="blm">
                    <?php
                        $query = "SELECT * FROM `lexikalis`";
                        
                        $result=mysqli_query($con,$query) or die('hiba');

                        while($row=mysqli_fetch_array($result)){
                            $id=$row['ID'];
                            $nev=$row['Nev'];
                            $kod=$row['Kod'];
                            $bold="none";

                            if (strlen($kod) == 2) {
                                $bold="boldoption";
                            }
                            
                            if($id===$helynev->blm){
                                echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                            }
                            else{
                                echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                            }
                           
                        }
                        
                    ?>
                </select>
                <br>
                <label id="smallLabel">BT</label>
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
                            
                            if($id===$helynev->bt){
                                echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                            }
                            else{
                                echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                            }
                        }
                        
                    ?>
                </select>
                </div>
                <br>
                <label id="smallLabel">Névalkotási szabály:</label>
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
                            
                            if($id===$helynev->nevalkotasiszabaly){
                                echo "<option class='$bold' selected='selected' value=".$id.">".$kod." ".$nev."</option>";
                            }
                            else{
                                echo "<option class='$bold' value=".$id.">".$kod." ".$nev."</option>";
                            }
                        }
                        
                    ?>
                </select>
                <br>             
                <br>
                <input id="btn" type = "submit"  name="update_button" value = " Módosítás "/>
                <input id="btn" type = "submit"  name="delete_button" value = " Törlés "/>
                <br><br>
                <input id="btn" onclick="history.back()" name="back_button" value = " Vissza "/>
            </form>
        </div>
        <br>
        <br
    </div>
</body>
</html>