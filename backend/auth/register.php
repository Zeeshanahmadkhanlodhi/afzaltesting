<?php
  $server = "localhost";
  $username = "root";
  $database = "facebook";
  $password = "";

  $con = mysqli_connect($server , $username , $password ,$database );
  
  if($con == true){
    echo "connection success";
  }
    
  $abc_username = $_POST['UserName'];
  $abc_email = $_POST['EmailAdress'];
  $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);

  $sql=  "INSERT INTO `users` (`Username`, `email`, `password` , `createdAt`) 
  VALUES ('$abc_username', '$abc_email', '$password' , current_timestamp())";

   
if ($con->query($sql) == true){
    echo "Successfully inserted";
}else{
    echo "Error" . mysqli_error($con);
}

$con->close();
?>