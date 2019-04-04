<?php
include "../includes/header.html";
include '../includes/db_conn.php';

session_start();

if(!isset($_SESSION['uname']) || $_SESSION['uname'] !='admin'){
	header("Location: ../login.php");
}

if(isset($_POST['submit'])){
$t_id = $_POST['t_id'];
	$c_id = $_POST['course_id'];
	$year = $_POST['year'];
	$batch = $_POST['batch'];
	$c_type = $_POST['course_type'];

	$sql = "INSERT INTO teacher_to_courses VALUES($t_id,'".$c_id."',$year,'".$batch."','".$c_type."');";
	$result = $conn->query($sql);
	if($result){	
?>
		<div class="alert alert-success fade show" role="alert">
  			<strong>Success...! </strong>Data inserted
  			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    			<span aria-hidden="true">&times;</span>
  			</button>
		</div>
<?php
	}
}
?>

<div class="container-fluid">
	<div id=form class="row justify-content-center align-items-center">
	<form  class="form" id="teacher_student" action="" name="teacher_student" method="post">
	 <div class="form-group">
	 	<label for="t_id">Enter Teacher ID</label>
	 	<input id="t_id" title="Only digits allowed" type="text" class="form-control" name="t_id" autofocus=true required pattern="[0-9]{7}$">

	 	<label for="course_id">Enter Course ID</label>
	 	<input id="course_id" type="text" class="form-control" name="course_id" maxlength="10" minlength="10" required>

	 	<label for="year">Enter Year</label>
	 	<input id="year" type="text" class="form-control" name="year" maxlength ="4" minlength ="4" required>

	 	<label for="batch">Enter Batch</label>
	 	<input id="batch" type="text" class="form-control" name="batch" maxlength="2" minlength="1" required>

	 	<label for="course_type">Select Course Type:</label>
		<select class="form-control" id="course_type" name="course_type">
		  <option value="P">Practical</option>
		  <option value="T">Theory</option>
		</select>
		<br>
		<button value="submit" type="submit" class="btn btn-primary" name="submit">Submit</button>
	 </div>
	</form>
</div>
</div>

<?php
include "../includes/footer.html";
?>
