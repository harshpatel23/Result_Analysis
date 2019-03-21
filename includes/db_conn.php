<?php 

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "result_analysis";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully"; 
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>