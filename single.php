<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    if (isset($_REQUEST['post_id'])) {
                        include "admin/config.php";
                        $post_id = $_REQUEST['post_id'];
                        $query_post = "SELECT * FROM post WHERE post_id = '$post_id'";
                        $result_post = mysqli_query($connect, $query_post);
                        $count_post = mysqli_num_rows($result_post);
                        if ($count_post > 0) {
                            while ($row_post = mysqli_fetch_assoc($result_post)) {
                                $post_title = $row_post['title'];
                                $post_description = $row_post['description'];
                                $post_category = $row_post['category'];
                                $post_date = $row_post['post_date'];
                                $post_author = $row_post['author'];
                                $post_img = $row_post['post_img'];
                            }
                        }
                    }
                    ?>
                    <div class="post-content single-post">
                        <h3><?php echo $post_title; ?></h3>
                        <div class="post-information">
                            <span>
                                <i class="fa fa-tags" aria-hidden="true"></i><?php echo $post_category; ?></span>
                            <span>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <a href='author.php'>
                                    <?php
                                    if ($post_author == 1) {
                                        echo "Admin";
                                    } else {
                                        echo "Moderator";
                                    }
                                    ?>
                                </a>
                            </span>
                            <span>
                                <i class="fa fa-calendar" aria-hidden="true"></i><?php echo $post_date; ?></span>
                        </div>
                        <img class="single-feature-image" src="admin/upload/<?php echo $post_img; ?>" />
                        <p class="description">
                            <?php echo $post_description; ?>
                        </p>
                    </div>
                </div>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
