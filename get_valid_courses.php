<?php
include 'includes/db_conn.php';

if(isset($_GET["teacher_id"])) {
	$data = array();
	if($_GET["teacher_id"] == "ALL"){
		$condition= "teacher_id LIKE '%'";
		$data[] = array("course_id" => "ALL", "type" => "");
	}else{
		$condition = "teacher_id = '".$_GET["teacher_id"] . "'";
	}
	$sql = "select distinct course_id, type from teacher_to_courses where $condition order by type desc";
	$result = $conn->query($sql);
	$sql_data = $result->fetchall(PDO::FETCH_ASSOC);
	$data = array_merge($data, $sql_data);
	echo json_encode($data, JSON_PRETTY_PRINT);
}
else{
	echo json_encode([]);
}
?>