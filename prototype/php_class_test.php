<?php include '../includes/db_conn.php'; ?>

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
?>
<?php
	addColumn(array(array("Filter", "string"), array("count", "number"))); 
	$sql = "SELECT COUNT(*) as count FROM student_cgpa WHERE gpa >= 9";
	$result = $conn->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);
	addRow(array("gpa >= 9", $row['count']), ",");

	$sql = "SELECT COUNT(*) as count FROM student_cgpa WHERE gpa >= 8 and gpa < 9";
	$result = $conn->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);
	addRow(array("gpa >= 8 and gpa < 9", $row['count']), ",");

	$sql = "SELECT COUNT(*) as count FROM student_cgpa WHERE gpa >= 7 and gpa < 8";
	$result = $conn->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);
	addRow(array("gpa >= 7 and gpa < 8", $row['count']), ",");

	$sql = "SELECT COUNT(*) as count FROM student_cgpa WHERE gpa < 7";
	$result = $conn->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);
	addRow(array("gpa < 7", $row['count']), "");
?>

<?php 
	$string = '{
		  "cols": ['.$column_string.'],
		  "rows": ['.$row_string.']
		}';
	echo $string;
?>

