<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_REQUEST['submit'])) {
        include "config.php";
        $errors = [];
        $post_title = mysqli_real_escape_string($connect, $_REQUEST['post_title']);
        $postdesc = mysqli_real_escape_string($connect, $_REQUEST['postdesc']);
        $category_id = mysqli_real_escape_string($connect, $_REQUEST['category']);
        $query_category = "SELECT * FROM category WHERE category_id = $category_id";
        $result_category = mysqli_query($connect, $query_category);
        $count_category = mysqli_num_rows($result_category);
        if ($count_category > 0) {
            while ($row = mysqli_fetch_assoc($result_category)) {
                $category_name = $row['category_name'];
            }
        }
        $date = date("d M, Y");
        $author = $_SESSION['role'];
        if ($post_title || $postdesc || $category_id != "") {
            $image = $_FILES['fileToUpload'];
            $image_name = $image['name'];
            $image_type = $image['type'];
            $image_tmp_name = $image['tmp_name'];
            $image_size = $image['size'];
            $image_ext = end(explode('.', $image_name));
            $extensions = array("png", "jpeg", "jpg");
            if (in_array($image_ext, $extensions) === false) {
                $errors[] = "Please Select JPEG, JPG or PNG FIle.";
            }
            if ($image_size > 2097152) {
                $errors[] = "This File Is Too Large. Please Select 2MB or Lower.";
            }
            if (empty($errors) == true) {
                $loc = "upload/";
                $new_image_name = time() . "-" . basename($image_name);
                move_uploaded_file($image_tmp_name, $loc . $new_image_name);
                $query = "INSERT INTO post (title, description, category, post_date, author, post_img) VALUES ('{$post_title}', '{$postdesc}', '{$category_name}', '{$date}', '{$author}', '{$new_image_name}');";
                $query .= "UPDATE category SET post = post + 1 WHERE category_id = {$category_id}";
                $result_post = mysqli_multi_query($connect, $query);
            } else {
                print_r($errors);
                die();
            }
            header("location: post.php");
        } else {
            header("location: add-post.php");
        }
    }
    ?>
</body>

</html>
