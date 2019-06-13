<?php include './includes/db_conn.php'; ?>
<script type="text/javascript">
	var page = "filters/teacher_filter.php";
</script>

<ul>
	<li class="label" style="color: white">My Courses</li>
	<li style="padding-left: 20px;">
		<div class="filter-content">
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
		</div>
	</li>

	<li class="label" style="color: white">Marks Type</li>
	<li style="padding-left: 20px;">
		<div class="filter-content">
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
		</div>
	</li>

	<li class="label" style="color: white">Batch</li>
	<li style="padding-left: 20px;">
		<div class="filter-content">
				<?php 
				$filter_group_class = "batch"; 
				?>
				<div class="batch-div">
					
				</div>
				<button type="button" onclick="change_to_checkbox('<?php echo $filter_group_class; ?>')" class="btn btn-success <?php echo $filter_group_class ;?> filter-group">Compare</button>
		</div>
	</li>	

	<li class="label" style="color: white">Gender</li>
	<li style="padding-left: 20px;">
		<div class="filter-content">
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
		</div>
	</li>
</ul>
