<?php session_start(); ?>
<?php include '../includes/db_conn.php'; ?>
<?php include '../includes/charts_json_wrapper.php' ?>
<?php
	if(isset($_GET['sem'])){
		$roll_no = $_SESSION['uname'];
		$sem_no = $_GET['sem'];
		// $sem_no = 1;
		// $seat_no[0] = $sem_no;
		$sql = "SELECT course_name, ca_marks FROM student_theory_marks NATURAL JOIN courses WHERE seat_no = $seat_no AND semester_no = $sem_no;";
		$result = $conn->query($sql);
		$result_array = $result->fetchAll(PDO::FETCH_ASSOC);	
		$metadata = array(array("Course Name", "course_name", "string"), array("CA marks", "ca_marks", "number"));
		$string = returnJSONString($result_array, $metadata);
		echo $string;
	}
?>