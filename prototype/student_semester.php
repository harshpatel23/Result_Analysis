<?php include '../includes/db_conn.php'; ?>
<?php include '../includes/charts_json_wrapper.php' ?>
<?php
	$seat_no = "11811001";
	$sem_no = $seat_no[0];
	$sql = "SELECT course_name, ca_marks FROM student_theory_marks NATURAL JOIN courses WHERE seat_no = $seat_no AND semester_no = $sem_no;";
	$result = $conn->query($sql);
	$result_array = $result->fetchAll(PDO::FETCH_ASSOC);	
	$metadata = array(array("Course Name", "course_name", "string"), array("CA marks", "ca_marks", "number"));
	$string = returnJSONString($result_array, $metadata);
	echo $string;
?>