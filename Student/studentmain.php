<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="roman">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Main</title>
</head>

<body>
    <h2>
        <center>
            <?php
                include('../connection.php');
                session_start();
                $usn=$_SESSION['usn'];
                $sql="select * from Student where usn='$usn'";
                $exe=$conn->query($sql);
                $row=$exe->fetch_assoc();
                echo "<table tablecellspacing='5' cellpadding='5%'><tr><td>Student USN : ".$usn."</td></tr><tr><td>Student Name : ".$row['name']."</td></tr><tr><td>Semester : ".$row['sem']."</td></tr><tr><td>Section : ".$row['sec']."</td></tr><tr><td>Branch : ".$row['branch']."</td></tr></table>";
                $_SESSION['usn']=$usn;
                $_SESSION['name']=$row['name'];
                $_SESSION['sem']=$row['sem'];
                $_SESSION['sec']=$row['sec'];
                $_SESSION['dept']=$row['branch'];
        ?>
            <br><br><br>
            <table>
                <tr>
                    <th>
                        <a href="studentview.php">VIEW ATTENDANCE</a>
                        <br><br><br>
                    </th>
                </tr>
            </table>
            <br>
            <form method="post" action="../main.html">
                <input type="submit" name="submit" value="HOME">
            </form>
        </center>
    </h2>
</body>

</html>