<?php
include 'includes/header.html';
session_start();
	if(!isset($_SESSION['uname'])){
	header("Location: login.php");
	}
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3" id="filter">
			<?php
				if($_SESSION['user_type'] == 'student'){
					include 'filter_bar/filter_student.php';
				}elseif ($_SESSION['user_type'] == 'teacher') {
          include 'filter_bar/filter_teacher.php';
        }elseif ($_SESSION['user_type'] == 'hod') {
          include 'filter_bar/filter_hod.php';
        }
			?>
		</div>	
		<div  class="col-sm-9 container-fluid">
      <div class="row">
        <div id="col-chart"></div>
      <div id="bar-chart"></div>
      </div>
      
		</div>
	</div>
</div>
<script type="text/javascript">
	// Load the Visualization API and the piechart package.

    
  google.charts.load('current', {'packages':['corechart']});

  function refreshChart(url_path, type_chart){
  	var jsonData = $.ajax({
      url: url_path,
      dataType: "json",
      async: false
      }).responseText;
  	// Create our data table out of JSON data loaded from server.
    console.log(jsonData);
    var data = new google.visualization.DataTable(jsonData);

    // Instantiate and draw our chart, passing in some options.
    if (type_chart == 'column_chart') {
      var chart = new google.visualization.ColumnChart(document.getElementById('col-chart'));
      chart.draw(data, {width: 500, height: 500, vAxis: { 
                title: "No of Students", 
                viewWindowMode:'explicit',
                viewWindow:{
                }
              }});
    }else if (type_chart == 'pie_chart') {
      var chart = new google.visualization.PieChart(document.getElementById('bar-chart'));
      chart.draw(data, {width: 600, height: 600});
    }
  }
  </script>
<?php
include 'includes/footer.php';
?>