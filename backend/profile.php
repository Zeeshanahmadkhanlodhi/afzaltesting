<?php

session_start();

require_once 'config.php';
if (!isset($_SESSION["user_id"])) {
    header("Location: auth/login.html");
    exit();
}

$user_id = $_SESSION["user_id"];
$sql = "Select * from users where User_id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
$username = $user["Username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $username; ?>'s Profile</title>
</head>
<body>
    
</body>
</html>