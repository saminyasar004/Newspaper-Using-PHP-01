<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_REQUEST['submit'])) {
        include "config.php";
        $errors = array();
        $post_title = mysqli_real_escape_string($connect, $_REQUEST['post_title']);
        $post_desc = mysqli_real_escape_string($connect, $_REQUEST['postdesc']);
        $post_category = mysqli_real_escape_string($connect, $_REQUEST['category']);
        $old_category_name = $_REQUEST['old_category_name'];
        $edit_id = $_REQUEST['edit_id'];
        $old_image = $_REQUEST['old_image'];
        $new_image = $_FILES['new_image'];
        $new_image_name = $new_image['name'];
        if (empty($new_image_name)) {
            $new_name = $old_image;
        } else {
            $new_image_type = $new_image['type'];
            $new_image_tmp_name = $new_image['tmp_name'];
            $new_image_size = $new_image['size'] . "<br>";
            $new_image_ext = end(explode(".", $new_image_name));
            $extensions = array("png", "jpg", "jpeg");
            if (in_array($new_image_ext, $extensions) === false) {
                $erors[] = "Please Select A PNG/JPG or JPEG File.";
            }
            if ($new_image_size > 2097152) {
                $errors[] = "Please Select A File Within 2Mb.";
            }
            $loc = "upload/";
            unlink($loc . $old_image);
            $new_name = time() . "-" . basename($new_image_name);
            move_uploaded_file($new_image_tmp_name, $loc . $new_name);
        }
        if (empty($errors) === true) {
            $query_post = "UPDATE post SET title = '$post_title', description = '$post_desc', category = '$post_category', post_img = '$new_name' WHERE post.post_id = '$edit_id'";
            $result_post = mysqli_query($connect, $query_post);
            if ($old_category_name != $post_category) {
                $query_category1 = "UPDATE category SET post = post + 1 WHERE category_name = '$post_category'";
                $result_category1 = mysqli_query($connect, $query_category1);
                $query_category2 = "UPDATE category SET post = post - 1 WHERE category_name = '$old_category_name'";
                $result_category2 = mysqli_query($connect, $query_category2);
            }
            header("location: post.php");
        } else {
            print_r($errors);
            die();
        }
    } else {
        header("location: post.php");
    }
    ?>
</body>

</html>
