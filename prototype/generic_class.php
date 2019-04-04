<?php include '../includes/db_conn.php'; ?>

<?php 
if(isset($_GET['filter_condition'])){
	switch ($_GET['filter_condition']) {
		case 'CGPA':
			# code...
			$conditions = array("gpa >= 9", "gpa >= 8 and gpa < 9", "gpa >= 7 and gpa < 8", "gpa < 7");
			$table_name = "student_cgpa";
			break;
		case 'ESE':
			# code...
			$conditions = array("ese_marks >= 45", "ese_marks >= 35 and ese_marks < 45", "ese_marks >= 20 and ese_marks < 35", "ese_marks < 20");
			$table_name = "student_theory_marks";
			break;
		case 'CA':
			# code...
			$conditions = array("ca_marks >= 45", "ca_marks >= 35 and ca_marks < 45", "ca_marks >= 20 and ca_marks < 35", "ca_marks < 20");
			$table_name = "student_theory_marks";
			break;
		default:
			# code...
			break;
	}
	$sql_queries = array();
	for($i = 0;$i < count($conditions); $i++){
		$sql = "SELECT COUNT(*) as count FROM $table_name WHERE $conditions[$i];";
		$sql_queries[$i] = $sql;
	}

	for ($i=0; $i < count($conditions); $i++) { 
		$sql = $sql_queries[$i];
		$result = $conn->query($sql);
		$row = $result->fetch(PDO::FETCH_ASSOC);
		if ($i == count($conditions) - 1) {
			addRow(array($conditions[$i], $row['count']), "");
		} else {
			addRow(array($conditions[$i], $row['count']), ",");
		}
	}
	addColumn(array(array("Filter", "string"), array("count", "number"))); 
	displayJSONString();
}
?>

<?php
	$row_string = ''; 
	$column_string = '';
	function addRow($value, $seperator){
		global $row_string;
		$row_string .= '{"c": [';
		for ($i=0; $i < sizeof($value); $i++) { 
			if ($i == 0) {
				$row_string .= '{"v": "'.$value[$i].'","f":null}';
			} else {
				$row_string .= ',{"v": '.$value[$i].',"f":null}';
			}	
		}
		$row_string .= ']}'.$seperator;
	}

	function addColumn($value){
		global $column_string;
		$column_string = '';
		for ($i=0; $i < sizeof($value); $i++) { 
			if ($i == sizeof($value) - 1) {
				$column_string .= '{"id":"","label": "'.$value[$i][0].'","pattern":"","type":"'.$value[$i][1].'"}';
			} else {
				$column_string .= '{"id":"","label": "'.$value[$i][0].'","pattern":"","type":"'.$value[$i][1].'"},'	;
			}
		}
	}
	
	function displayJSONString(){
		global $column_string;
		global $row_string;
		$string = '{
		  "cols": ['.$column_string.'],
		  "rows": ['.$row_string.']
		}';
	echo $string;
	}
?>