<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="attendence.css">
</head>

<body>

    <form action="viewattendance1.php" method="post">
        <?php
            include('../connection.php');
            session_start();
            $tid=$_SESSION['tid'];
            $dept=$_SESSION['dept'];

            $subsql="select distinct sub_id from assignclass where tid='$tid' and dept='$dept' order by sub_id";
            $exesub=$conn->query($subsql);
            if($exesub == true){
                

                echo "Subject : <select name='subject'>";
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
        <input type="submit" name="submit" value="Submit">
    </form>
    <br>
    <br>
    <form method="post" action="teachermain.php">
        <tr>
            <td></td>
            <td align="left"><input type="submit" name="submit" value="return to main page"></td>
        </tr>
    </form><br><br>
    <center>

        <table class="designtable" border="1" bgcolor="#FFF5EE">
            <tr>
                <th>Roll No.</th>
                <th>USN</th>
                <th>Name</th>
                <?php
            if(isset($_POST['submit'])){
                $subid=$_POST['subject'];
                $sem=$_POST['sem'];
                $sec=$_POST['sec'];
    
                    $datesql="select distinct adate from attendance where sem='$sem' and sec='$sec' and sub_id='$subid' and tid='$tid' order by adate asc";
                    $usnsql="select usn , name from Student where sem='$sem' and sec='$sec' and branch='$dept' order by name asc";
                    $exedate=$conn->query($datesql);
                    $exeusn=$conn->query($usnsql);
                    $count=0;
                    while($rowdate=$exedate->fetch_assoc()){
                        echo "<th>".$rowdate['adate']."</th>";
                        $count=$count+1;
                    }
                    echo "<th>PERCENTAGE</th>";
                    $c=1;
                    while($rowusn=$exeusn->fetch_assoc()){
                        echo "<tr>";
                        $ausn=$rowusn['usn'];
                        $aname=$rowusn['name'];
                        echo "<td>".$c."</td><td>".$ausn."</td><td>".$aname."</td>";
                        $datesql="select distinct adate from attendance where sem='$sem' and sec='$sec' and sub_id='$subid' and tid='$tid' order by adate";
                        $exedate=$conn->query($datesql);
                        $i=0;
                        $c=$c+1;
                        while($rowadate=$exedate->fetch_assoc()){
                            $ad=$rowadate['adate'];
                            $insql="select astatus from attendance where adate='$ad' and usn='$ausn' and adate='$ad' and sem='$sem' and sec='$sec' and sub_id='$subid' and tid='$tid'";
                            
                            $exeinsql=$conn->query($insql);
                            // if($per == 0 || $t != $count){
                                
                            // 	if($i<($count-$t)){
                            // 		echo "<td>None</td>";
                            // 		$i=$i+1;
                            // 	}
                                
                            //
                            while($rowinsql=$exeinsql->fetch_assoc()){
                                echo "<td>".$rowinsql['astatus']."</td>";
                            }
                        }	
                        $p="select count(astatus) from attendance where usn='$ausn' and astatus='present' and sem='$sem' and sec='$sec' and sub_id='$subid' and tid='$tid'";
                            $a="select count(astatus) from attendance where usn='$ausn' and astatus='absent'  and sem='$sem' and sec='$sec' and sub_id='$subid' and tid='$tid'";
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
                        
                    
                    
                }
        ?>
        </table>
    </center>
</body>

</html>