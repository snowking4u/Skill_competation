<?php

session_start();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $con=mysqli_connect("localhost","root","","temp");

    $email= $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE email='$email' AND pass='$pass';";

    $result = $con->query($sql);

    if($result->num_rows == 1){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id']=$row['sno'];
        $_SESSION['user_name']=$row['name'];
        header("Location:admin.php");
        exit();
    }else{
        echo"invalid username and password";
    }
    $con->close();
}
if (isset($_SESSION['user_id'])) {
    header("Location: admin.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <label for="password" >Password:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Login</button>
    </form>
    
</body>
</html>