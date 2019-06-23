<?php //include 'includes/header.html'; ?>
<?php //include 'includes/db_conn.php'; ?>
<?php  
	// Code for uploading the file
	if ( isset($_POST["submit"]) ) {
		if ( isset($_FILES["file"])) {
	      	//if there was an error uploading the file
	      	if ($_FILES["file"]["error"] > 0) {
	          	echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	      	}
	      	else {
	        	//Store file in directory "upload" with the name of "uploaded_file.txt"
		        $storagename = $_FILES["file"]["name"];
		        move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $storagename);
	        }
	    }else{
        	echo "No file selected <br>";
	    }

	    // convert csv to associative array
		$file = fopen("upload/" . $storagename,"r");
		
		# first line is blank
		fgetcsv($file);

		$headers = fgetcsv($file);

		while( $data = fgetcsv($file) ){
			// print_r($data);

			// handle male and female -- Female denoted by / 
			if($data[4] == 'Male'){
				$data[4] = '';
			}else{
				$data[4] = '/';
			}

			// add 0 in front of roll no, this will later be replaced by semester no
			// $data[1] = sprintf("0%s",$data[1]);

			$sql_format = "INSERT INTO students VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";

			$sql = sprintf($sql_format, $data[1], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10]);
			$conn->query($sql);
		}

		fclose($file);
	}

    




	// $csv_array = [];



	// 	$row_no = 0;
	// 	while($data = fgetcsv($file)){
	// 		// if ($row_no == 4) {
	// 		// 	$header = $data; 
	// 		// } else if ($row_no > 8) {
	// 		// 	$csv_array[] = array_combine($header, $data);
	// 		// } else if ($row_no == 5) {
	// 		// 	$courses_name = array_combine($header, $data);
	// 		// } else if ($row_no == 7) {
	// 		// 	$course_outof_marks = array_combine($header, $data);
	// 		// }
			
	// 		// $row_no ++;
	// 		print_r($data);
	// 		echo '<br>';
	//   }
	  // print_r($csv_array[0]);
		
		// $row_no = 0;
		// while ($row_no < count($csv_array)) {
		// 	$sql_array = [
		// 		'INSERT INTO student_theory_marks VALUES("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam1"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam1"].'", "'.$csv_array[$row_no]["exam2"].'", "'.$csv_array[$row_no]["GP3"].'"),
		// 		("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam4"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam4"].'", "'.$csv_array[$row_no]["exam5"].'", "'.$csv_array[$row_no]["GP6"].'"),
		// 		("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam7"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam7"].'", "'.$csv_array[$row_no]["exam8"].'", "'.$csv_array[$row_no]["GP9"].'"),
		// 		("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam10"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam10"].'", "'.$csv_array[$row_no]["exam11"].'", "'.$csv_array[$row_no]["GP12"].'")',

		// 		'INSERT INTO student_practical_marks VALUES("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam37"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam37"].'", "'.$csv_array[$row_no]["exam39"].'", "'.$csv_array[$row_no]["GP40"].'"),
		// 		("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam53"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam53"].'", "'.$csv_array[$row_no]["exam55"].'", "'.$csv_array[$row_no]["GP56"].'"),
		// 		("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam57"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam57"].'", "'.$csv_array[$row_no]["exam59"].'", "'.$csv_array[$row_no]["GP60"].'"),
		// 		("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam61"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam61"].'", "'.$csv_array[$row_no]["exam63"].'", "'.$csv_array[$row_no]["GP64"].'"),
		// 		("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam65"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam65"].'", "'.$csv_array[$row_no]["exam67"].'", "'.$csv_array[$row_no]["GP68"].'"),
		// 		("'.$csv_array[$row_no]["seatno"].'", "'.$courses_name["exam69"].$sem_no.$dept_no.'", "'.$csv_array[$row_no]["exam69"].'", "'.$csv_array[$row_no]["exam71"].'", "'.$csv_array[$row_no]["GP72"].'")',

		// 		'INSERT INTO students VALUES("'.$csv_array[$row_no]["seatno"].'", "'.$csv_array[$row_no]["NAME"].'", "'.$csv_array[$row_no]["Gender"].'")',

		// 		'INSERT INTO student_cgpa VALUES("'.$csv_array[$row_no]["seatno"].'", "'.$csv_array[$row_no]["ECPGP"].'", "'.$csv_array[$row_no]["GPA"].'", "'.$csv_array[$row_no]["ExamTotal"].'", "'.$csv_array[$row_no]["Remark"].'")'
		// 	];
		// 	$conn->query($sql_array[0]);
		// 	$conn->query($sql_array[1]);
		// 	$conn->query($sql_array[2]);
		// 	$conn->query($sql_array[3]);
		// 	$row_no++;
		// }
		// $sql = 'INSERT INTO course_total_marks VALUES("'.$courses_name["exam1"].$sem_no.$dept_no.'", "'.$course_outof_marks["exam1"].'", "'.$course_outof_marks["exam2"].'", "", ""), 
		// ("'.$courses_name["exam4"].$sem_no.$dept_no.'", "'.$course_outof_marks["exam4"].'", "'.$course_outof_marks["exam5"].'", "", ""), 
		// ("'.$courses_name["exam7"].$sem_no.$dept_no.'", "'.$course_outof_marks["exam7"].'", "'.$course_outof_marks["exam8"].'", "", ""), 
		// ("'.$courses_name["exam10"].$sem_no.$dept_no.'", "'.$course_outof_marks["exam10"].'", "'.$course_outof_marks["exam11"].'", "", ""), 
		// ("'.$courses_name["exam37"].$sem_no.$dept_no.'", "", "", "'.$course_outof_marks["exam37"].'", "'.$course_outof_marks["exam39"].'"), 
		// ("'.$courses_name["exam53"].$sem_no.$dept_no.'", "", "", "'.$course_outof_marks["exam53"].'", "'.$course_outof_marks["exam55"].'"), 
		// ("'.$courses_name["exam57"].$sem_no.$dept_no.'", "", "", "'.$course_outof_marks["exam57"].'", "'.$course_outof_marks["exam59"].'"), 
		// ("'.$courses_name["exam61"].$sem_no.$dept_no.'", "", "", "'.$course_outof_marks["exam61"].'", "'.$course_outof_marks["exam63"].'"), 
		// ("'.$courses_name["exam65"].$sem_no.$dept_no.'", "", "", "'.$course_outof_marks["exam65"].'", "'.$course_outof_marks["exam67"].'"), 
		// ("'.$courses_name["exam69"].$sem_no.$dept_no.'", "", "", "'.$course_outof_marks["exam69"].'", "'.$course_outof_marks["exam71"].'")';
		// $conn->query($sql);
		// if ($conn->errorCode() == 0) {
?>
		<!-- <div class="alert alert-success alert-dismissible fade show" role="alert">
		  <strong>Success!!!</strong> Uploaded to database.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div> -->
<?php
		// } else {
?>
		<!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
		  <strong>Error!!!</strong> Failed to upload.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div> -->
<?php
		// }		
	// }
?>

	<div class="container-fluid">
		<br><br>
		<form method="POST" action="" enctype="multipart/form-data">
			<input type="file" name="file" id="csv_file" required><br><br>
			<input class="btn btn-primary" type="submit" name="submit" class="form-control">
		</form>
	</div>
<?php //include 'includes/footer.php'; ?>