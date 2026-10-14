<?php
            $con = mysqli_connect("localhost","root","","database");

            $sql = "SELECT * FROM workshop;";

            $result = $con->query($sql);
            while($row = mysqli_fetch_assoc($result)){
                $workshop=$row['workshop_name'];
                $max_seats = $row['max_seats'];

                $check = "SELECT * FROM students WHERE workshop='$workshop';";
                $students = $con->query($check);

                $registered = $students->num_rows;
                $available = $max_seats - $registered;

                echo"<div class='cbox'>";
                    echo"<h1>".$row['workshop_name']."</h1><br>";
                    echo"<p>".$row['description']."</p><br>";
                    echo"<p>Venue: ".$row['venue']."</p><br>";
                    echo"<p>Date:<strong>".$row['date']."</strong> Time: <strong>".$row['time']."</strong></p>";
                        if($available <= 0){
                            echo"<h4>Seats Available:Seat Full</h4>";
                        }else{
                            echo"<h4>Seats Available:".$available."</h4>";
                        }
                        if($available <= 0){
                            echo"<a class='btn close-btn disable' >Register Close</a>";
                        }else{
                            echo"<a href='register.html'>Register Now</a>";
                        }
                    
                echo'</div>';
        }
        ?>

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

                while($row=mysqli_fetch_assoc($result)){
                    echo"<tr>";
                    echo"<td>".$row['sno']."</td>";
                    echo"<td>".$row['name']."</td>";
                    echo"<td>".$row['emial']."</td>";
                    echo"<td>".$row['gender']."</td>";
                    echo "<td><a href='index.php?delet=".$row['sno']."'>Delete</td>";
                    echo"</tr>";

                }    

                <?php
                if(isset($_GET['delet'])){
                    $server = "localhost";
                    $username = "root";
                    $pass = "";
                    $dbname = "temp";

                    $con = mysqli_connect($server,$username,$pass,$dbname);

                    $s_no=$_GET['delet'];

                    $sql = "DELETE FROM newdata WHERE sno = $s_no";

                    if($con->query($sql)){
                        header("Location:index.php");
                        exit();
                    }
                    $con->close();
                }
                ?>
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
