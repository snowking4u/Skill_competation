<?php
session_start();

$message = "";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $con = mysqli_connect("localhost","root","","database");

    $name=$_POST['name'];
    $rno = $_POST['rno'];
    $branch = $_POST['branch'];
    $semester = $_POST['semester'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $workshop = $_POST['workshop'];
    $gender = $_POST['gender'];

    $check = "SELECT * FROM `students` WHERE rno ='$rno';";

    $result = $con->query($check);

    if($result->num_rows > 0){
        $_SESSION['message']="You Have Already Registrated";
    }else{
        $sql = "INSERT INTO `students` (`sno`, `name`, `rno`, `branch`, `semester`, `email`, `mobile`, `gender`, `workshop`) VALUES (NULL, '$name', '$rno', '$branch', '$semester', '$email', '$mobile', '$gender', '$workshop');";

        if($con->query($sql)){
            $_SESSION['message'] = "Registration Successfull";
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
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <main>
        <div class="r-box">
            <h1>Student Registration Form</h1>
            <?php
            if(isset($message)){
                echo"<h4>".$message."</h4>";
            }
            ?>
            <form action="registration.php" method="post">
                <label for="name">Student Name:</label>
                <input type="text" name="name" id="name" placeholder="Enter You Name" required><br>
                <label for="rno">Roll NO:</label>
                <input type="number" name="rno" id="rno" placeholder="Enter You Roll NO" required><br>
                <label for="branch">branch Name:</label>
                <input type="text" name="branch" id="branch" placeholder="Enter You Branch" required><br>
                <label for="semester">Semester:</label>
                <input type="text" name="semester" id="semester" placeholder="Enter You Semester" required><br>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Enter You Email" required><br>
                <label for="mobile">Mobile Number:</label>
                <input type="number" name="mobile" id="mobile" placeholder="Enter You Mobile Number" required><br>
                <label for="workshop">Workshop</label>
                <select id="workshop" name="workshop">
                    <?php
                    $con=mysqli_connect("localhost","root","","database");

                    $sql = "SELECT * FROM `workshop`;";
                    $result = $con->query($sql);
                    while($row = mysqli_fetch_assoc($result)){
                    echo"<option value='".$row['workshop_name']."'>".$row['workshop_name']."</option>";
                    }
                ?>
                </select>
                <label >Gender</label>
                <label for="male">Male</label>
                <input type="radio" name="gender" value="male" id="male">
                <label for="female">Female</label>
                <input type="radio" name="gender" value="femail" id="female">
                <label for="declaration">Declaration:</label>
                <input type="text" name="declaration" id="declaration" placeholder="Are you Agree or not" required><br>
                <button type="submit">Submit</button>
            </form>
        </div>
    </main>
</body>
</html>