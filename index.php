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
        <nav>    
            <a href="registration.php">Register Yourself</a>
            <a href="login.php">Admin</a>
        </nav>
    </header>
    <mian>
        <div class="container">
            <h3>Student Technical Workshop Registration System</h3>
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
                    <th>Action</th>
                </tr>
                <?php
                    
                        $server = "localhost";
                        $username = "root";
                        $pass = "";
                        $dbname="temp";

                        $con=mysqli_connect($server,$username,$pass,$dbname);

                        $sql = "SELECT * FROM registration;";

                    
                        $result = $con->query($sql);

                        while($row = mysqli_fetch_assoc($result)) {

                            $workshop = $row['workshop_name'];
                            $max_seats = $row['max_seats'];

                            $check = "SELECT * FROM students WHERE workshop='$workshop'";
                            $students = $con->query($check);

                            $registered = $students->num_rows;

                            $available = $max_seats - $registered;

                            echo"<tr>";
                            echo"<td>".$row['workshop_id']."</td>";
                            echo"<td>".$row['workshop_name']."</td>";
                            echo"<td>".$row['workshop_date']."</td>";
                            echo"<td>".$row['workshop_time']."</td>";
                            echo"<td>".$row['venue']."</td>";
                            // echo"<td>".$max_seats."</td>";
                            if($available <= 0){
                                echo"<td>Seats Full</td>";
                            }else{
                                echo"<td>".$available."</td>";
                            }

                            echo"<td>".$row['description']."</td>";
                            if($available <= 0 ){
                                echo"<td><a href='#'>Registration Close</a></td>";
                            }else{

                                echo "<td><a href='registration.php'>Register Yourself</a></td>";
                            }
                            echo"</tr>";
                        }
                        $con->close();
                    
                ?>

            </table>
        </div>
    </mian>
</body>
</html>