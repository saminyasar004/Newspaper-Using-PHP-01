<?php

session_start();
if (isset($_SESSION['fullname'])) {
    header("location: post.php");
} else {
?>

    <!doctype html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/news.jpg">
                        <h3 class="heading">login</h3>
                        <!-- Form Start -->
                        <?php
                        $invalid_msg = "";
                        if (isset($_REQUEST['submit'])) {
                            include "config.php";
                            $username = mysqli_real_escape_string($connect, $_REQUEST['username']);
                            $password = mysqli_real_escape_string($connect, md5($_REQUEST['password']));
                            if ($username || $password != "") {
                                $query_select = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
                                $result_select = mysqli_query($connect, $query_select) or die("Invalid Query." . mysqli_error($result_select));
                                $count = mysqli_num_rows($result_select);
                                if ($count > 0) {
                                    while ($row = mysqli_fetch_assoc($result_select)) {
                                        // session_start();
                                        $user_id = $row['user_id'];
                                        $fname = $row['first_name'];
                                        $fname = ucfirst($fname);
                                        $lname = $row['last_name'];
                                        $lname = ucfirst($lname);
                                        $fullname = ($fname . " " . $lname);
                                        $username = $row['username'];
                                        $role = $row['role'];
                                        $_SESSION['username'] = $username;
                                        $_SESSION['fullname'] = $fullname;
                                        $_SESSION['role'] = $role;
                                        header("location: post.php");
                                    }
                                } else {
                                    $invalid_msg = "please enter your correct login details.";
                                }
                            } else {
                                header("location: index.php");
                            }
                        }
                        ?>
                        <div class="php_error">
                            <?php echo $invalid_msg; ?>
                        </div>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php
}
?>
