<?php //include 'includes/header.html'; ?>
<?php include 'includes/db_conn.php'; ?>
<?php  
	// Code for uploading the file
	if ( isset($_POST["submit"]) ) {
		$dept_no = $_POST["dept_no"];
		$sem_no = $_POST["sem_no"];
  	if ( isset($_FILES["after_verify_csv_file"]) && isset($_FILES["b4_verify_csv_file"]) ) {
      //if there was an error uploading the file
      if ($_FILES["after_verify_csv_file"]["error"] > 0 && $_FILES["b4_verify_csv_file"]["error"] > 0) {
          echo "Return Code: " . $_FILES["after_verify_csv_file"]["error"] . "<br>" . $_FILES["b4_verify_csv_file"]["error"] . "<br>";
      }
      else {
        //Store file in directory "upload" with the name of "uploaded_file.txt"
        $storagename_after_rev = $_FILES["after_verify_csv_file"]["name"];
        $storagename_b4_verify = $_FILES["b4_verify_csv_file"]["name"];
        move_uploaded_file($_FILES["after_verify_csv_file"]["tmp_name"], "upload/" . $storagename_after_rev);
        move_uploaded_file($_FILES["b4_verify_csv_file"]["tmp_name"], "upload/" . $storagename_b4_verify);
        }
    } else {
        echo "No file selected <br>";
     	}
    $storagename = array($storagename_b4_verify, $storagename_after_rev);
    $table_suffix = array("_before_rev", "");
    // convert csv to associative array
    for ($i=0; $i < 2; $i++) { 
			$file = fopen("upload/" . $storagename[$i],"r");
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
					'INSERT INTO student_theory_marks'.$table_suffix[$i].' VALUES("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam1"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam1"].'", "'.$csv_array[$row_no]["exam2"].'", "'.$csv_array[$row_no]["GP3"].'"),
					("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam4"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam4"].'", "'.$csv_array[$row_no]["exam5"].'", "'.$csv_array[$row_no]["GP6"].'"),
					("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam7"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam7"].'", "'.$csv_array[$row_no]["exam8"].'", "'.$csv_array[$row_no]["GP9"].'"),
					("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam10"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam10"].'", "'.$csv_array[$row_no]["exam11"].'", "'.$csv_array[$row_no]["GP12"].'")',

					'INSERT INTO student_practical_marks'.$table_suffix[$i].' VALUES("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam37"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam37"].'", "'.$csv_array[$row_no]["exam39"].'", "'.$csv_array[$row_no]["GP40"].'"),
					("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam53"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam53"].'", "'.$csv_array[$row_no]["exam55"].'", "'.$csv_array[$row_no]["GP56"].'"),
					("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam57"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam57"].'", "'.$csv_array[$row_no]["exam59"].'", "'.$csv_array[$row_no]["GP60"].'"),
					("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam61"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam61"].'", "'.$csv_array[$row_no]["exam63"].'", "'.$csv_array[$row_no]["GP64"].'"),
					("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam65"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam65"].'", "'.$csv_array[$row_no]["exam67"].'", "'.$csv_array[$row_no]["GP68"].'"),
					("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam69"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam69"].'", "'.$csv_array[$row_no]["exam71"].'", "'.$csv_array[$row_no]["GP72"].'")',

					'INSERT INTO students VALUES("'.$csv_array[$row_no]["seatno"].'", "'.$csv_array[$row_no]["NAME"].'", "'.$csv_array[$row_no]["Gender"].'")',

					'INSERT INTO student_cgpa'.$table_suffix[$i].' VALUES("'.$csv_array[$row_no]["seatno"].'", "'.$csv_array[$row_no]["ECPGP"].'", "'.$csv_array[$row_no]["GPA"].'", "'.$csv_array[$row_no]["ExamTotal"].'", "'.$csv_array[$row_no]["Remark"].'")'
				];
				$conn->query($sql_array[0]);
				$conn->query($sql_array[1]);
				// $conn->query($sql_array[2]);
				$conn->query($sql_array[3]);
				$row_no++;
			}
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


		// Before verify data update




		if ($conn->errorCode() == 0) {
?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  <strong>Success!!!</strong> Uploaded to database.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
<?php
		} else {
?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
		  <strong>Error!!!</strong> Failed to upload.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
<?php
		}		
	}
?>

	<div class="container-fluid">
		<br><br>
		<form method="POST" action="" enctype="multipart/form-data">
			<div class="container-fluid">
				<label for="dept_no">Select Department</label>
				<select class="form-control" name="dept_no" required id="dept_no">
					<option value="1">Computer</option>
					<option value="2">IT</option>
					<option value="3">Mech</option>
					<option value="4">ETRX</option>
					<option value="5">EXTC</option>
				</select><br>
				<label for="sem_no">Select Semester No</label>
				<select class="form-control" name="sem_no" required id="sem_no">
					<option value="1">sem 1</option>
					<option value="2">sem 2</option>
					<option value="3">sem 3</option>
					<option value="4">sem 4</option>
					<option value="5">sem 5</option>
					<option value="6">sem 6</option>
					<option value="7">sem 7</option>
					<option value="8">sem 8</option>
				</select><br>
			
				<div class="row">
					<div class="col-lg-6">
						<label for="b4_verify_csv_file">Result File Before Re-verification (CSV Format only)</label>
						<input type="file" name="b4_verify_csv_file" id="b4_verify_csv_file" required><br><br>
					</div>
    				<div class="col-lg-6">
    					<label for="after_verify_csv_file">Result File After Re-verification (CSV Format only)</label>
    					<input type="file" name="after_verify_csv_file" id="after_verify_csv_file" required><br><br>
    				</div>
				</div>
				<input class="btn btn-primary" type="submit" name="submit" class="form-control">				
			</div>
		</form>
	</div>
<?php //include 'includes/footer.php'; ?>