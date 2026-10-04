<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ILSC</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Collage Workshop Program</h1>
        <a href="login.php"><button type="button">Admin</button></a>
    </header>
    <mian>
        <h3>Student Technical Workshop Registration System</h3>
        <div class="container">
            <h3>Govt. Polytechnical HMR</h3>
            <table>
                <tr>
                    <th>Workshop sno.</th>
                    <th>Workshop Name</th>
                    <th>Date</th>
                    <th>Workshop time</th>
                    <th>Workshop venue</th>
                    <th>Max Seats</th>
                    <th>Description</th>
                </tr>
                <?php
                    
                        $server = "localhost";
                        $username = "root";
                        $pass = "";
                        $dbname="temp";

                        $con=mysqli_connect($server,$username,$pass,$dbname);

                        $sql = "SELECT * FROM registration;";

                        $result = $con->query($sql);

                        while($row = mysqli_fetch_assoc($result)){
                            echo"<tr>";
                            echo"<td>".$row['workshop_id']."</td>";
                            echo"<td>".$row['workshop_name']."</td>";
                            echo"<td>".$row['workshop_date']."</td>";
                            echo"<td>".$row['workshop_time']."</td>";
                            echo"<td>".$row['venue']."</td>";
                            echo"<td>".$row['max_seats']."</td>";
                            echo"<td>".$row['description']."</td>";
                            echo "<td><a href='registration.php'>Register Yourself</td>";
                            echo"</tr>";
                        }
                    
                ?>

            </table>
        </div>
    </mian>
</body>
</html>