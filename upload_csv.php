<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style/index.css">
    <title>Result Analysis</title>
  </head>
  <body>
  <?php include 'includes/db_conn.php'; ?>
  <?php  
	// Code for uploading the file
	if ( isset($_POST["submit"]) ) {
		$dept_no = $_POST["dept_no"];
		$sem_no = $_POST["sem_no"];
  	if ( isset($_FILES["file"])) {
      //if there was an error uploading the file
      if ($_FILES["file"]["error"] > 0) {
          echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
      }
      else {
        //Store file in directory "upload" with the name of "uploaded_file.txt"
        $storagename = $_FILES["file"]["name"];
        move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $storagename);
        echo "File Upload Successful <br>";
        }
    } else {
        echo "No file selected <br>";
     	}

    // convert csv to associative array
		$file = fopen("upload/" . $storagename,"r");
		$csv_array = [];
		$row_no = 0;
		while($data = fgetcsv($file)){
			if ($row_no == 4) {
				$header = $data; 
			} else if ($row_no > 8) {
				$csv_array[] = array_combine($header, $data);
			} else if ($row_no == 5) {
				$courses_name = array_combine($header, $data);
			} else if ($row_no == 7) {
				$course_outof_marks = array_combine($header, $data);
			}
			
			$row_no ++;
	  }
	  // print_r($csv_array[0]);
		fclose($file);
		$row_no = 0;
		while ($row_no < count($csv_array)) {
			$sql_array = [
				'INSERT INTO student_theory_marks VALUES("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam1"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam1"].'", "'.$csv_array[$row_no]["exam2"].'", "'.$csv_array[$row_no]["exam3"].'"),
				("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam4"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam4"].'", "'.$csv_array[$row_no]["exam5"].'", "'.$csv_array[$row_no]["exam6"].'"),
				("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam7"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam7"].'", "'.$csv_array[$row_no]["exam8"].'", "'.$csv_array[$row_no]["exam9"].'"),
				("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam10"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam10"].'", "'.$csv_array[$row_no]["exam11"].'", "'.$csv_array[$row_no]["exam12"].'")',

				'INSERT INTO student_practical_marks VALUES("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam37"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam37"].'", "'.$csv_array[$row_no]["exam39"].'", "'.$csv_array[$row_no]["exam40"].'"),
				("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam53"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam53"].'", "'.$csv_array[$row_no]["exam55"].'", "'.$csv_array[$row_no]["exam56"].'"),
				("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam57"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam57"].'", "'.$csv_array[$row_no]["exam59"].'", "'.$csv_array[$row_no]["exam60"].'"),
				("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam61"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam61"].'", "'.$csv_array[$row_no]["exam63"].'", "'.$csv_array[$row_no]["exam64"].'"),
				("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam65"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam65"].'", "'.$csv_array[$row_no]["exam67"].'", "'.$csv_array[$row_no]["exam68"].'"),
				("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam69"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam69"].'", "'.$csv_array[$row_no]["exam71"].'", "'.$csv_array[$row_no]["exam72"].'")',

				'INSERT INTO students VALUES("'.$csv_array[$row_no]["seatno"].'", "'.$csv_array[$row_no]["NAME"].'", "'.$csv_array[$row_no]["Gender"].'")',

				'INSERT INTO student_cgpa VALUES("'.$csv_array[$row_no]["seatno"].'", "'.$csv_array[$row_no]["ECPGP"].'", "'.$csv_array[$row_no]["GPA"].'", "'.$csv_array[$row_no]["ExamTotal"].'", "'.$csv_array[$row_no]["Remark"].'")'
			];
			$conn->query($sql_array[0]);
			$conn->query($sql_array[1]);
			$conn->query($sql_array[2]);
			$conn->query($sql_array[3]);

			$row_no++;
		}
		$sql = 'INSERT INTO course_total_marks VALUES("'.$courses_name["exam1"].$sem_no.$dept_no.'", "'.$course_outof_marks["exam1"].'", "'.$course_outof_marks["exam2"].'", "", ""), 
		("'.$courses_name["exam4"].$sem_no.$dept_no.'", "'.$course_outof_marks["exam4"].'", "'.$course_outof_marks["exam5"].'", "", ""), 
		("'.$courses_name["exam7"].$sem_no.$dept_no.'", "'.$course_outof_marks["exam7"].'", "'.$course_outof_marks["exam8"].'", "", ""), 
		("'.$courses_name["exam10"].$sem_no.$dept_no.'", "'.$course_outof_marks["exam10"].'", "'.$course_outof_marks["exam11"].'", "", ""), 
		("'.$courses_name["exam37"].$sem_no.$dept_no.'", "", "", "'.$course_outof_marks["exam37"].'", "'.$course_outof_marks["exam39"].'"), 
		("'.$courses_name["exam53"].$sem_no.$dept_no.'", "", "", "'.$course_outof_marks["exam53"].'", "'.$course_outof_marks["exam55"].'"), 
		("'.$courses_name["exam57"].$sem_no.$dept_no.'", "", "", "'.$course_outof_marks["exam57"].'", "'.$course_outof_marks["exam59"].'"), 
		("'.$courses_name["exam61"].$sem_no.$dept_no.'", "", "", "'.$course_outof_marks["exam61"].'", "'.$course_outof_marks["exam63"].'"), 
		("'.$courses_name["exam65"].$sem_no.$dept_no.'", "", "", "'.$course_outof_marks["exam65"].'", "'.$course_outof_marks["exam67"].'"), 
		("'.$courses_name["exam69"].$sem_no.$dept_no.'", "", "", "'.$course_outof_marks["exam69"].'", "'.$course_outof_marks["exam71"].'")';
		$conn->query($sql);
	}
	?>

		<div class="container-fluid">
			<form method="POST" action="" enctype="multipart/form-data">
				<select class="form-control" name="dept_no" required>
					<option value="1">Computer</option>
					<option value="2">IT</option>
					<option value="3">Mech</option>
					<option value="4">ETRX</option>
					<option value="5">EXTC</option>
				</select><br>
				<select class="form-control" name="sem_no" required>
					<option value="1">sem 1</option>
					<option value="">sem 2</option>
					<option value="3">sem 3</option>
					<option value="4">sem 4</option>
					<option value="5">sem 5</option>
					<option value="6">sem 6</option>
					<option value="7">sem 7</option>
					<option value="8">sem 8</option>
				</select><br>
				<input type="file" name="file" id="csv_file" required><br><br>
				<input class="btn btn-primary" type="submit" name="submit" class="form-control">
			</form>
		</div>
	</body>
</html>