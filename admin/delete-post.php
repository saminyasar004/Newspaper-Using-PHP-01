<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_REQUEST['delete_id'])) {
        include "config.php";
        $delete_id = $_REQUEST['delete_id'];
        $query_select = "SELECT * FROM post WHERE post_id = $delete_id";
        $result_select = mysqli_query($connect, $query_select);
        $count_select = mysqli_num_rows($result_select);
        if ($count_select > 0) {
            while ($row_post = mysqli_fetch_assoc($result_select)) {
                $post_img = $row_post['post_img'];
                $post_category = $row_post['category'];
            }
        }
        $query_category = "SELECT * FROM category WHERE category_name = '$post_category'";
        $result_category = mysqli_query($connect, $query_category);
        $count_category = mysqli_num_rows($result_category);
        if ($count_category > 0) {
            while ($row_category = mysqli_fetch_assoc($result_category)) {
                $category_id = $row_category['category_id'];
            }
        }
        // echo $post_category . "<br>";
        // echo $category_id . "<br>";
        unlink("upload/" . $post_img);
        $query_update = "UPDATE category SET post = post - 1 WHERE category_id = {$category_id}";
        $result_update = mysqli_query($connect, $query_update);
        $query_delete = "DELETE FROM post WHERE post_id = $delete_id";
        $result_delete = mysqli_query($connect, $query_delete);
        header("location: post.php");
    } else {
        header("location: post.php");
    }
    ?>
</body>

</html>
