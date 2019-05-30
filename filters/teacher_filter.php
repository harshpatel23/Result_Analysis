<?php session_start(); ?>
<?php include '../includes/db_conn.php'; ?>
<?php include '../includes/charts_json_wrapper.php' ?>
<?php  
	$teacher_id = $_SESSION['uname'];
	$conditions = array();	
	if(isset($_GET['comparison_grp'])){
		$comparison_grp = $_GET['comparison_grp'];
		$comparison_values = explode(',',$_GET[$comparison_grp]);
	}
	else {
		$comparison_grp = "None";
		$comparison_values =array(0 => "None");
	}
		// handle batch year i.e convert 2016 to 16
		if($comparison_grp == "batch"){
			for($i = 0; $i < count($comparison_values); $i++){
				$comparison_values[$i] = substr($comparison_values[$i], -2);
			}
		}

		$final_data = [];
		$final_metadata = [];
		for($idx = 0; $idx < count($comparison_values); $idx++) {
			switch ($comparison_grp) {
				case 'course_id':
					$course_id = $comparison_values[$idx];
					$filter_condition = $_GET['filter_condition'];
					$batch = $_GET["batch"];
					$batch = substr($batch, -2);
					$gender = $_GET['gender'];
					break;

				case 'batch':
					$course_id = $_GET['course_id'];
					$filter_condition = $_GET['filter_condition'];
					$batch = $comparison_values[$idx];
					$gender = $_GET['gender'];
					break;

				case 'gender':
					$course_id = $_GET['course_id'];
					$filter_condition = $_GET['filter_condition'];
					$batch = $_GET["batch"];
					$batch = substr($batch, -2);
					$gender = $comparison_values[$idx];
					break;

				case "None":
					$course_id = $_GET['course_id'];
					$filter_condition = $_GET['filter_condition'];
					$comparison_values = [];
					$comparison_values[] = $course_id;
					$batch = $_GET["batch"];
					$batch = substr($batch, -2);
					$gender = $_GET['gender'];
					break;
				default:
					break;
			}
			$sql = "SELECT type from teacher_to_courses where course_id=\"".$course_id.'"';
			$result = $conn->query($sql);
			$data = $result->fetch(PDO::FETCH_ASSOC);
			$type = $data["type"];
			$outof_sql = "SELECT * FROM `course_total_marks` WHERE course_id = \"$course_id\";";
			$outof_result = $conn->query($outof_sql);
			$outof_data = $outof_result->fetch(PDO::FETCH_ASSOC);
			switch ($filter_condition) {
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
			} // [SWITCH END]

			// map the gender
			switch ($gender) {
				case 'BOTH':
					$gender_sql_symbol = "LIKE \"%\"";
					break;
				case 'MALE':
					$gender_sql_symbol = "<> \"/\"";
					break;
				case 'FEMALE':
					$gender_sql_symbol = "= \"/\"";
					break;
				default:
					break;
			}

			// initialize data for first time
			if($idx == 0){
				// initialize final data
				for($i = 0; $i < count($conditions); $i++){
					$final_data[$i] = array();
				}
				// generate metadata
				$final_metadata[] = array("Range", "range", "string");
				for($i = 0;$i < count($comparison_values); $i++){
					// switch ($comparison_grp) {
					// 	case 'course_id':
					// 		$comparison_metadata_name = $comparison_values[$i];
					// 		break;

					// 	case 'batch':
					// 		$comparison_metadata_name = substr($comparison_values[$i], -2);
					// 		break;

					// 	case "None":
					// 		// note that in above switch case we are storing in $comparison_values
					// 		$comparison_metadata_name = $comparison_values[$i];
					// 		break;
					// 	default:
					// 		break;
					// }
					$final_metadata[] = array($comparison_values[$i], $comparison_values[$i], "number");
				}
			}
			for ($i=0; $i < count($conditions); $i++) { 
				// $sql = "SELECT COUNT(*) as count FROM $table_name NATURAL JOIN teacher_to_courses NATURAL JOIN students WHERE $conditions[$i] and course_id=\"$course_id\" and teacher_id=$teacher_id  and seat_no like \"_$batch%\" and gender $gender_sql_symbol;";
				$sql = "SELECT COUNT(*) as count FROM (SELECT * FROM $table_name NATURAL JOIN teacher_to_courses WHERE $conditions[$i] and course_id=\"$course_id\" and teacher_id=$teacher_id  and seat_no like \"_$batch%\") a JOIN students as b on a.seat_no LIKE CONCAT('%', b.seat_no ,'%') where gender $gender_sql_symbol;";
				// echo $sql."<br>";
				$result = $conn->query($sql);
				$result_array = $result->fetchAll(PDO::FETCH_ASSOC);
				$count = $result_array[0]["count"];
				$final_data[$i]['range'] = $condition_labels[$i];
				$final_data[$i][$comparison_values[$idx]] = $count;
			}
		} // [FOR LOOP END]
		// echo "<pre> "; print_r($final_data); echo " </pre>";
		// echo "<pre> "; print_r($final_metadata); echo " </pre>";
		echo returnJSONString($final_data, $final_metadata);
?>