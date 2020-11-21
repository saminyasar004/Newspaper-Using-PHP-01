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
        $query = "DELETE FROM category WHERE category_id = $delete_id";
        $reslut = mysqli_query($connect, $query);
        header("location: category.php");
    } else {
        header("location: category.php");
    }
    ?>
</body>

</html>
