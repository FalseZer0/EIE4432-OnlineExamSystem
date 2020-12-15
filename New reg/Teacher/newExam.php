<?php
session_start();

if (isset($_POST['CreateEx'])) {
    require "../mysql-connect.php";
    $userID = $_SESSION['userID'];
    $etitle = $_POST['etitle'];
    $edate = $_POST['edate'];
    $estime = $_POST['estime'];
    $eetime = $_POST['eetime'];
    $qnum = $_POST['enum'];
    $connect = mysqli_connect($server, $user, $pw, $db, $port);
    if (!$connect)
        die("Connection failed: " . mysqli_connect_error());

    //custom autoincrement of the eid based on the exam table
    $sql = "SELECT * FROM exam";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect));
    }
    if (mysqli_num_rows($result) == 0) {
        $eid = 0;
    } else {
        $sql = "SELECT * FROM exam ORDER BY examID DESC LIMIT 1";
        $result = mysqli_query($connect, $sql);
        if (!$result) {
            die("Could not successfully run query." . mysqli_error($connect));
        }
        $row = mysqli_fetch_assoc($result);
        $eid = intval($row['examID']);
        $eid++;
    }
    $sql = "INSERT INTO exam (examID,tID, examTitle, startTime, endTime, questionNum, checked) VALUES ('$eid','$userID','$etitle', '$edate', '$estime','$eetime','$qnum');";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect));
    } else {
        header("Location: ../Teacher/dashboard.php");
        exit();
    }
} else {
    header("Location: ../Teacher/dashboard.php");
    exit();
}
