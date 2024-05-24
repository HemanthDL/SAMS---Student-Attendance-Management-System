<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="roman">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Main</title>
    <link rel="stylesheet" type="text/css" href="../Admin/admin.css">
    <style>
        .att-teas{
            position:absolute;
            bottom: 170px;
            right: 650px;
            z-index: 1;
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
        }
        .admin-option{
            margin:25px;
        }
        .info{
            font-size:larger;
            display:flex;
            align-items:center;
            margin-right: auto;
        }
        .info img {
            margin-left:15px;
            margin-right: 50px; 
            max-width: 100px; 
            border-radius:50%;
        }
        h2{
            position: absolute;
            top:125px;
            left:65px;
        }
    </style>
</head>

<body>
<nav class="navbar">
        <ul>
            <li><a href="../main.html">HOME</a></li>
            <li><a href="adminlogin.php">ADMIN</a></li>
            <li><a href="../Teacher/teacherlogin.php">TEACHER</a></li>
            <li><a href="../Student/studentlogin.php">STUDENT</a></li>
        </ul>
    </nav>
    <h2>Student Deatils</h2>
    <div class="container">
        <div class='info'> 
        <?php
                include('../connection.php');
                session_start();
                $usn=$_SESSION['usn'];
                $sql="select * from Student where usn='$usn'";
                $exe=$conn->query($sql);
                $row=$exe->fetch_assoc();
                echo "<img src='https://cdn5.vectorstock.com/i/1000x1000/52/54/male-student-graduation-avatar-profile-vector-12055254.jpg'>";
                echo "<table tablecellspacing='5' cellpadding='5%'><tr><td>Student USN : ".$usn."</td></tr><tr><td>Student Name : ".$row['name']."</td></tr><tr><td>Semester : ".$row['sem']."</td></tr><tr><td>Section : ".$row['sec']."</td></tr><tr><td>Branch : ".$row['branch']."</td></tr></table>";
                $_SESSION['usn']=$usn;
                $_SESSION['name']=$row['name'];
                $_SESSION['sem']=$row['sem'];
                $_SESSION['sec']=$row['sec'];
                $_SESSION['dept']=$row['branch'];
        ?>
        </div>
    </div>

    <div class="att-teas">
            <div class="admin-option">
            <a href="studentview.php"><button>VIEW ATTENDANCE</button></a>
            </div>
    </div>
            <br>
        </center>
    </h2>
    <footer class="footer">
        <p>&copy; 2024 Student's Attendance Management System. All rights reserved.</p>
        <p><a href="contact.html">Contact Us</a> | <a href="about.html">About</a></p>
    </footer>
</body>

</html>