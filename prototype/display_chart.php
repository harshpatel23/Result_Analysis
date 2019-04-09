<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
    </script>
    <title>Result Analysis</title>
  </head>
  <body>
  <!--Div that will hold the chart-->
  <div id="chart_div"></div>
  <!-- <div id="piechart"></div> -->
  <a href="./generic_class.php?filter_condition=CGPA"><button class="btn btn-primary">Back</button></a>
  <script type="text/javascript">
  
  // Load the Visualization API and the piechart package.
  google.charts.load('current', {'packages':['corechart']});
    
  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);
  // url "generic_class.php/filter_condition=CGPA"
  function drawChart() {
    var jsonData = $.ajax({
        url: "temp.php",
        dataType: "json",
        async: false
        }).responseText;
        
    // Create our data table out of JSON data loaded from server.
    console.log(jsonData);
    var data = new google.visualization.DataTable(jsonData);

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data, {width: 800, height: 800, vAxis: { 
              title: "CA Marks", 
              viewWindowMode:'explicit',
              viewWindow:{
              }
            }});
/*
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, {width: 800, height: 800});*/
  }
  </script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
    crossorigin="anonymous"></script>
  </body>
</html>
