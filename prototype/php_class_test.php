<?php include '../includes/db_conn.php'; ?>
<?php include '../includes/header.html'; ?>
<!-- Plot a simple bar graph for cgpa of students -->
<?php  
	$sql = "SELECT COUNT(*) as count FROM student_cgpa WHERE gpa >= 9";
	$result = $conn->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);
	echo "<p>cgpa >= 9 :- ".$row['count']."</p>";

	$sql = "SELECT COUNT(*) as count FROM student_cgpa WHERE gpa >= 8 and gpa < 9";
	$result = $conn->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);
	echo "<p>8 <= cgpa < 9 :- ".$row['count']."</p>";

	$sql = "SELECT COUNT(*) as count FROM student_cgpa WHERE gpa >= 7 and gpa < 8";
	$result = $conn->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);
	echo "<p>7 <= cgpa < 8 :- ".$row['count']."</p>";

	$sql = "SELECT COUNT(*) as count FROM student_cgpa WHERE gpa < 7";
	$result = $conn->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);
	echo "<p>cgpa < 7 :- ".$row['count']."</p>";
?>

<!-- Convert above data into json and pass it to display_chart.php -->

<a href="./display_chart.php"><button class="btn btn-primary">Display chart</button></a>

<?php include '../includes/footer.html'; ?>