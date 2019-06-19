<?php
include 'includes/db_conn.php';
include 'includes/header.html';
session_start();


if(isset($_POST['submit'])){
	$uname = $_POST['username'];
	$pwd = $_POST['password'];

	$query = $conn->prepare("SELECT * FROM users WHERE id = ?;");

	$status = $query->execute(array($uname));

	if(!$status){
		echo $status;
		 die("FAILED" . mysqli_error($conn));
	}

	$result_array = $query->fetchAll(PDO::FETCH_ASSOC);
	
	$id = $result_array[0]['id'];
	$hash_password = $result_array[0]['password']; 
	$role = $result_array[0]['role'];

	// verify password
	if(password_verify($pwd, $hash_password)){
		// Password verification success
		$_SESSION['uname'] = $uname;

		// check if role is hod, and set $_SESSION['hod_department'] accordingly
		// eg:- hod_comps, then in $_SESSION['hod_department'] 'comps' will get stored
		if (strpos($role, 'hod') !== false) {
		    $_SESSION['user_type'] = 'hod';

		    $splitted_role = explode("_", $role);
		    $hod_department = $splitted_role[1];

		    $_SESSION['hod_department'] = $hod_department;
 		}else{
 			$_SESSION['user_type'] = $role;
 		}

 		header("Location: index.php");
	}else{
		// Password verification failed
		$_SESSION['password_incorrect'] = true;
		header("Location: login.php");
	}
}

include 'includes/footer.php';
?>


