<?php

session_start();
$message = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $server = "localhost";
    $username="root";
    $pass = "";
    $dbname = "temp";

    $con=mysqli_connect($server,$username,$pass,$dbname);

    $name = $_POST['name'];
    $rno = $_POST['rno'];
    $branch = $_POST['branch'];
    $sem = $_POST['sem'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $date = date("Y-m-d");
    $workshop = $_POST['workshop'];
    $gender = $_POST['gender'];
    $desc = $_POST['desc'];

    $check = "SELECT * FROM `students` WHERE rno ='$rno'";
    $result=$con->query($check);

    if($result->num_rows > 0){
        $_SESSION['message'] = "You Have Already Registered";
    }else{
        $sql="INSERT INTO `students` (`sno`, `name`, `rno`, `branch`, `semester`, `email`, `mobile`, `gender`, `workshop`, `description`, `reg_date`) VALUES (NULL, '$name', '$rno', '$branch', '$sem', '$email', '$mobile', '$gender', '$workshop', '$desc', '$date');";

        if($con->query($sql)){
            $_SESSION['message'] = "Registered Successfully";
            
        }else{
            $_SESSION['message'] = "Registration fail";
        }
        

    }

    $con->close();

    header('Location:registration.php');
    exit();
}

    if(isset($_SESSION['message'])){
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Yourself</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="r-form">
        <?php
        if($message != ''){
            echo"<h4>".$message."</h4>";
        }
        ?>
        <form action="registration.php" method="post">
            <lable for="name">Name:</lable>
            <input type="text" name="name" id="name" required><br>
            <lable for="rno">Roll no:</lable>
            <input type="number" name="rno" id="rno" required><br>
            <lable for="branch">Branch:</lable>
            <input type="text" name="branch" id="branch" required><br>
            <lable for="sem">Semester:</lable>
            <input type="text" name="sem" id="sem" required><br>
            <lable for="email">Email:</lable>
            <input type="email" name="email" id="email" required><br>
            <label for="mobile">Mobile:</label>
            <input type="text" name="mobile" id="mobile" required><br>
            <?php
                    
                        $server = "localhost";
                        $username = "root";
                        $pass = "";
                        $dbname="temp";

                        $con=mysqli_connect($server,$username,$pass,$dbname);

                        $sql = "SELECT * FROM registration;";

                        $result = $con->query($sql);
                        ?>
            <lable for="workshop">Workshop</lable>
            <select id="workshop" name="workshop">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='".$row['workshop_name']."'>".$row['workshop_name']."</option>";
                }

                ?>
                </select>
            <label>Gender:</label>

            <label for="male">Male</label>
            <input type="radio" name="gender" id="male" value="male">

            <label for="female">Female</label>
            <input type="radio" name="gender" id="female" value="female">
            <lable for="description">Description</lable>
            <input type="text" name="desc" id="description"><br>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>