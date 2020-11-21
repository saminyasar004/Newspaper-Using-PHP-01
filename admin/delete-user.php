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
        $query = "DELETE FROM user WHERE user_id = $delete_id";
        $result = mysqli_query($connect, $query);
        header("location: users.php");
    } else {
        header("location: users.php");
    }
    
    ?>
</body>
</html>
