<html>

<body>
    <?php
        include('../connection.php');
        include('markattendance.php');

        $tid=$_SESSION['tid'];
        $dept=$_SESSION['dept'];
        $adate=$_SESSION['adate'];
        $subid=$_SESSION['sub_id'];
                $sem=$_SESSION['sem'];
                $sec=$_SESSION['sec'];
        if(isset($_POST['submit_attendance'])){
            $attendanceValues = $_POST['attendance'];
        
            foreach($attendanceValues as $usn => $attendanceValue){
                $insql = "INSERT INTO attendance (usn, tid, sub_id, sem, sec, adate, astatus)
                          VALUES ('$usn', '$tid', '$subid', $sem, '$sec', '$adate', '$attendanceValue')";
                $exeinsql = $conn->query($insql);
        
                if (!$exeinsql) {
                    echo "Error: " . $conn->error;
                    // Handle the error appropriately (e.g., log it, display an error message)
                }
            }
        
            echo "Attendance data submitted successfully!";
        }
        ?>
</body>

</html>