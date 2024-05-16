<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="roman">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TEACHER Login</title>
</head>
<body>
    <form method="post" action="teacherlogin.php">
        <br><br><br><br><br><br><br><br>
    <h1><center>
        <table>
            <tr>
                <td align="left">Teacher ID : </td>
                <td><input type="text" name="tid" required>
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
    if(isset($_POST['tid'],$_POST['password'])){
        $tid=$_POST['tid'];
        $password=$_POST['password'];
        session_start();
        $_SESSION['tid']=$tid;

        $sql="select id , password from Teacher where id='$tid' and password='$password'";
        $res=$conn->query($sql);
        if($res->num_rows >0){
                echo "Logged In!";
                
                header('Location:teachermain.php');
                exit(); 
        }
        else{
            echo "<script type='text/javascript'>alert('Invalid Username or Password')</script>";
            // header("Location:adminlogin.php?error:Invalid tid or password");
            // exit();
            
        }
    }

    

?>
</body>
</html>
        