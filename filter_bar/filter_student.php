<div class="card">
				<article class="card-group-item">
					<header class="card-header">
						<h6 class="title">Semester</h6>
					</header>
					<div class="filter-content">
						<div class="card-body">
							<?php 
								$current_sem = $_SESSION['uname'][0];
								for($i = 1;$i < $current_sem;$i++){	?>

									<label class="form-check">
						  				<input class="form-check-input" type="radio" name="semester" value="sem<?php echo $i;?>">
						  				<span class="form-check-label">Semester <?php echo $i;?> </span>
									</label>
							<?php
								}				
							?>
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
								$arr = array("CGPA","ESE","CA");
								for($i = 0;$i < count($arr);$i++){	?>

									<label class="form-check">
						  				<input class="form-check-input" type="radio" name="semester" value="<?php echo $arr[$i];?>">
						  				<span class="form-check-label"><?php echo $arr[$i];?> </span>
									</label>
							<?php
								}				
							?>
						</div> <!-- card-body.// -->
					</div>
				</article> <!-- card-group-item.// -->
</div> <!-- card.// -->