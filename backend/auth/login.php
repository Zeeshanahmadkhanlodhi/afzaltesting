<?php
 session_start();

 require_once '../config.php';


$EmailAddress = $_POST['EmailAddress'];
$Password = $_POST['Password'];

$sql = "select * from users where email = '$EmailAddress'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    // Get user data from database
    $user = mysqli_fetch_assoc($result);
   
    // {"username":"zeeshan", email:"zeeshan#gmail.com"}
   
    // Compare entered password with database password
    if (password_verify($Password, $user['password'])) {

       
        $_SESSION["user_id"] = $user["User_id"];
        header("Location: ../feed.php");
        exit();
    } else {

        echo "Incorrect password";

    }

} else {

    echo "User not found";

}

mysqli_close($conn);
?>

