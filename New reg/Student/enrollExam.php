<?php
session_start();
$userID = $_SESSION['userID'];
include "../mysql-connect.php";
if (isset($_GET['id'])) {
    $eid = $_GET['id'];
    $connect = mysqli_connect($server, $user, $pw, $db, $port);
    $sql = "SELECT * FROM exam WHERE examID = '$eid' LIMIT 1";
    $result =  mysqli_query($connect, $sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect));
    }
    $row = mysqli_fetch_assoc($result);

    $sql = "INSERT INTO exam (examID,tID, checked) VALUES ('$eid','$userID', 0);";
    $result =  mysqli_query($connect, $sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect));
    }
    header("Location: ../Student/dashboardS.php");
    exit();
} else {
    header("Location: ../Student/dashboardS.php");
    exit();
}
