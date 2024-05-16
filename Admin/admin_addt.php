<html>

<head>
    <title>Teacher</title>
</head>

<body>
    <center>
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
            <form method="post" action="admin.html">
                <tr>
                    <td></td>
                    <td align="left"><input type="submit" name="submit" value="home"></td>
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
        <table border="1" bgcolor="#FFF5EE">
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
    </center>
</body>

</html>