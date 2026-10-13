<?php
session_start();
$message = "";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $con = mysqli_connect("localhost","root","","database");

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM `users` Where `email`='$email' AND `passwd`='$pass';";
    $result = $con->query($sql);
    if($result->num_rows == 1){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id']=$row['sno'];
        $_SESSION['name']=$row['name'];
        header('Location:admin.php');
        exit();
    }else{
        $_SESSION['message']="Login Fail !!";
    }
    $con->close();
}
if(isset($_SESSION['message'])){
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
if(isset($_SESSION['user_id'])){
    header('Location:admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <main>
        <div class="f-box">
            <h1>Admin Login</h1>
            <?php
            if(isset($message)){
                echo"<h4>".$message."</h4>";
            }
            ?>
            <form action="login.php" method="post">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Enter You Email" required><br>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter You Password" required><br>
                <button type="submit">Login</button>
            </form>
        </div>
    </main>
</body>
</html>