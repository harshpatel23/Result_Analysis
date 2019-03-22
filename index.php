<?php
include 'includes/header.html';
session_start();
	if(!isset($_SESSION['uname'])){
	header("Location: login.php");
	}
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3" id="filter">
			<?php
				if($_SESSION['user_type'] == 'student'){
					include 'filter_bar/filter_student.php';
				}
			?>
		</div>	
		<div  class="col-sm-9" id="display">
			<?php
			echo $_SESSION['uname'];
			?>
		</div>
	</div>
</div>
<?php
include 'includes/footer.html';
?>