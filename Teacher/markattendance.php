<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../Admin/admin.css">
    <link rel="stylesheet" href="attendence.css">
    <style>
    </style>
</head>

<body>
<nav class="navbar">
        <ul>
            <li><a href="teachermain.php">HOME</a></li>
            <li><a href="adminlogin.php">ADMIN</a></li>
            <li><a href="../Teacher/teacherlogin.php">TEACHER</a></li>
            <li><a href="../Student/studentlogin.php">STUDENT</a></li>
        </ul>
    </nav>
    <div class="container">
        <div class="info">
            <h2>Mark Attendance</h2><br>
        <table>
        <form method="post" action="markattendance.php">
            <tr>
                <td align="left">Date</td>
                <td align="left">
                    <input type="date" name="adate" placeholder="yyyy-mm-dd" required>
                </td>
            </tr>
            <?php
            include('../connection.php');
            session_start();
            $tid=$_SESSION['tid'];
            $dept=$_SESSION['dept'];

            $subsql="select distinct sub_id from assignclass where tid='$tid' and dept='$dept' order by sub_id";
            $exesub=$conn->query($subsql);
            if($exesub == true){
                $i=0;
                echo "<tr><td>Subject :</td><td> <select name='sub_id'>";
                while($rsub=$exesub->fetch_assoc()){
                    echo "<option value='".$rsub['sub_id']."'>".$rsub['sub_id']."</option>";
                    $i=$i+1;
                }
                echo "</select></td></tr>";
            }

            $subsql="select distinct sem from assignclass where tid='$tid' and dept='$dept' order by sem";
            $exesub=$conn->query($subsql);
            if($exesub == true){
                

                echo "<tr><td>Semester : </td><td><select name='sem'>";
                while($rsub=$exesub->fetch_assoc()){
                    echo "<option value='".$rsub['sem']."'>".$rsub['sem']."</option>";
                    $i=$i+1;
                }
                echo "</select></td></tr>";
            }

            $subsql="select distinct sec from assignclass where tid='$tid' and dept='$dept' order by sec asc";
            $exesub=$conn->query($subsql);
            if($exesub == true){
                

                echo "<tr><td>Section : </td><td><select name='sec'>";
                while($rsub=$exesub->fetch_assoc()){
                    echo "<option value='".$rsub['sec']."'>".$rsub['sec']."</option>";
                    $i=$i+1;
                }
                echo "</select></td></tr>";
            }
        ?>
            <tr>
                <td></td>
                <td align="left"><input type="submit" name="submit" value="Submit"></td>
            </tr>
        </form>
        <?php
            include('../connection.php');
            $tid = $_SESSION['tid'];
            $dept = $_SESSION['dept'];
            $errorMessage = '';

            if (isset($_POST['submit'])) {
                $subid = $_POST['sub_id'];
                $sec = $_POST['sec'];
                $sem = $_POST['sem'];
                $entered = $_POST['adate'];
                $check = "SELECT DISTINCT adate FROM attendance WHERE sem='$sem' AND sec='$sec' AND sub_id='$subid' AND tid='$tid' ORDER BY adate ASC";
                $checkexe = $conn->query($check);

                while ($r = $checkexe->fetch_assoc()) {
                    $db_date = strtotime($r['adate']);
                    $entered_date = strtotime($entered);

                    if ($db_date == $entered_date) {
                        $errorMessage = 'Attendance Limit for the day is reached! Enter a New Date';
                        break;
                    }
                }
            }
        ?>

        <?php if ($errorMessage): ?>
        <script type="text/javascript">
        alert('<?php echo $errorMessage; ?>');
        window.location.href = 'teachermain.php'
        </script>
        <?php endif; ?>


        <tr></tr>
        <tr></tr>
    </table>
        </div>
    </div>
    <br><br>
    <center>
        <form method='post' action='markattendance1.php'>
            <table class="designtable">
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
    <footer class="footer">
        <p>&copy; 2024 Student's Attendance Management System. All rights reserved.</p>
        <p><a href="contact.html">Contact Us</a> | <a href="about.html">About</a></p>
    </footer>
</body>

</html>