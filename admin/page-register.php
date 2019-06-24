<?php 
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users VALUES('$id', '$hash_password', '$role')";
        // echo $query;

        $query_result = $conn->query($query);

        if ($conn->errorCode() != 0){
            // die("ERROR!!!");
            $_SESSION['user_added_success'] = false;
            header("Location: page-register.php");

        }else{
            // SUCCESS
            $_SESSION['user_added_success'] = true;
            header("Location:  page-register.php");
        }
    }
?>


    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-content">
                        <?php
                        if(isset($_SESSION['user_added_success']) && $_SESSION['user_added_success'] === true){
                            $_SESSION['user_added_success'] = null;
                        ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>Success!!!</strong> Uploaded to database.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <?php
                        }else if(isset($_SESSION['user_added_success']) && $_SESSION['user_added_success'] === false){
                            $_SESSION['user_added_success'] = null;
                        ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>Error!!!</strong> Failed to add User. Check ur network connection and make sure the user id is unique
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="login-form">
                            <h4>User Registration</h4>
                            <form method="post">
                                <div class="form-group">
                                    <label>User Id</label>
                                    <input type="number" name="id" class="form-control" placeholder="User Id">
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" name="role" required id="role">
                                        <option value="teacher">Teacher</option>
                                        <option value="exam_section">Exam Section</option>
                                        <option value="hod_comps">HOD Comps</option>
                                        <option value="hod_mech">HOD Mech</option>
                                        <option value="hod_it">HOD IT</option>
                                        <option value="hod_extc">HOD EXTC</option>
                                        <option value="hod_etrx">HOD ETRX</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="New User Password">
                                </div>
                                <button name="submit" type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Add User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>