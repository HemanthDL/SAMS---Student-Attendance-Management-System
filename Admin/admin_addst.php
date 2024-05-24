<html>

<head>
    <title>Student</title>
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
    <center>
        <br><br><br><br><br><br>
        <h2>Deatils of Student</h2>
        <table>
            <form method="post" action="admin_addst.php">
                <tr>
                    <td align="left">USN</td>
                    <td align="left"><input type="text" name="usn" required></td>
                </tr>
                <tr>
                    <td align="left">Student Name</td>
                    <td align="left"><input type="text" name="name" required></td>
                </tr>
                <tr>
                    <td align="left">Email</td>
                    <td align="left"><input type="text" name="email" required></td>
                </tr>
                <tr>
                    <td align="left">Branch</td>
                    <td align="left"><input type="text" name="branch" required></td>
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
                    <td></td>
                    <td align="left"><input type="submit" value="Add Student"></td>
                </tr>
            </form>
        </table>
    </center>
    <?php
        include ('../connection.php');
        if(isset($_POST['usn'],$_POST['name'],$_POST['email'],$_POST['branch'],$_POST['sem'],$_POST['sec'])){
            $usn=$_POST['usn'];
            $name=$_POST['name'];
            $email=$_POST['email'];
            $branch=$_POST['branch'];
            $sem=$_POST['sem'];
            $sec=$_POST['sec'];

            $sql = "insert into Student(usn,name,email,branch,sem,sec) values ('$usn','$name','$email','$branch','$sem','$sec')";

            if($conn->query($sql) == true){
                echo "<script type='text/javascript'>alert('STUDENT ADDED SUCCESSFULLY')</script>";
            }
            else{
                echo "<script type='text/javascript'>alert('ERROR IN ADDING')</script>";
            }
        }
    ?>
    <center>
        <table>
            <form method="post" action="admin_addst.php">
                <tr>
                    <td></td>
                    <td align="right"><input type="submit" name="viewsub" value="View List"></td>
                </tr>
            </form>
        </table>
        <table class="designtable">
            <tr>
                <th>USN</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>BRANCH</th>
                <th>SEMESTER</th>
                <th>SECTION</th>
            </tr>
            <?php
            if(isset($_POST['viewsub'])){
                $sq="select * from student";
                $esq=$conn->query($sq);
                if($esq == true){
                    
                    while($rsq=$esq->fetch_assoc()){
                        echo "<tr><td>".$rsq['usn']."</td><td>".$rsq['name']."</td>"."<td>".$rsq['email']."</td>"."<td>".$rsq['branch']."</td>"."<td>".$rsq['sem']."</td><td>".$rsq['sec']."</td><tr>";
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