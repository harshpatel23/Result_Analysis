<?php include '../includes/db_conn.php'; ?>
<?php
	$sql = "SELECT course_id, ca_marks FROM student_theory_marks WHERE seat_no=11811001;";
	$result = $conn->query($sql);
	$i = True;
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		if ($i) {
			addRow(array($row['course_id'], $row['ca_marks']), "");
			$i = False;
		} else {
			addRow(array($row['course_id'], $row['ca_marks']), ",");
		}
	}
	addColumn(array(array("Course", "string"), array("CA marks", "number"))); 
	displayJSONString();
?>

<?php
	$row_string = ''; 
	$column_string = '';
	function addRow($value, $seperator){
		global $row_string;
		$row_string .= $seperator.'{"c": [';
		for ($i=0; $i < sizeof($value); $i++) { 
			if ($i == 0) {
				$row_string .= '{"v": "'.$value[$i].'","f":null}';
			} else {
				$row_string .= ',{"v": '.$value[$i].',"f":null}';
			}	
		}
		$row_string .= ']}';
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