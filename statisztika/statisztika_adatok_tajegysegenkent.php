<!DOCTYPE html>
<html>
<?php
    include('../navbar_lvl1.php');
?>
<head>
    <title>Statisztika</title>
    <link rel="stylesheet" type="text/css" href="statisztika_show.css">
    <link rel="stylesheet" type="text/css" href="../mainpage.css">
</head>
<body>
    <div id="container">
        <div id="title" >Statisztika</div>
        <br><br>
        
        <div id="piechart"></div>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <script type="text/javascript">
        // Load google charts
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work', 8],
          ['Eat', 2],
          ['TV', 4],
          ['Gym', 2],
          ['Sleep', 8]
        ]);

          // Optional; add a title and set the width and height of the chart
          var options = {'title':'Tájegységek szerinti adateloszlás', 'width':550, 'height':400};

          // Display the chart inside the <div> element with id="piechart"
          var chart = new google.visualization.PieChart(document.getElementById('piechart'));
          chart.draw(data, options);
        }
        </script>

        <br>
        <br>
        <div id="menuOption"><input id="btn" type="button" value="Vissza"       onclick="window.location.href='./statisztika_menu.php'">
        </div>
        <br>
        <br>
    </div>


</body>
</html>