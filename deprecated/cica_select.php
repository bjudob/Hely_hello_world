<?php
  include("../config.php");
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
      $nev=$row['Standard'];

      $helynevek[$row['Telepules']][]=array("id"=>$id,"val"=>$nev);
  }

  $jsonTajegysegek = json_encode($tajegysegek);
  $jsonTelepulesek = json_encode($telepulesek);
  $jsonHelynevek = json_encode($helynevek);


?>

<!docytpe html>
<html>

  <head>
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
        var helynevekSelect = document.getElementById("helynevekSelect");
        helynevekSelect.options.length = 0; //delete all options if any present
        for(var i = 0; i < helynevek[id].length; i++){
          helynevekSelect.options[i] = new Option(helynevek[id][i].val,helynevek[id][i].id);
        }
      }
    </script>

  </head>

  <body onload='loadTajegysegek()'>
    <select id='tajegysegekSelect'>
    </select>

    <select id='telepulesekSelect'>
    </select>

    <select id='helynevekSelect'>
    </select>
  </body>
</html>