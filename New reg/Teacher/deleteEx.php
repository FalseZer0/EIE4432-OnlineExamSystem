<?php
include "../mysql-connect.php";

if (isset($_GET['id'])) {
    $eid = $_GET['id'];
    $connect = mysqli_connect($server, $user, $pw, $db, $port);
    $sql = "DELETE FROM exammain WHERE examID='$eid';";
    $result =  mysqli_query($connect, $sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect));
    }
    header("Location: ../Teacher/viewExamT.php");
    exit();
} else {
    header("Location: ../Teacher/viewExamT.php");
    exit();
}
