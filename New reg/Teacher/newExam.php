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

    $sql = "INSERT INTO exammain (examTitle, examDate, startTime, endTime, questionNum) VALUES ('$etitle', '$edate', '$estime','$eetime','$qnum');";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect));
    } else {
        $sql = "SELECT examID FROM exammain ORDER BY examID DESC LIMIT 1";
        $result = mysqli_query($connect, $sql);
        if (!$result) {
            die("Could not successfully run query." . mysqli_error($connect));
        }
        $row = mysqli_fetch_assoc($result);
        $eid = $row['examID'];
        $sql = "INSERT INTO exam (examID, tID, checked) VALUES ('$eid' ,'$userID', 0);";
        $result = mysqli_query($connect, $sql);
        if (!$result) {
            die("Could not successfully run query." . mysqli_error($connect));
        }
        header("Location: ../Teacher/dashboard.php");
        exit();
    }
} else {
    header("Location: ../Teacher/dashboard.php");
    exit();
}
