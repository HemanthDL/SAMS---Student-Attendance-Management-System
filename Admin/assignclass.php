<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
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
            <form method="post" action="admin.html">
                <tr>
                    <td></td>
                    <td align="left"><input type="submit" name="submit" value="home"></td>
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
        <table border="1" bgcolor="#FFF5EE">
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
</body>

</html>