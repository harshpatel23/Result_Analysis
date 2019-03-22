<?php
	/**  USAGE:
	$sql = "SELECT course_id, ca_marks FROM student_theory_marks WHERE seat_no=11811001;";
	$result = $conn->query($sql);
	$result_array = $result->fetchAll(PDO::FETCH_ASSOC);	
	$metadata = array(array("Course", "course_id", "string"), array("CA marks", "ca_marks", "number"));
	displayJSONString($result_array, $metadata);
	**/
?>
<?php
	function addRow($value, $metadata){
		$row_string = '{"c": [';
		for ($i=0; $i < sizeof($value); $i++) { 
			if ($i == 0) {
				$row_string .= '{"v": "'.$value[$metadata[$i][1]].'","f":null}';
			} else {
				$row_string .= ',{"v": '.$value[$metadata[$i][1]].',"f":null}';
			}	
		}
		$row_string .= ']}';
		return $row_string;
	}
   

	function addColumn($value){	
		$column_string = '';	
		for ($i=0; $i < sizeof($value); $i++) { 
			if ($i == sizeof($value) - 1) {
				$column_string .= '{"id":"","label": "'.$value[$i][0].'","pattern":"","type":"'.$value[$i][2].'"}';
			} else {
				$column_string .= '{"id":"","label": "'.$value[$i][0].'","pattern":"","type":"'.$value[$i][2].'"},'	;
			}
		}
		return $column_string;
	}
	
	function returnJSONString($result_array, $metadata){
		$row_string = '';
		$column_string = addColumn($metadata);
		for ($i=0; $i < count($result_array); $i++) { 
			if ($i == 0) {
					$row_string .= addRow($result_array[$i], $metadata);
				} else {
					$row_string .= ','.addRow($result_array[$i], $metadata);
				}
		}
			
		$string = '{
		  "cols": ['.$column_string.'],
		  "rows": ['.$row_string.']
		}';
	return $string;
	}
?>