<?php

if(isset($_POST['addq']))
{
    require "../mysql-connect.php";
    $connect = mysqli_connect($server,$user,$pw,$db,$port);
    if(!$connect)
        die("Connection failed: ".mysqli_connect_error());
    
    $eid = $_POST['id']; 
    $qbody = $_POST['qbody'];
    $qans = $_POST['qans']; 
    $qtype = $_POST['qtype'];    
    $qpoints = $_POST['qpoints']; 
    $qop1 = $_POST['qop1'];
    $qop2 = $_POST['qop2']; 
    $qop3 = $_POST['qop3']; 
    $qop4 = $_POST['qop4'];  
    $sql = "INSERT INTO questions (examID, QBody, Qtype, Qanswer, points, opt1, opt2, opt3, opt4) VALUES ('$eid','$qbody', '$qtype', '$qans','$qpoints','$qop1','$qop2','$qop3','$qop4');";
    $result = mysqli_query($connect,$sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect) );
    }
    header("Location: ../Teacher/viewExamT.php");
    exit();
}
else{
    header("Location: ../Teacher/viewExamT.php?error=qerror");
    exit();
}


?>


