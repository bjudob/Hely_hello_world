<!DOCTYPE html>
<html>
<?php
  include("../../config.php");
  $query = "SELECT * FROM `tajegyseg`";
          /*WHERE Is_Active=1";*/
  mysqli_query($con, $query);
  $result=mysqli_query($con,$query) or die('hiba');

  while($row=mysqli_fetch_array($result)){
      $id=$row['ID'];
      $nev=$row['Nev'];

      $tajegysegek[]=array("id"=>$id,"val"=>$nev);
  }

  $query = "SELECT * FROM `telepules`";
          /*WHERE Is_Active=1";*/
  mysqli_query($con, $query);
  $result=mysqli_query($con,$query) or die('hiba');

  while($row=mysqli_fetch_array($result)){
      $id=$row['ID'];
      $nev=$row['Nev'];

      $telepulesek[$row['Tajegyseg']][]=array("id"=>$id,"val"=>$nev);
  }

  $query = "SELECT * FROM `helynev`";
          /*WHERE Is_Active=1";*/
  mysqli_query($con, $query);
  $result=mysqli_query($con,$query) or die('hiba');

  while($row=mysqli_fetch_array($result)){
      $id=$row['ID'];
      $standard=$row['Standard'];
      $ejtes=$row['Ejtes'];
      $ragos_alak=$row['Ragos_Alak'];

      $helynevek[$row['Telepules']][]=array("id"=>$id,"standard"=>$standard,"ejtes"=>$ejtes,"ragos_alak"=>$ragos_alak);
  }

  $jsonTajegysegek = json_encode($tajegysegek);
  $jsonTelepulesek = json_encode($telepulesek);
  $jsonHelynevek = json_encode($helynevek);


?>

<?php
    include('../../navbar_lvl1.php');
?>

<head>
    <title>Helynevek</title>
    <link rel="stylesheet" type="text/css" href="../../css/helynevek_show.css">
    <link rel="stylesheet" type="text/css" href="../mainpage.css">

    <script src="jquery-3.2.1.min.js"></script>
    <script type='text/javascript'>
      <?php
        echo "var tajegysegek = $jsonTajegysegek; \n";
        echo "var telepulesek = $jsonTelepulesek; \n";
        echo "var helynevek = $jsonHelynevek; \n";
      ?>
      function loadTajegysegek(){
        var select = document.getElementById("tajegysegekSelect");
        select.onchange = updateTelepulesek;
        for(var i = 0; i < tajegysegek.length; i++){
          select.options[i] = new Option(tajegysegek[i].val,tajegysegek[i].id);          
        }
        updateTelepulesek();
      }
      function updateTelepulesek(){
        var tajegysegekSelect = document.getElementById("tajegysegekSelect");
        var id = tajegysegekSelect.value;
        var telepulesekSelect = document.getElementById("telepulesekSelect");
        telepulesekSelect.onchange = updateHelynevek;
        telepulesekSelect.options.length = 0; //delete all options if any present
        for(var i = 0; i < telepulesek[id].length; i++){
          telepulesekSelect.options[i] = new Option(telepulesek[id][i].val,telepulesek[id][i].id);
        }
        updateHelynevek();
      }
      function updateHelynevek(){
        var telepulesekSelect = document.getElementById("telepulesekSelect");
        var id = telepulesekSelect.value;

        var table = document.getElementById("helynevekTable");
        var rows = table.rows.length;

        for(var i=1;i<rows;i++){
            table.deleteRow(1);
        }

        for(var i = 0; i < helynevek[id].length; i++){
            var standard=helynevek[id][i].standard;

            // Create an empty <tr> element and add it to the 1st position of the table:
            var row = table.insertRow(1);

            // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
            var cell1 = row.insertCell(0);

            // Add some text to the new cells:
            cell1.innerHTML = standard;
        }
      }
    </script>
</head>
<body onload='loadTajegysegek()'>
    <div id="container">
        <div id="title">Helynevek</div>
        <br>
        <div id="telepules_select" style="margin: auto; text-align: center;font-size: 200%">
        <form action = "" method = "post">
            <label>Tájegység:</label>
            <select id='tajegysegekSelect' >
            </select>
            <br>
            <label>Település:</label>
            <select id='telepulesekSelect' >
            </select>
            <br>
        </form>
        </div>
        <br>
        <table id='helynevekTable'>
        <thead>
        <tr>
            <th>Standard</th>
            <th></th>
        </tr>
        </thead>
        <tbody id='helynevekTBody'>
        </tbody>
        </table>
        <br>
        <div id="menuOption"><input id="btn" type="button" value="Vissza"       onclick="window.location.href='./helynevek_menu.php'">
        </div>
        <br>
        <br>
    </div>


</body>
</html>