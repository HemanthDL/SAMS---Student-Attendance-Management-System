<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include('../connection.php');
        session_start();
        $tid=$_SESSION['tid'];
        $dept=$_SESSION['dept'];
        if(isset($_POST['submit'])){
            $subid = $_POST['sub_id'];
            $sec = $_POST['sec'];
            $sem = $_POST['sem'];
            $entered = $_POST['adate'];
            $check = "select distinct adate from attendance where sem='$sem' and sec='$sec' and sub_id='$subid' and tid='$tid' order by adate asc";
            $checkexe = $conn->query($check);
            echo "details: ".$subid."\t".$sec."\t".$sem."\t".$entered."\t".$tid."\t";
            while($r = $checkexe->fetch_assoc()){
                // echo "date : ".$r['adate']."\t";
                // $db_date = strtotime($r['adate']); 
                // $entered_date = strtotime($entered);
                // echo "timestamp: ".$db_date."\tenr: ".$entered_date."\t";
                if($db_date == $entered_date){
                    echo "<script type='text/javascript'>alert('Attendance Limit for the day is reached!!\nEnter New Date')</script>";
                    
                }
            }
            header('Location:markattendance.php');
                    exit(); 
        }

    ?>
</body>
</html>