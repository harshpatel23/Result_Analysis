<div class="container-fluid" style="padding-top: 10px">

<?php 
if (isset($_GET["page"])) {
  if ($_GET["page"] == "student-data") {
?>
<h2>Upload Student Data in csv format</h2>
<?php    
    include 'upload_student_data.php';
  }
  
  elseif ($_GET["page"] == "result-csv") {
?>
<h2>Upload Result Data in csv format</h2>
<?php
    include 'upload_csv.php';
  }
  
  elseif ($_GET["page"] == "analysis-select") {
?>
<h2>Select semester for Analysis</h2>
<form style="padding-top: 10px; width: 50%" method="get" action="index.php">
  <div class="form-group">
    <label for="sem-select">Select Semester</label>
    <select class="form-control" id="sem-select" name="sem-select">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
      <option>7</option>
      <option>8</option>
    </select>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary">Analyze</button>
  </div>
</form>
<?php
  }
}
elseif (isset($_GET["sem-select"])) {
  $_SESSION["sem-select"] = $_GET["sem-select"];
  include 'analysis.php';
}
?>

</div>