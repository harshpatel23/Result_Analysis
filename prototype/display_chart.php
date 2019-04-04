<?php include '../includes/header.html'; ?>
  <!--Div that will hold the chart-->
  <div id="chart_div"></div>
  <div id="piechart"></div>
  <a href="./generic_class.php?filter_condition=CGPA"><button class="btn btn-primary">Back</button></a>
  <script type="text/javascript">
  
  // Load the Visualization API and the piechart package.
  google.charts.load('current', {'packages':['corechart']});
    
  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);
  // url "generic_class.php/filter_condition=CGPA"
  function drawChart() {
    var jsonData = $.ajax({
        url: "teacher_filter.php?filter_condition=ESE",
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
                max:50,
                min:0
              }
            }});

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, {width: 800, height: 800});
  }
  </script>
<?php include '../includes/footer.html'; ?>