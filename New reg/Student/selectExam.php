<?php
session_start();
include "../mysql-connect.php";
$q = intval($_GET['q']);
$connect = mysqli_connect($server, $user, $pw, $db, $port);
$userID = $_SESSION['userID'];
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM exammain WHERE examID = '$q'";
$result = mysqli_query($connect, $sql);
if (!$result) {
    die("Could not successfully run query.");
}
if (mysqli_num_rows($result) == 0) {
    print '<div class="alert alert-danger" role="alert">No such exam was found</div>';
} else {
    $row = mysqli_fetch_assoc($result);
    $sql = "SELECT * FROM exam WHERE examID = '$q' AND tID = '$userID'";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die("Could not successfully run query.");
    }
    if (mysqli_num_rows($result) != 0) {
        print '<div class="alert alert-danger" role="alert">User is already enrolled in this exam</div>';
    } else {
        print '<table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Exam ID</th>
                <th>Exam title</th>
                <th>Date</th>
                <th>Start time</th>
                <th>End time</th>
                <th>Enroll</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>' . $row['examID'] . '</td>
                <td>' . $row['examTitle'] . '</td>
                <td>' . $row['examDate'] . '</td>
                <td>' . $row['startTime'] . '</td>
                <td>' . $row['endTime'] . '</td>
                <td><a type="button" href="../Student/enrollExam.php?id=' . $row['examID'] . '" class="btn btn-success btn-sm">Enroll exam</a></td>
            </tr>
        </tbody>
    </table>';
    }
}
mysqli_close($connect);
