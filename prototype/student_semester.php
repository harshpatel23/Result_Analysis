<?php session_start(); ?>
<?php include '../includes/db_conn.php'; ?>
<?php include '../includes/charts_json_wrapper.php' ?>
<?php
	if(isset($_GET['sem'])){

		$roll_no = substr($_SESSION['uname'],1);  //After getting current sem data from database remove substring fn.
		$sem_no = $_GET['sem'];

		$seat_no = (string)$sem_no.(string)$roll_no;
		$sql = "SELECT course_id, ca_marks FROM student_theory_marks WHERE seat_no = $seat_no;";
		// echo $sql;
		// $sql = "SELECT course_name, ca_marks FROM student_theory_marks NATURAL JOIN courses WHERE seat_no = $seat_no AND semester_no = $sem_no;";
		$result = $conn->query($sql);
		$result_array = $result->fetchAll(PDO::FETCH_ASSOC);	
		$metadata = array(array("Course Name", "course_id", "string"), array("CA marks", "ca_marks", "number"));
		$string = returnJSONString($result_array, $metadata);
		echo $string;
	}
?>