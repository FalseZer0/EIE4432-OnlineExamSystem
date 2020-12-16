<?php
if (isset($_POST['LoginBtn'])) {
    require "../mysql-connect.php";
    $connect = mysqli_connect($server, $user, $pw, $db, $port);
    if (!$connect)
        die("Connection failed: " . mysqli_connect_error());
    $uid = $_POST['userid'];
    $pass = $_POST['password'];
    $sql = "SELECT * FROM user WHERE tID='$uid'";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 0) {
        header("Location: ../loginS/loginS.php?error=usernot");
        exit();
    }
    if ($row = mysqli_fetch_assoc($result)) {
        if (strcmp($row['job'], "student") != 0) {
            header("Location: ../loginS/loginS.php?error=wronguser");
            exit();
        }
        if ($pass == $row['pwd']) {
            session_start();
            if (!empty($_POST['remember'])) {
                setcookie("suid", $uid, time() + (10 * 365 * 24 * 60 * 60), '/');
                setcookie("spassword", $pass, time() + (10 * 365 * 24 * 60 * 60), '/');
            } else {
                if (isset($_COOKIE["suid"])) {
                    setcookie("suid", "", time() - 3600, '/');
                }
                if (isset($_COOKIE["spassword"])) {
                    setcookie("spassword", "", time() - 3600, '/');
                }
            }
            $_SESSION['userID'] = $row['tID'];
            header("Location: ../Student/dashboardS.php");
            exit();
        } else if ($pass != $row['pwd']) {
            header("Location: ../loginS/loginS.php?error=wrongpwd");
            exit();
        }
    }
} else {
    header("Location: ../loginS/loginS.php");
    exit();
}
