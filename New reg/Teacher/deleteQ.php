<?php
include "../mysql-connect.php";
$eid = $_GET['eid'];
if (isset($_GET['qid'])) {
    $qid = $_GET['qid'];
    $connect = mysqli_connect($server, $user, $pw, $db, $port);
    $sql = "DELETE FROM questions WHERE qID='$qid';";
    $result =  mysqli_query($connect, $sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect));
    }
    header("Location: ../Teacher/showQ.php?id=" . $eid . "");
    exit();
} else {
    header("Location: ../Teacher/showQ.php?id=" . $eid . "");
    exit();
}
