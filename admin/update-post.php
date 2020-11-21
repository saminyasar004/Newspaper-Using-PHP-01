<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                if (isset($_REQUEST['edit_id'])) {
                    $edit_id = $_REQUEST['edit_id'];
                    include "config.php";
                    $query_post = "SELECT * FROM post WHERE post_id = $edit_id";
                    $result_post = mysqli_query($connect, $query_post);
                    $count_post = mysqli_num_rows($result_post);
                    if ($count_post > 0) {
                        while ($row_post = mysqli_fetch_assoc($result_post)) {
                            $post_title = $row_post['title'];
                            $post_description = $row_post['description'];
                            $post_category = $row_post['category'];
                            $post_img = $row_post['post_img'];
                        }
                    } else {
                        header("location: post.php");
                    }
                } else {
                    header("location: post.php");
                }
                ?>
                <!-- Form for show edit-->
                <form action="save-update-post.php?old_category_name=<?php echo $post_category; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group">
                        <input type="hidden" name="edit_id" class="form-control" value="<?php echo $edit_id; ?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputTile">Title</label>
                        <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?php echo $post_title; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control" required rows="5"><?php echo $post_description; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCategory">Category</label>
                        <select class="form-control" name="category">

                            <?php
                            $query_category = "SELECT * FROM category";
                            $result_category = mysqli_query($connect, $query_category);
                            $count_category = mysqli_num_rows($result_category);
                            if ($count_category > 0) {
                                while ($row_category = mysqli_fetch_assoc($result_category)) {
                                    $category_id = $row_category['category_id'];
                                    $category_name = $row_category['category_name'];
                                    if ($category_name == $post_category) {
                            ?>
                                        <option value="<?php echo $post_category; ?>" selected><?php echo $post_category; ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?php echo $category_name; ?>"><?php echo $category_name; ?></option>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Post image</label>
                        <input type="file" name="new_image">
                        <img src="upload/<?php echo $post_img; ?>" height="150px">
                        <input type="hidden" name="old_image" value="<?php echo $post_img; ?>">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                </form>
                <!-- Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
