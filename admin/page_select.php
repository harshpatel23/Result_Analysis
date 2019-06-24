<div class="container-fluid" style="padding-top: 10px">
  <?php 
    if (isset($_GET['page'])) {
      if ($_GET['page'] == 'teacher-subject') {
        include 'teacher_subject_form.php';
      } elseif ($_GET['page'] == 'register') {
        include 'page-register.php';
      }
    }
  ?>
</div>