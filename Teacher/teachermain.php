<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2><center>
    <?php
        include('../connection.php');
        //include('teacherlogin.php');
        session_start();
        $tid=$_SESSION['tid'];
        $sql="select * from Teacher where id='$tid'";
        $res=$conn->query($sql);
        $r=$res->fetch_assoc();
        echo "Name : ".$r['name']."<br>Department : ".$r['dept']."<br>Degree : ".$r['degree']."<br>";
        
    ?>
    <center></h2>
    <br><br><br><br><br><br><br><br>
    <h2><center>
        <table>
            <tr>
                <th>
                    <!-- <a href="markattendance.php?tid='$tid'&dept='$r['dept']'">TAKE ATTENDANCE</a> -->
                    <?php
                            $url="markattendance.php";
                            $_SESSION['tid']=$tid;
                            $_SESSION['dept']=$r['dept'];
                            echo "<a href='$url'>MARK ATTENDANCE</a>";
                    ?>
                    <br><br><br>
                </th>
            </tr>
            <tr>
                <th>
                    <a href="viewattendance1.php">VIEW ATTENDANCE</a>
                    <br><br><br>
                </th>
            </tr>
            <tr>
                <th>
                    <a href="../main.html">
		                <input type="button" value="HOME">
	                </a>
                </th>
            </tr>
        </table>
</center></h2>
</body>
</html>