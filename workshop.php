<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $con=mysqli_connect("localhost","root","","temp");

    $name = $_POST['workshop_name'];
    $date = $_POST['workshop_date'];
    $time = $_POST['workshop_time'];
    $venue = $_POST['venue'];
    $max_seats = $_POST['max_seats'];
    $description = $_POST['workshop_description'];

    $sql = "INSERT INTO `registration` (`workshop_id`, `workshop_name`, `workshop_date`, `workshop_time`, `venue`, `max_seats`, `description`) VALUES (NULL, '$name', '$date', '$time', '$venue', '$max_seats', '$description');";

    if($con->query($sql)){
        header("Location:workshop.php");
        exit();
    }
    $con->close();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Workshop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location:login.php");
        exit();
    }
    ?>
    <form action="workshop.php" method="post">
        <label for="workshop_name">Workshop Name:</label>
        <input type="text" id="workshop_name" name="workshop_name" required><br><br>
        <label for="workshop_date">Workshop Date:</label>
        <input type="date" id="workshop_date" name="workshop_date" required><br><br>
        <label for="workshop_time">Workshop Time:</label>
        <input type="time" id="workshop_time" name="workshop_time" required><br><br>
        <label for="workshop_location">Workshop Venue:</label>
        <input type="text" id="workshop_location" name="venue" required><br><br>
        <label for="max_seats">Maximum Seats:</label>
        <input type="number" id="max_seats" name="max_seats" min="1" required><br><br>
        <label for="workshop_description">Workshop Description:</label><br>
        <textarea id="workshop_description" name="workshop_description" rows="4" cols="50" required></textarea><br><br>
        <input type="submit" value="Register Workshop">
    </form>

</body>
</html>