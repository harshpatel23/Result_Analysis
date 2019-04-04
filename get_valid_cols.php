<?php
include 'includes/db_conn.php';
if(isset($_GET["course_id"])) {
	$course_id = $_GET["course_id"];

	$sql = "SELECT * from course_total_marks WHERE course_id = \"$course_id\";";
	$result = $conn->query($sql);
	$data = $result->fetch(PDO::FETCH_ASSOC);

	$arr = array();
	foreach ($data as $key => $value) {
		if($value != NULL && $value != $course_id)
			array_push($arr, $key);
	}
	echo json_encode($arr);
}

?>
