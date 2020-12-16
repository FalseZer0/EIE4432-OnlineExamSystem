<?php
if(isset($_POST['saveq']))
{
    require "../mysql-connect.php";
    $connect = mysqli_connect($server,$user,$pw,$db,$port);
    if(!$connect)
        die("Connection failed: ".mysqli_connect_error());
    $eid = $_GET['id'];
    $qid = $_POST['id']; 
    $qbody = $_POST['qbody'];
    $qans = $_POST['qans']; 
    $qtype = $_POST['qtype'];    
    $qpoints = $_POST['qpoints']; 
    $qop1 = $_POST['qop1'];
    $qop2 = $_POST['qop2']; 
    $qop3 = $_POST['qop3']; 
    $qop4 = $_POST['qop4'];
     
    $sql = "UPDATE questions SET QBody = '$qbody', Qtype = '$qtype', Qanswer = '$qans', points = '$qpoints', opt1 = '$qop1', opt2 = '$qop2', opt3 = '$qop3', opt4 = '$qop4' WHERE qID='$qid'"; 
    $result = mysqli_query($connect,$sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect) );
    }
    header("Location: ../Teacher/showQ.php?id=".$eid."");
    exit();
}
else{
    header("Location: ../Teacher/showQ.php?id=".$eid."");
    exit();
}



?>