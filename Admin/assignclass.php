<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" type="text/css" href="../Teacher/attendence.css">
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
    <div class="container">
        <main class="main-content">
            <div class="admin-options">
                <div class="admin-option">
                    <a href="admin_addsub.php">
                        <button>ADD SUBJECT</button>
                    </a>
                </div>
                <div class="admin-option">
                    <a href="admin_addt.php">
                        <button>ADD TEACHER</button>
                    </a>
                </div>
                <div class="admin-option">
                    <a href="admin_addst.php">
                        <button>ADD STUDENT</button>
                    </a>
                </div>
                <div class="admin-option">
                    <a href="assignclass.php">
                        <button>ASSIGN CLASS</button>
                    </a>
                </div>
            </div>
        </main>
    </div>
    <center><br><br><br><br><br>
        <table>
            <form method="post" action="assignclass.php">
                <tr>
                    <td align="left">Teacher ID</td>
                    <td align="left"><input type="text" name="tid" required></td>
                </tr>
                <tr>
                    <td align="left">Subject ID</td>
                    <td align="left"><input type="text" name="subid" required></td>
                </tr>
                <tr>
                    <td align="left">Semester</td>
                    <td align="left"><input type="text" name="sem" required></td>
                </tr>
                <tr>
                    <td align="left">Section</td>
                    <td align="left"><input type="text" name="sec" required></td>
                </tr>
                <tr>
                    <td align="left">Department</td>
                    <td align="left"><input type="text" name="dept" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="left"><input type="submit" name="submit" value="Assign Class"></td>
                </tr>
            </form>
        </table>
    </center>
    <?php
        include ('../connection.php');
        if(isset($_POST['submit'])){
            $tid=$_POST['tid'];
            $subid=$_POST['subid'];
            $sem=$_POST['sem'];
            $sec=$_POST['sec'];
            $dept=$_POST['dept'];

            $sql="insert into assignclass(tid,sub_id,sem,sec,dept) values ('$tid','$subid','$sem','$sec','$dept')";
            if($conn->query($sql) == true){
                echo "<script type='text/javascript'>alert('CLASS ASSIGNED SUCCESFULLY')</script>";
            }
            else{
                echo "<script type='text/javascript'>alert('ERROR IN ADDING')</script>";
            }
        }
    ?>
    <center>
        <table>
            <form method="post" action="assignclass.php">
                <tr>
                    <td></td>
                    <td align="right"><input type="submit" name="viewsub" value="View List"></td>
                </tr>
            </form>
        </table>
        <table class="designtable">
            <tr>
                <th>TEACHER ID</th>
                <th>SUBJECT ID</th>
                <th>SEMESTER</th>
                <th>SECTION</th>
                <th>DEPARTMENT</th>
            </tr>
            <?php
            if(isset($_POST['viewsub'])){
                $sq="select * from assignclass";
                $esq=$conn->query($sq);
                if($esq == true){
                    
                    while($rsq=$esq->fetch_assoc()){
                        echo "<tr><td>".$rsq['tid']."</td><td>".$rsq['sub_id']."</td>"."<td>".$rsq['sem']."</td><td>".$rsq['sec']."</td><td>".$rsq['dept']."</td><tr>";
                    }
                }
            }
            $conn->close();
        ?>
        </table>
    </center>
    <footer class="footer">
        <p>&copy; 2024 Student's Attendance Management System. All rights reserved.</p>
        <p><a href="contact.html">Contact Us</a> | <a href="about.html">About</a></p>
    </footer>
</body>

</html>