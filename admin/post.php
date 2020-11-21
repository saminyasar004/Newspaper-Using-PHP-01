<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <?php
                include "config.php";
                if (isset($_REQUEST['current_page'])) {
                    $current_page = $_REQUEST['current_page'];
                } else {
                    $current_page = 1;
                }
                $limit = 8;
                $offset = ($current_page - 1) * $limit;
                if ($_SESSION['role'] == 1) {
                    $query_post = "SELECT * FROM post LIMIT {$offset}, {$limit}";
                } else {
                    $role = $_SESSION['role'];
                    $query_post = "SELECT * FROM post WHERE author = '$role' LIMIT {$offset}, {$limit}";
                }
                $result_post = mysqli_query($connect, $query_post);
                $count_post = mysqli_num_rows($result_post);
                if ($count_post > 0) {
                    $serial_num = 0;
                ?>
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Image</th>
                            <th>Post ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Author</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result_post)) {
                                $post_id = $row['post_id'];
                                $post_title = $row['title'];
                                $post_des = $row['description'];
                                $post_category = $row['category'];
                                $post_date = $row['post_date'];
                                $post_author = $row['author'];
                                $post_img = $row['post_img'];
                                $serial_num++;
                            ?>
                                <tr>
                                    <td class='id'><?php echo $serial_num; ?></td>
                                    <td class="post_img"><img src="upload/<?php echo $post_img; ?>"></td>
                                    <td><?php echo $post_id; ?></td>
                                    <td><?php echo $post_title; ?></td>
                                    <td><?php echo $post_category; ?></td>
                                    <td><?php echo $post_date; ?></td>
                                    <td><?php
                                        if ($post_author == 1) {
                                            echo "Admin";
                                        } else {
                                            echo "Moderator";
                                        }
                                        ?></td>
                                    <td class='edit'><a href='update-post.php?edit_id=<?php echo $post_id; ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a onclick="return confirm('Are You Sure To Delete This Post?')" href='delete-post.php?delete_id=<?php echo $post_id; ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo $end_data = "no post found on your database.";
                }
                ?>
                <?php
                $query_pagination = "SELECT * FROM post";
                $result_pagination = mysqli_query($connect, $query_pagination);
                $total_data = mysqli_num_rows($result_pagination);
                if ($total_data > 0) {
                    $total_page = ceil($total_data / $limit);
                    if ($total_page > 1) {
                ?>
                        <ul class='pagination admin-pagination'>
                            <?php
                            if ($current_page > 1) {
                            ?>
                                <li><a href="post.php?current_page=<?php echo ($current_page - 1) ?>">⇽</a></li>
                            <?php
                            }
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($i == $current_page) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                            ?>
                                <li class="<?php echo $active; ?>"><a href="post.php?current_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                            }
                            if ($current_page < $total_page) {
                            ?>
                                <li><a href="post.php?current_page=<?php echo ($current_page + 1) ?>">⇾</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                <?php
                    }
                } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
