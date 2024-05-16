<html>
    <head>
        <title>Admin login page</title>
    </head>
<body>
    <form method="post" action="adminlogin.php">
        <br><br><br><br><br><br><br><br>
        <center><h2>LOGIN</h2></center>
    <h1><center>
        <table>
            <tr>
                <td align="left">Username : </td>
                <td><input type="text" name="username" required>
            </tr>
            <tr>
                <td align="left">Password : </td>
                <td><input type="password" name="password" required>
            </tr>
        </table>
        <br>
        <input type="submit" value="Login">
    </center></h1>
</form>

<?php
    include ('../connection.php');
    if(isset($_POST['username'],$_POST['password'])){
        $user=$_POST['username'];
        $password=$_POST['password'];

        $sql="select * from admin where username='$user' and password='$password'";
        $res=$conn->query($sql);
        if($res->num_rows >0){
                echo "Logged In!";
                header('Location:admin.html');
                exit(); 
        }
        else{
            echo "<script type='text/javascript'>alert('Invalid Username or Password')</script>";
            // header("Location:adminlogin.php?error:Invalid username or password");
            // exit();
            
        }
    }

    $conn->close();

?>
</body>
</html>
        