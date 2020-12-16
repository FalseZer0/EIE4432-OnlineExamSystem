<?php
session_start();
$userID = $_SESSION['userID'];
include "../mysql-connect.php";
$connect = mysqli_connect($server, $user, $pw, $db, $port);
$eid = $_POST['examid'];
if (isset($_POST['submit'])) {
    $date = new DateTime("now", new DateTimeZone('Asia/Almaty'));
    $submittime = $date->format('H:i');
    $sql = "SELECT * FROM exam WHERE examID = '$eid' AND tID = '$userID'";
    $result =  mysqli_query($connect, $sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect));
    }
    $row = mysqli_fetch_assoc($result);
    if ($row['checked'] == 0) {
        //updating the checked status and submitted time
        $sql = "UPDATE exam SET checked = 1, submitTime = '$submittime' WHERE tID='$userID'";
        $result =  mysqli_query($connect, $sql);
        if (!$result) {
            die("Could not successfully run query." . mysqli_error($connect));
        }
        //checking starts
        $totalscore = 0;
        $userscore = 0;
        foreach ($_POST as $i => $value) {
            if (preg_match("/^\d+$/", $i)) {
                //insert user answer
                $sql = "INSERT INTO answers (qID, examID, tID, uAnswer) VALUES ('$i','$eid','$userID','$value') ";
                $result =  mysqli_query($connect, $sql);
                if (!$result) {
                    die("Could not successfully run query." . mysqli_error($connect));
                }
                //calculating 
                $sql = "SELECT * FROM questions WHERE qID = '$i'";
                $result =  mysqli_query($connect, $sql);
                if (!$result) {
                    die("Could not successfully run query." . mysqli_error($connect));
                }
                $row = mysqli_fetch_assoc($result);
                $totalscore += $row['points'];
                if ($value == $row['Qanswer']) {
                    $userscore += $row['points'];
                }
            }
        }
        $grade = $userscore;
        $sql = "INSERT INTO mark (tID, examID, grade,maxscore) VALUES ('$userID','$eid','$grade','$totalscore')";
        $result =  mysqli_query($connect, $sql);
        if (!$result) {
            die("Could not successfully run query." . mysqli_error($connect));
        }
        header("Location: ../Student/dashboardS.php");
        exit();
    } else {
        //alternative checking
        $sql = "UPDATE exam SET checked = 1, submitTime = '$submittime' WHERE tID='$userID'";
        $result =  mysqli_query($connect, $sql);
        if (!$result) {
            die("Could not successfully run query1." . mysqli_error($connect));
        }
        //checking starts
        $totalscore = 0;
        $userscore = 0;
        foreach ($_POST as $i => $value) {
            if (preg_match("/^\d+$/", $i)) {
                //insert user answer
                $sql = "UPDATE answers SET uAnswer = '$value' WHERE tID='$userID' AND qID='$i' AND examID ='$eid'";
                $result =  mysqli_query($connect, $sql);
                if (!$result) {
                    die("Could not successfully run query2." . mysqli_error($connect));
                }
                //calculating 
                $sql = "SELECT * FROM questions WHERE qID = '$i'";
                $result =  mysqli_query($connect, $sql);
                if (!$result) {
                    die("Could not successfully run query3." . mysqli_error($connect));
                }
                $row = mysqli_fetch_assoc($result);
                $totalscore += $row['points'];
                if ($value == $row['Qanswer']) {
                    $userscore += $row['points'];
                }
            }
        }
        $grade = $userscore;
        $sql = "UPDATE mark SET grade = '$grade', maxscore = '$totalscore' WHERE tID = '$userID' AND examID = '$eid'";
        $result =  mysqli_query($connect, $sql);
        if (!$result) {
            die("Could not successfully run query4." . mysqli_error($connect));
        }
        header("Location: ../Student/dashboardS.php");
        exit();
    }
} else {
    header("Location: ../Student/dashboardS.php");
    exit();
}
