<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <form method="post" action="markattendance.php">
            <tr>
                <td align="left">Date</td>
                <td align="left">
                    <input type="date" name="adate" placeholder="yyyy-mm-dd" required>
                </td>
            </tr>
            <!-- <tr><td align="left">Subject ID</td><td align="left"><input type="text" name="subid" required></td></tr>
    <tr><td align="left">Semester</td><td align="left"><input type="text" name="sem" required></td></tr>
    <tr><td align="left">Section</td><td align="left"><input type="text" name="sec" required></td></tr> -->
            <?php
            include('../connection.php');
            session_start();
            $tid=$_SESSION['tid'];
            $dept=$_SESSION['dept'];

            $subsql="select distinct sub_id from assignclass where tid='$tid' and dept='$dept' order by sub_id";
            $exesub=$conn->query($subsql);
            if($exesub == true){
                

                echo "Subject : <select name='sub_id'>";
                while($rsub=$exesub->fetch_assoc()){
                    echo "<option value='".$rsub['sub_id']."'>".$rsub['sub_id']."</option>";
                    $i=$i+1;
                }
                echo "</select><br>";
            }

            $subsql="select distinct sem from assignclass where tid='$tid' and dept='$dept' order by sem";
            $exesub=$conn->query($subsql);
            if($exesub == true){
                

                echo "Semester : <select name='sem'>";
                while($rsub=$exesub->fetch_assoc()){
                    echo "<option value='".$rsub['sem']."'>".$rsub['sem']."</option>";
                    $i=$i+1;
                }
                echo "</select><br>";
            }

            $subsql="select distinct sec from assignclass where tid='$tid' and dept='$dept' order by sec asc";
            $exesub=$conn->query($subsql);
            if($exesub == true){
                

                echo "Section : <select name='sec'>";
                while($rsub=$exesub->fetch_assoc()){
                    echo "<option value='".$rsub['sec']."'>".$rsub['sec']."</option>";
                    $i=$i+1;
                }
                echo "</select><br>";
            }
        ?>
            <br><br>
            <br>
            <br>
            <tr>
                <td></td>
                <td align="left"><input type="submit" name="submit" value="Submit"></td>
            </tr>
        </form>
        <?php
            if(isset($_POST['submit'])){
                $subid = $_POST['sub_id'];
                $sec = $_POST['sec'];
                $sem = $_POST['sem'];
                $entered = $_POST['adate'];
                $check = "select distinct adate from attendance where sem='$sem' and sec='$sec' and sub_id='$subid' and tid='$tid' order by adate asc";
                $checkexe = $conn->query($check);
                echo "details: ".$subid."\t".$sec."\t".$sem."\t".$entered."\t".$tid."\t";
                while($r = $checkexe->fetch_assoc()){
                    echo "date : ".$r['adate']."\t";
                    $db_date = strtotime($r['adate']); 
                    $entered_date = strtotime($entered);
                    echo "timestamp: ".$db_date."\tenr: ".$entered_date."\t";
                    if($db_date == $entered_date){
                        echo "<script type='text/javascript'>alert('Attendance Limit for the day is reached!!\nEnter New Date')</script>";
                    }
                }
            }
        ?>
        <tr></tr>
        <tr></tr>
        <form method="post" action="teachermain.php">
            <tr>
                <td></td>
                <td align="left"><input type="submit" name="submit" value="return to main page"></td>
            </tr>
        </form>
    </table>
    <br><br>
    <center>
        <form method='post' action='markattendance1.php'>
            <table border='1' bgcolor='#FFF5EE'>
                <tr>
                    <th>USN</th>
                    <th>Student Name</th>
                    <th>Present</th>
                    <th>Absent</th>
                </tr>
                <?php
            
            if(isset($_POST['submit'])){
                $adate=$_POST['adate'];
                $subid=$_POST['sub_id'];
                $sem=$_POST['sem'];
                $sec=$_POST['sec'];
                $tid=$_SESSION['tid'];
                $dept=$_SESSION['dept'];
                $_SESSION['adate']=$adate;
                $_SESSION['sub_id']=$subid;
                $_SESSION['sem']=$sem;
                $_SESSION['sec']=$sec;
                $_SESSION['tid']=$tid;
                $_SESSION['dept']=$dept;
                // $tid=$_POST['tid'];
                // $dept=$_POST['dept'];
                //echo $dept;

                $msql="select tid from assignclass where sub_id='$subid' and sem=$sem and sec='$sec' and dept='$dept'";
                $exemsql=$conn->query($msql);
                
                $r=$exemsql->fetch_assoc();
                if($r['tid'] == $tid){
                    

                    $usnsql="select usn,name from Student where sem=$sem and sec='$sec' and branch='$dept' order by name asc";
                    $exeusn=$conn->query($usnsql);
                    $n=mysqli_num_rows($exeusn);
                    while($rusn=$exeusn->fetch_assoc()){
                        $au=$rusn['usn'];
                        $an=$rusn['name'];

                        echo "<tr><td>".$au."</td><td>".$an."</td><td>
                    <label for='present'></label>
                    <input type='radio' name='attendance[$au]' value='present' checked>
                </td><td>
                    <label for='absent'></label>
                    <input type='radio' name='attendance[$au]' value='absent'>
                </td></tr>";
                
                    }
                    // echo "</table></center></h2>
                    // <input type='submit' name='submit_attendance' value='Submit'></form>"; // Submit button
                        
                        
                        // if($exeinsql == true){
                        //     //echo "<script type='text/javascript'>alert('This teacher has no access to this class')</script>";
                        //     // header('Location:teachermain.php');
                        //     // exit();
                        // }
                        // else{
                        //     echo "<script type='text/javascript'>alert('Error in taking Attendance')</script>";
                        // }
                    
                   
                    
                }
                else{
                    echo "<script type='text/javascript'>alert('This teacher has no access to this class')</script>";
                }
            }
                
    ?>
            </table>
            <!-- Move the submit button inside the form -->
            <input type='submit' name='submit_attendance' value='Submit'>
        </form>
    </center>
</body>

</html>