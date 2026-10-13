<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home Page</title>
</head>
<body>
    <header>
        <h1>MyWebsite</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="registration.php">Register Yourself</a>
            <a href="login.php">Admin</a>
        </nav>
    </header>
    <main>
        <div class="box">
            <h1>Workshops for Registration</h1>
            <h4>You Can Register For Workshop From Here !!</h4>
            <table>
                <tr>
                    <th>Workshop id </th>
                    <th>Workshop Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Venue</th>
                    <th>Seats Available</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                <?php
                $con = mysqli_connect("localhost","root","","database");

                $sql = "SELECT * FROM `workshop`; ";
                $result = $con->query($sql);
                while($row = mysqli_fetch_assoc($result)){
                    $workshop=$row['workshop_name'];
                    $max_seats = $row['max_seats'];

                    $check = "SELECT * FROM `students` WHERE `workshop`='$workshop';";
                    $students = $con->query($check);
                    $registered = $students->num_rows;
                    $available = $max_seats - $registered;
                
                echo"<tr>";
                    echo"<td>".$row['sno']."</td>";
                    echo"<td>".$row['workshop_name']."</td>";
                    echo"<td>".$row['date']."</td>";
                    echo"<td>".$row['time']."</td>";
                    echo"<td>".$row['venue']."</td>";
                    if($available <= 0 ){
                        echo"<td> SEAT FULL</td>";
                    }else{
                        echo"<td>".$available."</td>";
                    }
                    echo"<td>".$row['description']."</td>";
                    if($available <= 0 ){
                        echo "<td><button class='btn close-btn' disabled>Registration Closed</button></td>";
                    }else{
                        echo "<td><a href='registration.php' class='btn register-btn'>Register Now</a></td>";
                }
                echo"</tr>";
                }
                ?>
            </table>
        </div>
    </main>
</body>
</html>