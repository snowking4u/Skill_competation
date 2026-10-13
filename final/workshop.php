<?php
session_start();
$message = "";

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $con = mysqli_connect("localhost", "root", "", "database");

    $workshop_name = $_POST['workshop_name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $venue = $_POST['venue'];
    $max_seats = $_POST['seats'];
    $description = $_POST['description'];

    $sql = "INSERT INTO `workshop` (`sno`, `workshop_name`, `date`, `time`, `venue`, `max_seats`, `description`) VALUES (NULL, '$workshop_name', '$date', '$time', '$venue', '$max_seats', '$description');";

    if ($con->query($sql)) {
        $_SESSION['message'] = "Workshop Registered";
        header("Location: workshop.php");
        exit();
    } else {
        $_SESSION['message'] = "Workshop Registration Fail !";
    }

    $con->close();
}

if (isset($_SESSION['message'])) {
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
        <div class="w-box">
            <h1>Workshop Registration Form</h1>
            <?php
            if(isset($message)){
                echo"<h4>".$message."</h4>";
            }
            ?>
            <form action="workshop.php" method="post">
                <label for="workshop_name">Workshop Name:</label>
                <input type="text" name="workshop_name" id="workshop_name" placeholder="Enter Workshop Name" required><br>
                <label for="date">Date</label>
                <input type="date" name="date" id="date" placeholder="date" required><br>
                <label for="time">Time :</label>
                <input type="time" name="time" id="time" placeholder="Time" required><br>
                <label for="venue">Venue:</label>
                <input type="text" name="venue" id="venue" placeholder="Enter Venue" required><br>
                <label for="seats">Seats Available:</label>
                <input type="number" name="seats" id="seats" placeholder="Enter No . Of seats" required><br>
                <label for="description">Description:</label>
                <input type="text-area" name="description" id="description" placeholder="Enter Description" required><br>
                <button type="submit">Submit</button>
            </form>
        </div>
    </main>
</body>
</html>