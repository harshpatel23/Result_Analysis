<?php session_start(); ?>
<?php include '../includes/db_conn.php'; ?>
<?php include '../includes/charts_json_wrapper.php' ?>
<?php  
	$teacher_id = $_SESSION['uname'];
	$conditions = array();
	if(isset($_GET['filter_condition']) or isset($_GET['course_id'])){
		switch ($_GET['filter_condition']) {
			case 'TOTAL':
				$label = "Total Marks";
				$column_name = "total_theory_marks";
				$conditions = array("total_theory_marks >= 85", "total_theory_marks >= 75 and total_theory_marks < 85", "total_theory_marks >= 70 and total_theory_marks < 75", "total_theory_marks >=60 and total_theory_marks < 70", "total_theory_marks < 60");
				$table_name = "student_theory_marks";
				break;
			case 'ESE':
				$label = "ESE Marks";
				$column_name = "ese_marks";
				$conditions = array("ese_marks >= 45", "ese_marks >= 35 and ese_marks < 45", "ese_marks >= 20 and ese_marks < 35", "ese_marks < 20");
				$table_name = "student_theory_marks";
				break;
			case 'CA':
				$label = "CA Marks";
				$column_name = "ca_marks";
				$conditions = array("ca_marks >= 45", "ca_marks >= 35 and ca_marks < 45", "ca_marks >= 20 and ca_marks < 35", "ca_marks < 20");
				$table_name = "student_theory_marks";
				break;
			default:
				break;
			}
		}
	for ($i=0; $i < count($conditions); $i++) { 
		if (isset($_GET['course_id'])) {
			$course_id = $_GET['course_id'];
			$sql = "SELECT COUNT(*) as count FROM $table_name NATURAL JOIN teacher_to_courses WHERE $conditions[$i] and course_id=$course_id and teacher_id=$teacher_id;";
		}else {
			$sql = "SELECT COUNT(*) as count FROM $table_name NATURAL JOIN teacher_to_courses WHERE $conditions[$i] and teacher_id=$teacher_id;";
		}
		$result = $conn->query($sql);
		$result_array = $result->fetchAll(PDO::FETCH_ASSOC);
		$count = $result_array[0]["count"];
		$values = array(
				"$conditions[$i]" => "$conditions[$i]",
				"count" => "$count",
			);
		$metadata = array(array("Range", "$conditions[$i]", "string"), array("Count", "count", "number"));
		if ($i == 0) {
			$row_string = addRow($values, $metadata);
		} else {
			$row_string .= ",".addRow($values, $metadata);
		}
	}
	$column_string = addColumn($metadata);
	$string = '{
	  "cols": ['.$column_string.'],
	  "rows": ['.$row_string.']
	}';
	echo $string;
?>