<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>News Site</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                    <a href="index.php" id="logo"><img src="images/news.jpg"></a>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (isset($_REQUEST['category_id'])) {
                        $current_category_id = $_REQUEST['category_id'];
                    }
                    include "admin/config.php";
                    $query_category = "SELECT * FROM category WHERE post > 0";
                    $reslut_category = mysqli_query($connect, $query_category);
                    $count_category = mysqli_num_rows($reslut_category);
                    $active = "";
                    ?>
                    <ul class='menu'>
                        <?php
                        while ($row_category = mysqli_fetch_assoc($reslut_category)) {
                            $category_id = $row_category['category_id'];
                            $category_name = $row_category['category_name'];
                            $category_post = $row_category['post'];
                            if (isset($_REQUEST['category_id'])) {
                                if ($current_category_id == $category_id) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                            }
                        ?>
                            <li><a class="<?php echo $active; ?>" href='category.php?category_id=<?php echo $category_id; ?>'><?php echo $category_name; ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->
