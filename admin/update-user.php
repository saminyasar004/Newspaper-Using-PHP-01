<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <?php

                include "config.php";
                if (isset($_REQUEST['edit_id'])) {
                    $edit_id = $_REQUEST['edit_id'];
                    $query_select = "SELECT * FROM user WHERE user_id = {$edit_id}";
                    $result_select = mysqli_query($connect, $query_select);
                    $count = mysqli_num_rows($result_select);
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($result_select)) {
                            $edit_fname = $row['first_name'];
                            $edit_lname = $row['last_name'];
                            $edit_username = $row['username'];
                            $edit_password = $row['password'];
                            $edit_role = $row['role'];
                        }
                    } else {
                        header("location: users.php");
                    }
                } else {
                    header("location: users.php");
                }
                if (isset($_REQUEST['submit'])) {
                    $f_name = mysqli_real_escape_string($connect, $_REQUEST['f_name']);
                    $l_name = mysqli_real_escape_string($connect, $_REQUEST['l_name']);
                    $username = mysqli_real_escape_string($connect, $_REQUEST['username']);
                    $password = $edit_password;
                    $role = mysqli_real_escape_string($connect, $_REQUEST['role']);
                    if ($f_name || $l_name || $username != "") {
                        $query_update = "UPDATE user SET first_name = '$f_name', last_name = '$l_name', username = '$username', role = '$role' WHERE user.user_id = $edit_id";
                        $result_update = mysqli_query($connect, $query_update);
                        header("location: users.php");
                    } else {
                        header("location: users.php");
                    }
                }

                ?>
                <!-- Form Start -->
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <input type="hidden" name="user_id" class="form-control" value="1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="f_name" class="form-control" value="<?php echo $edit_fname; ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="l_name" class="form-control" value="<?php echo $edit_lname; ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $edit_username; ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role" value="<?php echo $edit_role; ?>">
                            <?php
                            if ($edit_role == 1) {
                                echo "<option value='0'>Moderator</option>";
                                echo "<option value='1' selected>Admin</option>";
                            } else {
                                echo "<option value='0' selected>Moderator</option>";
                                echo "<option value='1'>Admin</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                </form>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
