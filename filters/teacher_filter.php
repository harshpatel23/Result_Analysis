<?php session_start(); ?>
<?php include '../includes/db_conn.php'; ?>
<?php include '../includes/charts_json_wrapper.php' ?>
<?php  
	$teacher_id = $_SESSION['uname'];
	$conditions = array();
	if(isset($_GET['filter_condition']) or isset($_GET['course_id'])){
		$course_id = $_GET["course_id"];
		$sql = "SELECT type from teacher_to_courses where course_id=\"".$_GET['course_id'].'"';
		$result = $conn->query($sql);
		$data = $result->fetch(PDO::FETCH_ASSOC);
		$type = $data["type"];

		$outof_sql = "SELECT * FROM `course_total_marks` WHERE course_id = \"$course_id\";";
		$outof_result = $conn->query($outof_sql);
		$outof_data = $outof_result->fetch(PDO::FETCH_ASSOC);

		switch ($_GET['filter_condition']) {
			case 'TOTAL':
				$label = "Total Marks";
				if ($type === "T") {
					$table_name = "student_theory_marks";
					$column_name = "total_theory_marks";
				}
				else if ($type === "P") {
					$table_name = "student_practical_marks";
					$column_name = "total_practical_marks";
				}
				$conditions = array("$column_name = 10", "$column_name = 9", "$column_name = 8", "$column_name = 7", "$column_name = 6", "$column_name = 5", "$column_name = 4", );
				$condition_labels = array("10", "9", "8", "7", "6", "5", "Fail");
			break;

			case 'ESE':
				$label = "ESE Marks";
				$column_name = "ese_marks";
				$conditions = array("ese_marks >= 45", "ese_marks >= 35 and ese_marks < 45", "ese_marks >= 20 and ese_marks < 35", "ese_marks < 20");
				$condition_labels = array("greater than 45", "between 35 and 45", "between 20 and 35", 
																	"less than 20");
				$table_name = "student_theory_marks";
				break;

			case 'CA':
				$label = "CA Marks";
				$column_name = "ca_marks";
				$conditions = array("ca_marks >= 45", "ca_marks >= 35 and ca_marks < 45", "ca_marks >= 20 and ca_marks < 35", "ca_marks < 20");
				$condition_labels = array("greater than 45", "between 35 and 45", "between 20 and 35", 
																	"less than 20");
				$table_name = "student_theory_marks";
				break;

			case "TW":
				if($outof_data["tw_outof_marks"] != NULL) {
					$tw_outof_marks = $outof_data["tw_outof_marks"];
					$label = "Term Work";
					$column_name = "tw_marks";

					$tw_outof_marks = (float)$outof_data['tw_outof_marks'];
					$conditions = array("tw_marks >=".ceil($tw_outof_marks*85/100), 
						"tw_marks >=".ceil($tw_outof_marks*75/100)." and tw_marks <".ceil($tw_outof_marks*85/100), 
						"tw_marks >=".ceil($tw_outof_marks*70/100)." and tw_marks <".($tw_outof_marks*75/100), 
						"tw_marks >=".ceil($tw_outof_marks*60/100)." and tw_marks <".ceil($tw_outof_marks*70/100), 
						"tw_marks >=".ceil(($tw_outof_marks*50/100))." and tw_marks <".ceil($tw_outof_marks*60/100));

					$condition_labels = array("greater than ".ceil($tw_outof_marks*85/100), 
						"between ".ceil($tw_outof_marks*75/100)." and ".ceil($tw_outof_marks*85/100), 
						"between ".ceil($tw_outof_marks*70/100)." and ".ceil($tw_outof_marks*75/100), 
						"between ".ceil($tw_outof_marks*60/100)." and ".ceil($tw_outof_marks*70/100), 
						"between ".ceil($tw_outof_marks*50/100)." and ".ceil($tw_outof_marks*60/100));

					$table_name = "student_practical_marks";
				}
			break;

			case "ORAL":
			if($outof_data["oral_outof_marks"] != NULL) {
				$label = "Oral";
				$column_name = "oral_marks";

				$oral_outof_marks = (float)$outof_data['oral_outof_marks'];
				$conditions = array("oral_marks >=".ceil($oral_outof_marks*85/100), 
					"oral_marks >=".ceil($oral_outof_marks*75/100)." and oral_marks <".ceil($oral_outof_marks*85/100), 
					"oral_marks >=".ceil($oral_outof_marks*70/100)." and oral_marks <".ceil($oral_outof_marks*75/100), 
					"oral_marks >=".ceil($oral_outof_marks*60/100)." and oral_marks <".ceil($oral_outof_marks*70/100), 
					"oral_marks >=".ceil($oral_outof_marks*50/100)." and oral_marks <".ceil($oral_outof_marks*60/100));

				$condition_labels = array("greater than ".ceil($oral_outof_marks*85/100), 
					"between ".ceil($oral_outof_marks*75/100)." and ".ceil($oral_outof_marks*85/100), 
					"between ".ceil($oral_outof_marks*70/100)." and ".ceil($oral_outof_marks*75/100), 
					"between ".ceil($oral_outof_marks*60/100)." and ".ceil($oral_outof_marks*70/100), 
					"between ".ceil($oral_outof_marks*50/100)." and ".ceil($oral_outof_marks*60/100));

				$table_name = "student_practical_marks";
			}
			break;

			default:
				break;
			}
		}
	for ($i=0; $i < count($conditions); $i++) { 
		if (isset($_GET['course_id'])) {
			$course_id = $_GET['course_id'];
			$sql = "SELECT COUNT(*) as count FROM $table_name NATURAL JOIN teacher_to_courses WHERE $conditions[$i] and course_id=\"$course_id\" and teacher_id=$teacher_id;";
		} else {
			$sql = "SELECT COUNT(*) as count FROM $table_name NATURAL JOIN teacher_to_courses WHERE $conditions[$i] and teacher_id=$teacher_id;";
		}
		$result = $conn->query($sql);
		$result_array = $result->fetchAll(PDO::FETCH_ASSOC);
		$count = $result_array[0]["count"];
		$values = array(
				"$condition_labels[$i]" => "$condition_labels[$i]",
				"count" => "$count",
			);

		$metadata = array(array("Range", "$condition_labels[$i]", "string"), array("Count", "count", "number"));
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