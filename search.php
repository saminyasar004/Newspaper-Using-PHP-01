<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    include "admin/config.php";
                    if (isset($_REQUEST['submit'])) {
                        $keyword = $_REQUEST['key'];
                    } else {
                        $keyword = $_REQUEST['keyword'];
                    }
                    ?>
                    <h2 class="page-heading">Search Result For "<?php echo $keyword; ?>"</h2>
                    <?php
                    if (isset($_REQUEST['current_page'])) {
                        $current_page = $_REQUEST['current_page'];
                    } else {
                        $current_page = 1;
                    }
                    $limit = 5;
                    $offset = ($current_page - 1) * $limit;
                    if ($keyword != "") {
                        $query_search = "SELECT * FROM post WHERE title LIKE '%$keyword%' LIMIT {$offset}, {$limit}";
                        $result_search = mysqli_query($connect, $query_search);
                        $count_search = mysqli_num_rows($result_search);
                        if ($count_search > 0) {
                            while ($row_search = mysqli_fetch_assoc($result_search)) {
                                $post_id = $row_search['post_id'];
                                $post_title = $row_search['title'];
                                $post_description = $row_search['description'];
                                $post_category = $row_search['category'];
                                $post_date = $row_search['post_date'];
                                $post_author = $row_search['author'];
                                $post_img = $row_search['post_img'];

                    ?>
                                <div class="post-content">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a class="post-img" href="single.php?post_id=<?php echo $post_id; ?>"><img src="admin/upload/<?php echo $post_img; ?>" /></a>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="inner-content clearfix">
                                                <h3><a href='single.php'><?php echo $post_title; ?></a></h3>
                                                <div class="post-information">
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
                                                        <i class="fa fa-user" aria-hidden="true"></i>
                                                        <a href='author.php?author=<?php echo $post_author ?>'><?php
                                                                                                                if ($post_author == 1) {
                                                                                                                    echo "Admin";
                                                                                                                } else {
                                                                                                                    echo "Moderator";
                                                                                                                }
                                                                                                                ?></a>
                                                    </span>
                                                    <span>
                                                        <i class="fa fa-calendar" aria-hidden="true"></i><?php echo $post_date;  ?></span>
                                                </div>
                                                <p class="description"><?php echo substr($post_description, 0, 150) . "...";  ?></p>
                                                <a class='read-more pull-right' href='single.php'>read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    }
                    ?>
                    <?php
                    $query_pagination = "SELECT * FROM post";
                    $result_pagination = mysqli_query($connect, $query_pagination);
                    $count_data = mysqli_num_rows($result_pagination);
                    if ($count_data > 0) {
                        $total_page = ceil($count_data / $limit);
                    ?>
                        <ul class='pagination'>
                            <?php
                            if ($total_page > 1) {
                                if ($current_page > 1) {
                            ?>
                                    <li><a href="search.php?keyword=<?php echo $keyword; ?>&current_page=<?php echo ($current_page - 1); ?>">⇽</a></li>
                                <?php
                                }
                                for ($i = 1; $i <= $total_page; $i++) {
                                    if ($current_page == $i) {
                                        $active = "active";
                                    } else {
                                        $active = "";
                                    }
                                ?>
                                    <li class="<?php echo $active; ?>"><a href="search.php?keyword=<?php echo $keyword; ?>&current_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php
                                }
                                if ($current_page < $total_page) {
                                ?>
                                    <li><a href="search.php?keyword=<?php echo $keyword; ?>&current_page=<?php echo ($current_page + 1); ?>">⇾</a></li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    <?php
                    }
                    ?>

                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
