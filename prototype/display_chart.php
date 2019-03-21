<?php include '../includes/header.html'; ?>
  <!--Div that will hold the chart-->
  <div id="chart_div"></div>
  <a href="./php_class_test.php"><button class="btn btn-primary">Back</button></a>
  <script type="text/javascript">
  
  // Load the Visualization API and the piechart package.
  google.charts.load('current', {'packages':['corechart']});
    
  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);
    
  function drawChart() {
    var jsonData = $.ajax({
        url: "php_class_test.php",
        dataType: "json",
        async: false
        }).responseText;
        
    // Create our data table out of JSON data loaded from server.
    console.log(json);
    var data = new google.visualization.DataTable(jsonData);

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, {width: 400, height: 240});
  }
  </script>
<?php include '../includes/footer.html'; ?>