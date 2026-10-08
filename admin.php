<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Collage Workshop Program</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="workshop.php">Register Workshop</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <?php

        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }
        ?>
        <div class="overview">
        <table>
            <tr>
                <th>Workshop</th>
                <th>Registered</th>
            </tr>

            <?php

            $con=mysqli_connect("localhost","root","","temp");
            $sql = "SELECT workshop, COUNT(*) AS total
            FROM students
            GROUP BY workshop";

            $result = $con->query($sql);
            $grand_total = 0;

            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['workshop']."</td>";
                echo "<td>".$row['total']."</td>";
                echo "</tr>";

                $grand_total += $row['total'];
            }
            ?>

            <tr>
                <th>Total</th>
                <th><?php echo $grand_total; ?></th>
            </tr>
        </table>
</div>
        <div class="container">
            <?php
            echo "<h3>Welcome " . $_SESSION['user_name']."</h3>";
            ?>
            <h3>Registered Students Details</h3>
            <table>
                <tr>
                    <th>Registered id</th>
                    <th>Name</th>
                    <th>Roll No</th>
                    <th>Branch</th>
                    <th>Semester</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>Workshop JOIN</th>
                    <th>Action</th>
                </tr>
                <?php
                    $con=mysqli_connect("localhost","root","","temp");

                    $sql = "SELECT * FROM students;";

                    $result = $con->query($sql);

                    while($row = mysqli_fetch_assoc($result)){
                        echo"<tr>";
                        echo"<td>".$row['sno']."</td>";
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