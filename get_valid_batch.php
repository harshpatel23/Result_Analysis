<?php
include 'includes/db_conn.php';

if(isset($_GET["course_id"])) {
	if($_GET["course_id"] == "ALL"){
		$condition= "course_id LIKE '%'";
	}else{
		$condition = "course_id = '".$_GET["course_id"] . "'";
	}
	$sql = "select distinct substring(seat_no, 2, 2) as batch from student_theory_marks where $condition order by batch desc";
	$result = $conn->query($sql);
	$data = $result->fetchall(PDO::FETCH_ASSOC);
	echo json_encode($data, JSON_PRETTY_PRINT);
}
else{
	echo json_encode([]);
}
?>