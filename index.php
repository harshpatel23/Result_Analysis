<?php
session_start();
include 'includes/header.html';
if(!isset($_SESSION['uname'])){
	header("Location: login.php");
	}
?>
<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
          <?php
            if($_SESSION['user_type'] == 'student'){
              include 'filter_bar/filter_student.php';
            }elseif ($_SESSION['user_type'] == 'teacher') {
              include 'filter_bar/filter_teacher.php';
            }elseif ($_SESSION['user_type'] == 'hod') {
              include 'filter_bar/filter_hod.php';
            }elseif ($_SESSION['user_type'] == 'exam_section') {
              include 'filter_bar/filter_examcell.php';
            }
            elseif ($_SESSION['user_type'] == 'admin') {
              include 'filter_bar/filter_admin.php';
            }
          ?>
        </div>
    </div>
</div>

<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="float-left">
                    <div class="hamburger sidebar-toggle">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                </div>
                <div class="float-right">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
                <!-- /# column -->
<?php 
if ($_SESSION["user_type"] == "exam_section"){
    include "examcell/page-select.php";
} elseif ($_SESSION["user_type"] == "admin"){
    include "admin/page_select.php";
} else {
?>
           
            <!-- /# row -->
            <section id="main-content">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-title">
                                <h4>Course GPA</h4>

                            </div>
                            <div class="card-body">
                                <div id="col-chart"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-title pr">
                                <h4>Marks vs Number of Students</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr id="table-head">
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="table-body">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                        </div>
                    </div>
                <!-- <div class="row">
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <div id="pie-chart"></div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </section>
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
      chart.draw(data, {width: 600, height: 500, vAxis: { 
                title: "No of Students", 
                viewWindowMode:'explicit',
                viewWindow:{
                }
              }});
      make_table(jsonData);

    }else if (type_chart == 'pie_chart') {
      // var chart = new google.visualization.PieChart(document.getElementById('pie-chart'));
      // chart.draw(data, {width: 400, height: 400});
    }
  }

  function make_table(data) {
        console.log("Making Table");
        data = JSON.parse(data);
        num_cols = data["cols"].length;
        num_rows = data["rows"].length;

        $("#table-head").empty();
        $("#table-body").empty();

        for (var i = 0; i < num_cols; i++) {
            col_name = data["cols"][i]["label"];
            $("#table-head").append('<th scope="col">'+col_name+'</th>');
        }
        for (var i = 0; i < num_rows; i++) {
            row = "<tr>";
            for (var j = 0; j < num_cols; j++) {
                row_data = data["rows"][i]["c"][j]["v"];
                row += '<td>'+row_data+'</td>';
            }
            row += "</tr>";
            $("#table-body").append(row);
        }
    }
  </script>
<?php
}
include 'includes/footer.php';
?>