<?php include "header.php"; ?>
<?php if ($_SESSION['role'] != 1) {
    header("location: post.php");
}  ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                $unavailable_msg = "";
                if (isset($_REQUEST['save'])) {
                    include "config.php";
                    $category_name = mysqli_real_escape_string($connect, $_REQUEST['category_name']);
                    $category_name = ucfirst($category_name);
                    $query_select = "SELECT * FROM category WHERE category_name = '$category_name'";
                    $result_select = mysqli_query($connect, $query_select) or die("Invalid Query." . mysqli_error($result_select));
                    $count_select = mysqli_num_rows($result_select);
                    if ($count_select > 0) {
                        $unavailable_msg = "this category is already exist. please try with another category name.";
                    } else {
                        $query_insert = "INSERT INTO category (category_name) VALUES ('$category_name')";
                        $result_insert = mysqli_query($connect, $query_insert) or die("Invalid Query." . mysqli_error($result_insert));;
                        header("location: category.php");
                    }
                }
                ?>
                <!-- Form Start -->
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="category_name" class="form-control" placeholder="Category Name" required>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                    <div class="php_error">
                        <?php echo $unavailable_msg; ?>
                    </div>
                </form>
                <!-- /Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
