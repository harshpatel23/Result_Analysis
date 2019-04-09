<?php include './includes/db_conn.php'; ?>
<script type="text/javascript">
	var page = "filters/hod_filter.php";
</script>
<div class="card">
	<article class="card-group-item">
		<header class="card-header">
			<h6 class="title">Teachers</h6>
		</header>
		<div class="filter-content">
			<?php $filter_group_class = "teacher_id"; ?>
			<div class="card-body">
				<label class="form-check">
	  				<input class="form-check-input filter-group <?php echo $filter_group_class;?>" type="radio" name="teachers_id" value="ALL" checked>
	  				<span class="form-check-label">ALL</span>
				</label>
				<?php
					$sql = "SELECT DISTINCT teacher_id FROM teacher_to_courses;";
					$result = $conn->query($sql);
					while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
						<label class="form-check">
			  				<input class="form-check-input filter-group <?php echo $filter_group_class;?>" type="radio" name="teachers_id" value="<?php echo $row['teacher_id'];?>">
			  				<span class="form-check-label"><?php echo $row['teacher_id'];?> </span>
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
			<h6 class="title">All Courses</h6>
		</header>
		<div class="filter-content">
			<div class="card-body">
				<?php $filter_group_class = "course_id"; ?>
				<label class="form-check">
	  				<input class="form-check-input filter-group <?php echo $filter_group_class;?>" type="radio" name="my_courses" value="ALL" checked>
	  				<span class="form-check-label">ALL</span>
				</label>
				<?php 
					
					$sql = "SELECT course_id, type FROM teacher_to_courses;";
					$result = $conn->query($sql);
					$flag = true;
					while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
						<label class="form-check">
							<!-- <?php //$url = "teacher_filter.php?filter_condition=".$_SESSION['marks_type']."&course_id=".$row['course_id']; ?> -->
		  				<input class="form-check-input filter-group <?php echo $row['type']." ".$filter_group_class;?>" type="radio" name="my_courses" value="<?php echo $row['course_id'];?>">
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