<?php
include 'includes/header.html';
session_start();
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
                    <!-- Login logout button -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1>Hello, <span>Welcome Here</span></h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Home</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
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

                            <div class="card-body">
                                <div id="bar-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title pr">
                                <h4>All Exam Result</h4>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table student-data-table m-t-20">
                                        <thead>
                                            <tr>
                                                <th><label><input type="checkbox" value=""></label>Exam Name</th>
                                                <th>Subject</th>
                                                <th>Grade Point</th>
                                                <th>Percent Form</th>
                                                <th>Percent Upto</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Class Test</td>
                                                <td>Mathmatics</td>
                                                <td>
                                                    4.00
                                                </td>
                                                <td>
                                                    95.00
                                                </td>
                                                <td>
                                                    100
                                                </td>
                                                <td>20/04/2017</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
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
      var chart = new google.visualization.PieChart(document.getElementById('bar-chart'));
      chart.draw(data, {width: 400, height: 400});
    }
  }

  function make_table(data) {
    console.log(jsonData);
  }
  </script>
<?php
include 'includes/footer.php';
?>