<?php
 require_once '../config.php';


    
  $abc_username = $_POST['UserName'];
  $abc_email = $_POST['EmailAdress'];
  $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);

  $sql=  "INSERT INTO `users` (`Username`, `email`, `password` , `createdAt`) 
  VALUES ('$abc_username', '$abc_email', '$password' , current_timestamp())";

   
if ($conn->query($sql) == true){
    header("Location: ../feed.php");  

}else{
    echo "Error" . mysqli_error($conn);
}

$conn->close();
?>