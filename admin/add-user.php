<?php include "header.php"; ?>
<?php if ($_SESSION['role'] != 1) {
    header("location: post.php");
}  ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add User</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <?php

                $unavailable_user = "";
                if (isset($_REQUEST['submit'])) {
                    include "config.php";
                    $fname = mysqli_real_escape_string($connect, $_REQUEST['fname']);
                    $lname = mysqli_real_escape_string($connect, $_REQUEST['lname']);
                    $user = mysqli_real_escape_string($connect, $_REQUEST['user']);
                    $password = mysqli_real_escape_string($connect, md5($_REQUEST['password']));
                    $role = mysqli_real_escape_string($connect, $_REQUEST['role']);
                    $query_select = "SELECT * FROM user WHERE username = '$user'";
                    $result_select = mysqli_query($connect, $query_select) or die("Invalid Query." . mysqli_error($result_select));
                    $count = mysqli_num_rows($result_select);
                    if ($count > 0) {
                        $unavailable_user = "This username is already taken. Please try with another username.";
                    } else {
                        $query_insert = "INSERT INTO user (first_name, last_name, username,	password, role) VALUE ('$fname', '$lname', '$user', '$password', '$role')";
                        $result_insert = mysqli_query($connect, $query_insert) or die("Invalid Query." . mysqli_error($result_insert));
                        if ($result_insert) {
                            header("location: users.php");
                        } else {
                            header("location: add-user.php");
                        }
                    }
                }

                ?>

                <div class="php_error">
                    <?php echo $unavailable_user;  ?>
                </div>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="user" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option value="0">Moderator</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Add" required />
                </form>
                <!-- Form End-->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
