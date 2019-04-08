<?php include './includes/db_conn.php'; ?>
<script type="text/javascript">
	var page = "filters/teacher_filter.php";
</script>
<div class="card">
	<article class="card-group-item">
		<header class="card-header">
			<h6 class="title">My Courses</h6>
		</header>
		<div class="filter-content">
			<div class="card-body">
				<?php 
					$filter_group_class = "course_id";
					$sql = "SELECT course_id, type FROM teacher_to_courses WHERE teacher_id = ".$_SESSION['uname'].";";
					$result = $conn->query($sql);
					$flag = true;
					while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
						<label class="form-check">
		  				<input class="form-check-input filter-group <?php echo $row['type']." ".$filter_group_class;?>" type="radio" name="my_courses" value="<?php echo $row['course_id'];?>"<?php 
		  					if($flag) {
		  						echo "checked";
		  						$flag = false;
		  					}?>>
		  				<span class="form-check-label"><?php echo $row['course_id'];?> </span>
						</label>
				<?php
					}				
				?>
				<button type="button" onclick="change_to_checkbox('<?php echo $filter_group_class; ?>')" class="btn btn-success filter-group <?php echo $filter_group_class; ?>">Compare</button>
			</div> <!-- card-body.// -->
		</div>
	</article> <!-- card-group-item.// -->
	<article class="card-group-item">
		<header class="card-header">
			<h6 class="title">Marks Type</h6>
		</header>
		<div class="filter-content">
			<div class="card-body">
				<?php 
					$filter_group_class = "filter_condition";
					$arr = array("TOTAL", "ESE", "CA", "ORAL", "TW");
					for($i = 0; $i < count($arr); $i++){?>
						<label class="form-check">
			  				<input class="form-check-input filter-group <?php echo $arr[$i]." ".$filter_group_class ?>" type="radio" name="marks_type" value="<?php echo $arr[$i];?>" <?php 
			  				if($arr[$i] == "TOTAL")
			  					echo "checked";
			  				 ?>>
			  				<span class="form-check-label"><?php echo $arr[$i];?> </span>
						</label>
				<?php
					}				
				?>
				<button type="button" onclick="change_to_checkbox('<?php echo $filter_group_class; ?>')" class="btn btn-success <?php echo $filter_group_class ;?> filter-group">Compare</button>

			</div> <!-- card-body.// -->
		</div>
	</article> <!-- card-group-item.// -->

	<article class="card-group-item">
		<header class="card-header">
			<h6 class="title">Batch</h6>
		</header>
		<div class="filter-content">
			<div class="card-body">
				<?php 
				$filter_group_class = "batch"; 
				?>
				<div class="batch-div">
					
				</div>
				<button type="button" onclick="change_to_checkbox('<?php echo $filter_group_class; ?>')" class="btn btn-success <?php echo $filter_group_class ;?> filter-group">Compare</button>
			</div> <!-- card-body.// -->
		</div>
	</article> <!-- card-group-item.// -->

	<article class="card-group-item">
		<header class="card-header">
			<h6 class="title">Gender</h6>
		</header>
		<div class="filter-content">
			<div class="card-body">
				<?php 
					$filter_group_class = "gender";
					$arr = array("BOTH", "MALE", "FEMALE");
					for($i = 0; $i < count($arr); $i++){?>
						<label class="form-check">
			  				<input class="form-check-input filter-group <?php echo $arr[$i]." ".$filter_group_class ?>" type="radio" name="gender" value="<?php echo $arr[$i];?>" <?php if($arr[$i] == "BOTH")
			  								echo "checked"; ?>>
			  				<span class="form-check-label"><?php echo $arr[$i];?> </span>
						</label>
				<?php
					}				
				?>
				<button type="button" onclick="change_to_checkbox('<?php echo $filter_group_class; ?>')" class="btn btn-success <?php echo $filter_group_class ;?> filter-group">Compare</button>
			</div> <!-- card-body.// -->
		</div>
	</article> <!-- card-group-item.// -->
</div> <!-- card.// -->