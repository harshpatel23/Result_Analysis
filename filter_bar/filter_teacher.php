<?php include './includes/db_conn.php'; ?>
<div class="card">
	<article class="card-group-item">
		<header class="card-header">
			<h6 class="title">Marks Type</h6>
		</header>
		<div class="filter-content">
			<div class="card-body">
				<?php 
					$arr = array("TOTAL","ESE","CA");
					for($i = 0; $i < count($arr); $i++){	?>
						<label class="form-check">
							<?php $url = "teacher_filter.php?filter_condition=".$arr[$i]; ?>
			  				<input onclick="refreshChart(<?php echo "'filters/".$url."'"; ?>, 'pie_chart');" class="form-check-input" type="radio" name="marks_type" value="<?php echo $arr[$i];?>" >
			  				<span class="form-check-label"><?php echo $arr[$i];?> </span>
						</label>
				<?php
					}				
				?>
			</div> <!-- card-body.// -->
		</div>
	</article> <!-- card-group-item.// -->
	<article class="card-group-item">
		<header class="card-header">
			<h6 class="title">My Courses</h6>
		</header>
		<div class="filter-content">
			<div class="card-body">
				<?php 
					$sql = "SELECT course_id FROM teacher_to_courses WHERE teacher_id = ".$_SESSION['uname'].";";
					$result = $conn->query($sql);
					while ( $row = $result->fetch(PDO::FETCH_ASSOC)) {  ?>
						<label class="form-check">
			  				<input class="form-check-input" type="radio" name="my_courses" value="<?php echo $row['course_id'];?>">
			  				<span class="form-check-label"><?php echo $row['course_id'];?> </span>
						</label>
				<?php
					}				
				?>
			</div> <!-- card-body.// -->
		</div>
	</article> <!-- card-group-item.// -->
</div> <!-- card.// -->