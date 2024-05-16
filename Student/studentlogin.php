<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="roman">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEACHER Login</title>
</head>

<body>
    <form method="post" action="studentlogin.php">
        <br><br><br><br><br><br><br><br>
        <h1>
            <center>
                <table>
                    <tr>
                        <td align="left">Student USN : </td>
                        <td><input type="text" name="usn" required>
                    </tr>
                </table>
                <br>
                <input type="submit" name="submit" value="Login">
            </center>
        </h1>
    </form>

    <?php
    include ('../connection.php');
    if(isset($_POST['submit'])){
        $usn=$_POST['usn'];
        
        

        $sql="select usn from Student where usn='$usn'";
        $res=$conn->query($sql);
        if($res->num_rows >0){
            session_start();
            $_SESSION['usn']=$usn;
                echo "Logged In!";
                
                header('Location:studentmain.php');
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