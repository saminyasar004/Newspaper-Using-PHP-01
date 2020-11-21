<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                if (isset($_REQUEST['edit_id'])) {
                    include "config.php";
                    $edit_id = $_REQUEST['edit_id'];
                    $query_select = "SELECT * FROM category WHERE category_id = '$edit_id'";
                    $result_select = mysqli_query($connect, $query_select) or die("Connection Failed");
                    $count = mysqli_num_rows($result_select);
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($result_select)) {
                            $edit_category_name = $row['category_name'];
                        }
                    } else {
                        header("location: category.php");  
                    }
                } else {
                    header("location: category.php");
                }
                if (isset($_REQUEST['sumbit'])) {
                    $category_name = mysqli_real_escape_string($connect, $_REQUEST['category_name']);
                    if ($category_name != "") {
                        $query_update = "UPDATE category SET category_name = '$category_name' WHERE category.category_id = '$edit_id'";
                        $reslut_update = mysqli_query($connect, $query_update) or die("Connection Failed");
                        header("location: category.php");
                    } else {
                        header("location: category.php");
                    }
                }
                ?>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="cat_id" class="form-control" value="1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="category_name" class="form-control" value="<?php echo $edit_category_name; ?>" placeholder="" required>
                    </div>
                    <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
