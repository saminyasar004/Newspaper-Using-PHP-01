<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method="POST" autocomplete="off">
            <div class="input-group">
                <input type="text" name="key" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <input type="submit" value="Search" name="submit" class="btn btn-danger">
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
        include "admin/config.php";
        $limit = 4;
        $offset = (1 - 1) * $limit;
        $query_post = "SELECT * FROM post ORDER BY post_id DESC LIMIT {$offset}, {$limit}";
        $result_post = mysqli_query($connect, $query_post);
        $count_post = mysqli_num_rows($result_post);
        if ($count_post > 0) {
            while ($row_post = mysqli_fetch_assoc($result_post)) {
                $post_id = $row_post['post_id'];
                $post_title = $row_post['title'];
                $post_description = $row_post['description'];
                $post_category = $row_post['category'];
                $post_date = $row_post['post_date'];
                $post_author = $row_post['author'];
                $post_img = $row_post['post_img'];
        ?>

                <div class="recent-post">
                    <a class="post-img" href="single.php?post_id=<?php echo $post_id; ?>">
                        <img src="admin/upload/<?php echo $post_img; ?>" />
                    </a>
                    <div class="post-content">
                        <h5><a href="single.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></h5>
                        <span>
                            <?php
                            $query_category = "SELECT * FROM category WHERE category_name = '$post_category'";
                            $result_category = mysqli_query($connect, $query_category);
                            $count_category = mysqli_num_rows($result_category);
                            if ($count_category > 0) {
                                while ($row_category = mysqli_fetch_assoc($result_category)) {
                                    $category_id = $row_category['category_id'];
                                    $category_name = $row_category['category_name'];
                                }
                            }
                            ?>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href='category.php?category_id=<?php echo $category_id; ?>'><?php echo $post_category; ?></a>
                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i><?php echo $post_date; ?></span>
                        <a class="read-more" href="single.php?post_id=<?php echo $post_id; ?>">read more</a>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <!-- /recent posts box -->
</div>
