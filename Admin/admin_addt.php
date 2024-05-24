<html>

<head>
    <title>Teacher</title>
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
        <div class="box">

            <br><br><br><br><br><br>
            <h2>Deatils of Teacher</h2>
            <table>
                <form method="post" action="admin_addt.php">
                    <tr>
                        <td align="left">Teacher ID</td>
                        <td align="left"><input type="text" name="id" required></td>
                    </tr>
                    <tr>
                        <td align="left">Password</td>
                        <td align="left"><input type="text" name="password" required></td>
                    </tr>
                    <tr>
                        <td align="left">Teacher Name</td>
                        <td align="left"><input type="text" name="name" required></td>
                    </tr>
                    <tr>
                        <td align="left">Email</td>
                        <td align="left"><input type="text" name="email" required></td>
                    </tr>
                    <tr>
                        <td align="left">Department</td>
                        <td align="left"><input type="text" name="dept" required></td>
                    </tr>
                    <tr>
                        <td align="left">Degree</td>
                        <td align="left"><input type="text" name="degree" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="left"><input type="submit" value="Add Teacher"></td>
                    </tr>
                </form>
    </center>
    <?php
            include ('../connection.php');
            if(isset($_POST['id'],$_POST['password'],$_POST['name'],$_POST['email'],$_POST['dept'],$_POST['degree'])){
                $id=$_POST['id'];
                $password=$_POST['password'];
                $name=$_POST['name'];
                $email=$_POST['email'];
                $dept=$_POST['dept'];
                $degree=$_POST['degree'];
    
                $sql = "insert into Teacher(id,password,name,email,dept,degree) values ('$id','$password','$name','$email','$dept','$degree')";
    
                if($conn->query($sql) == true){
                    echo "<script type='text/javascript'>alert('TEACHER ADDED SUCCESSFULLY')</script>";
                }
                else{
                    echo "<script type='text/javascript'>alert('ERROR IN ADDING')</script>";
                }
            }
        ?>
    <center>
        <table>
            <form method="post" action="admin_addt.php">
                <tr>
                    <td></td>
                    <td align="right"><input type="submit" name="viewsub" value="View List"></td>
                </tr>
            </form>
        </table>
        <table class="designtable">
            <tr>
                <th>ID</th>
                <th>PASSWORD</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>DEPARTMENT</th>
                <th>DEGREE</th>
            </tr>
            <?php
                if(isset($_POST['viewsub'])){
                    $sq="select * from teacher";
                    $esq=$conn->query($sq);
                    if($esq == true){
                        
                        while($rsq=$esq->fetch_assoc()){
                            echo "<tr><td>".$rsq['id']."</td><td>".$rsq['password']."</td><td>".$rsq['name']."</td>"."<td>".$rsq['email']."</td>"."<td>".$rsq['dept']."</td>"."<td>".$rsq['degree']."</td></tr>";
                        }
                    }
                }
                $conn->close();
            ?>
        </table>
        </div>
    </center>
    <footer class="footer">
        <p>&copy; 2024 Student's Attendance Management System. All rights reserved.</p>
        <p><a href="contact.html">Contact Us</a> | <a href="about.html">About</a></p>
    </footer>
</body>

</html>