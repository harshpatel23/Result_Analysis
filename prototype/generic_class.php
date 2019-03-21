<?php 
if(isset($_GET['filter_condition'])){\
	switch ($_GET['filter_condition']) {
		case 'CGPA':
			# code...
			$conditions = array("gpa >= 9", "gpa >= 8 and gpa < 9", "gpa >= 7 and gpa < 8", "gpa < 7");
			$col_name = "student_cgpa";
			break;
		case 'ESE':
			# code...
			$conditions = array("ese >= 45", "gpa >= 35 and gpa < 45", "gpa >= 20 and gpa < 35", "gpa < 20");
			$col_name = "ese";
			break;
		case 'CA':
			# code...
			$conditions = array("ese >= 45", "gpa >= 35 and gpa < 45", "gpa >= 20 and gpa < 35", "gpa < 20");
			$col_name = "ca_marks"
			break;
		default:
			# code...
			break;
	}
	$sql_queries = array();
	for($i = 0;$i < count($conditions); $i++){
		$sql = "SELECT COUNT(*) as count FROM $col_name WHERE $conditions[$i]";
		$sql_queries[$i] = $sql;
	}
	
}
?>