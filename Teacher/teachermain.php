<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../Admin/admin.css">
    <style>
        .att-teas{
            position:absolute;
            bottom: 192px;
            right: 550px;
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
            top:175px;
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
    <h2>Teacher Deatils</h2>
    <div class="container">
        <div class='info'> 
                <?php
                    include('../connection.php');
                    //include('teacherlogin.php');
                    session_start();
                    $tid=$_SESSION['tid'];
                    $sql="select * from Teacher where id='$tid'";
                    $res=$conn->query($sql);
                    $r=$res->fetch_assoc();
                    echo "<img src='https://thumbs.dreamstime.com/b/teacher-icon-flat-style-illustration-web-125576005.jpg' alt='Teacher Image'>"; // Add your image source here
                    echo "<div>";
                    echo "Name : ".$r['name']."<br>";
                    echo "Department : ".$r['dept']."<br>";
                    echo "Degree : ".$r['degree'];
                    echo "</div>";
                ?>
        </div>
    </div>
    <div class="att-teas">
            <div class="admin-option">
                <?php
                        $url="markattendance.php";
                        $_SESSION['tid']=$tid;
                        $_SESSION['dept']=$r['dept'];
                        echo "<a href='$url'>
                        <button>MARK ATTENDANCE</button></a>";
                ?>
            </div>
            <div class="admin-option">
                <a href="viewattendance1.php"><button>VIEW ATTENDANCE</button></a>
            </div>
    </div>
    
    <footer class="footer">
        <p>&copy; 2024 Student's Attendance Management System. All rights reserved.</p>
        <p><a href="contact.html">Contact Us</a> | <a href="about.html">About</a></p>
    </footer>
</body>

</html>