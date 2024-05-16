<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <form method="post" action="viewattendance.php">
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
            <!-- Teacher ID : <input type="text" name="tid" required><br><br>
        Department : <input type="text" name="dept" required><br><br> -->
            <tr>
                <td></td>
                <td align="left"><input type="submit" name="submit" value="Submit"></td>
            </tr>
        </form>
        <tr></tr>
        <tr></tr>
        <form method="post" action="teachermain.php">
            <tr>
                <td></td>
                <td align="left"><input type="submit" name="submit" value="return to main page"></td>
            </tr>
        </form>
    </table>
    <br><br><br>
    <center>

        <table border="1" bgcolor="#FFF5EE">
            <tr>
                <th>Roll No.</th>
                <th>USN</th>
                <th>Name</th>
                <?php
		include('../connection.php');
		session_start();
		$tid=$_SESSION['tid'];
		$dept=$_SESSION['dept'];

		if(isset($_POST['subid'],$_POST['sem'],$_POST['sec'],$_POST['submit'])){
			$subid=$_POST['subid'];
			$sem=$_POST['sem'];
			$sec=$_POST['sec'];

			$check="select distinct tid from assignclass where sub_id='$subid' and sem=$sem and sec='$sec' and dept='$dept'";
			$execheck=$conn->query($check);
			$rcheck=$execheck->fetch_assoc();

			if($tid == $rcheck['tid']){
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
					$datesql="select distinct adate from attendance where sem='$sem' and sec='$sec' and sub_id='$subid' and tid='$tid'";
					$exedate=$conn->query($datesql);
					$i=0;
					$c=$c+1;
					while($rowadate=$exedate->fetch_assoc()){
						$ad=$rowadate['adate'];
						$insql="select astatus from attendance where usn='$ausn' and adate='$ad' and sem='$sem' and sec='$sec' and sub_id='$subid' and tid='$tid'";
						
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
				else{
					echo "<script type='text/javascript'>alert('This teacher has no access to this class')</script>";
				}
			}
			
		

	?>
        </table>
    </center>
</body>

</html>