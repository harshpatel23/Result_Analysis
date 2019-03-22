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
				}
			?>
		</div>	
		<div  class="col-sm-9" id="display">
			<?php
			echo $_SESSION['uname'];
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
	// Load the Visualization API and the piechart package.
	google.charts.load('current', {'packages':['corechart']});


  function refreshChart(url_path){
  	var jsonData = $.ajax({
      url: url_path,
      dataType: "json",
      async: false
      }).responseText;

  	// Create our data table out of JSON data loaded from server.
    console.log(jsonData);
    var data = new google.visualization.DataTable(jsonData);

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.ColumnChart(document.getElementById('display'));
    chart.draw(data, {width: 800, height: 800, vAxis: { 
              title: "CA Marks", 
              viewWindowMode:'explicit',
              viewWindow:{
                max:50,
                min:0
              }
            }});
  }



  // // Load the Visualization API and the piechart package.
  // google.charts.load('current', {'packages':['corechart']});
    
  // // Set a callback to run when the Google Visualization API is loaded.
  // google.charts.setOnLoadCallback(drawChart);
  // // url "generic_class.php/filter_condition=CGPA"
  // function drawChart() {
  //   var jsonData = $.ajax({
  //       url: "student_semester.php",
  //       dataType: "json",
  //       async: false
  //       }).responseText;
        
  //   // Create our data table out of JSON data loaded from server.
  //   console.log(jsonData);
  //   var data = new google.visualization.DataTable(jsonData);

  //   // Instantiate and draw our chart, passing in some options.
  //   var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
  //   chart.draw(data, {width: 800, height: 800, vAxis: { 
  //             title: "CA Marks", 
  //             viewWindowMode:'explicit',
  //             viewWindow:{
  //               max:50,
  //               min:0
  //             }
  //           }});

    // var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    // chart.draw(data, {width: 800, height: 800});
  // }
  </script>
<?php
include 'includes/footer.html';
?>