<?php include "header.php"; ?>
<?php if ($_SESSION['role'] != 1) {
    // header("location: post.php");
}  ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <form action="save-post.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_title">Title</label>
                        <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Category</label>
                        <select name="category" class="form-control">
                            <option value="0" disabled selected>Select Category</option>
                            <?php
                            include "config.php";
                            $query_category = "SELECT * FROM category";
                            $result_category = mysqli_query($connect, $query_category);
                            $count_category = mysqli_num_rows($result_category);
                            if ($count_category > 0) {
                                while ($row = mysqli_fetch_assoc($result_category)) {
                                    $category_id = $row['category_id'];
                                    $category_name = $row['category_name'];
                            ?>
                                    <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Post image</label>
                        <input type="file" name="fileToUpload" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                </form>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
