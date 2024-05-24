<html>

<head>
    <title>Subject</title>
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
        <h2>Deatils of Subject</h2>
        <table>
            <form method="post" action="admin_addsub.php">
                <tr>
                    <td align="left">SUBJECT ID :</td>
                    <td align="left"> <input type="text" name="subid" required></td>
                </tr>
                <tr>
                    <td align="left">SUBJECT NAME : </td>
                    <td align="left"><input type="text" name="subname" required></td>
                </tr>
                <tr>
                    <td align="left">DEPARTMENT : </td>
                    <td align="left"><input type="text" name="sdept" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="left"><input type="submit" value="Add Subject"></td>
                </tr>
            </form>
            <br><br>
    </center>

    <?php
       include ('../connection.php');
        if (isset($_POST['subid'],$_POST['subname'],$_POST['sdept'])){
            $subid=$_POST['subid'];
            $subname=$_POST['subname'];
            $sdept=$_POST['sdept'];

            $sql = "insert into Subject(sub_id,sub_name,dept) values ('$subid','$subname','$sdept')";
            //echo $sql;
            if($conn->query($sql) == true){
                echo "<script type='text/javascript'>alert('Subject added succesfully')</script>";

            }
            else{
                echo "<script type='text/javascript'>alert('Error in adding ')</script>";
            }
        }
    ?>

    <center>
        <table>
            <form method="post" action="admin_addsub.php">
                <tr>
                    <td></td>
                    <td align="right"><input type="submit" name="viewsub" value="View Subjects"></td>
                </tr>
            </form>
        </table>
        <table class="designtable">
            <tr>
                <th>Subject ID</th>
                <th>Subject Nmae</th>
                <th>Department</th>
            </tr>
            <?php
            if(isset($_POST['viewsub'])){
                $sq="select * from subject";
                $esq=$conn->query($sq);
                if($esq == true){
                    
                    while($rsq=$esq->fetch_assoc()){
                        echo "<tr><td>".$rsq['sub_id']."</td><td>".$rsq['sub_name']."</td><td>".$rsq['dept']."</td></tr>";
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