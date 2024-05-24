<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="roman">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Main</title>
    <link rel="stylesheet" href="../Teacher/attendence.css">
</head>

<body>
    <h2>
        <center>
            <?php
                include('../connection.php');
                session_start();
                $usn=$_SESSION['usn'];
                $name=$_SESSION['name'];
                
                $sem=$_SESSION['sem'];
                
                $sec=$_SESSION['sec'];
                
                $dept=$_SESSION['dept'];
                
                echo "<table tablecellspacing='5' cellpadding='5%'><tr><td>Student USN : ".$usn."</td></tr><tr><td>Student Name : ".$name."</td></tr><tr><td>Semester : ".$sem."</td></tr><tr><td>Section : ".$sec."</td></tr><tr><td>Branch : ".$dept."</td></tr></table>";

                
             
                
        ?>
        </center>
    </h2>
    <br><br><br>
    <?php
            echo "<h3><center>Attendance Available for the following Courses Only : <br><br>";
            $avl="select sub_id,sub_name from Subject where sub_id in (select distinct sub_id from Attendance where usn='$usn')";
            $exeavl=$conn->query($avl);
            
            while($ravl=$exeavl->fetch_assoc()){
                echo "<center>".$ravl['sub_name']." ( ".$ravl['sub_id']." )</center>";
            }
            echo "</center></h3>";
        ?>
    <br><br>
    <center>
        <h3>Enter Subject ID to View Attendance</h3><br><br>
        <form method="post" action="studentview.php">
            Subject ID : <input type="text" name="subbid" required>
            <input type="submit" name="submit" value="Submit">

        </form>
        <br>
        <form method="post" action="studentmain.php"><input type="submit" name="submit" value="return to main page">
        </form>
        <br><br>
        <table class="designtable" border="1" bgcolor="#FFF5EE">
            <tr>
                <th>Roll No.</th>
                <th>USN</th>
                <th>Name</th>
                <?php
                if(isset($_POST['submit'])){
                    $subbid=$_POST['subbid'];
                    $check="select sub_id from Attendance where usn='$usn'";
                    $execheck=$conn->query($check);
                    
                    $flag=0;
                    while($rch=$execheck->fetch_assoc()){
                        if($rch['sub_id'] == $subbid){
                            $flag=1;
                        }
                    }
                    if($flag == 1){
                        $datesql="select distinct adate from attendance where sem='$sem' and sec='$sec' and sub_id='$subbid' and usn='$usn' order by adate asc";
                        $exedate=$conn->query($datesql);
                        
                        $count=0;
                        while($rowdate=$exedate->fetch_assoc()){
                            echo "<th>".$rowdate['adate']."</th>";
                            $count=$count+1;
                        }
                        echo "<th>PERCENTAGE</th>";
                        $c=1;
                            echo "<tr>";
                            echo "<td>".$c."</td><td>".$usn."</td><td>".$name."</td>";
                            $datesql="select distinct adate from attendance where sem='$sem' and sec='$sec' and sub_id='$subbid' and usn='$usn'";
                            $exedate=$conn->query($datesql);
                            $i=0;
                        
                            while($rowadate=$exedate->fetch_assoc()){
                                $ad=$rowadate['adate'];
                                $insql="select astatus from attendance where usn='$usn' and adate='$ad' and sem='$sem' and sec='$sec' and sub_id='$subbid'";
                               
                                $exeinsql=$conn->query($insql);
                                
                                while($rowinsql=$exeinsql->fetch_assoc()){
                                    echo "<td>".$rowinsql['astatus']."</td>";
                                }
                            }
                                
                                $p="select count(astatus) from attendance where usn='$usn' and astatus='present' and sem='$sem' and sec='$sec' and sub_id='$subbid'";
                                $a="select count(astatus) from attendance where usn='$usn' and astatus='absent'  and sem='$sem' and sec='$sec' and sub_id='$subbid'";
                                $ep=$conn->query($p);
                                $ea=$conn->query($a);
                                $epr=$ep->fetch_assoc();
                                $ear=$ea->fetch_assoc();
                                
                                $t = $epr['count(astatus)'] + $ear['count(astatus)'];
                                if($t != 0 )
                                    $per = ($epr['count(astatus)']/$t)*100;
                                else
                                    $per=0;
                            echo "<td>".$per."</td>";
                            echo "</tr>";
                        }
                    else{
                        echo "<script type='text/javascript'>alert('Invalid Subject Id')</script>";
                    }
                    }
                    

        ?>
        </table>
    </center>
</body>

</html>