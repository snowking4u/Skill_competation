
<?php
session_start();
if(!isset($_SESSION['user_id'])){
   header('Location:login.php');
}
?>
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
            <a href="workshop.php">Register Workshop</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <div class="box">
            <h1>Students Registration Details</h1>
            <h4>Total Number of Students Registered For Workshop</h4>
            <table >
                <tr>
                    <th>Student Name</th>
                    <th>Roll No</th>
                    <th>Branch</th>
                    <th>Semester</th>
                    <th>Email</th>
                    <th>Mobile No.</th>
                    <th>Gender</th>
                    <th>Workshop</th>
                </tr>
                <?php
                $con=mysqli_connect("localhost","root","","database");

                $sql="SELECT * FROM `students`;";
                $result = $con->query($sql);
                while($row = mysqli_fetch_assoc($result)){
                echo"<tr>";
                    echo"<td>".$row['name']."</td>";
                    echo"<td>".$row['rno']."</td>";
                    echo"<td>".$row['branch']."</td>";
                    echo"<td>".$row['semester']."</td>";
                    echo"<td>".$row['email']."</td>";
                    echo"<td>".$row['mobile']."</td>";
                    echo"<td>".$row['gender']."</td>";
                    echo"<td>".$row['workshop']."</td>";
                echo"</tr>";
                }
                ?>
            </table>
        </div>
    </main>
</body>
</html>