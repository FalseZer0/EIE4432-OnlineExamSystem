<?php
if (isset($_POST['RegisterBtn'])) {
    require "../mysql-connect.php";
    $connect = mysqli_connect($server, $user, $pw, $db, $port);
    if (!$connect)
        die("Connection failed: " . mysqli_connect_error());
    $userid = $_POST['userid'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['conf-password'];
    $email = $_POST['email'];
    $bday = $_POST['ebdaydate'];
    $gender = $_POST['gender'];
    $magic = $_POST['magic'];
    //processing images uploaded
    $target = "../images/" . basename($_FILES['image']['name']);
    $image = $_FILES['image']['name'];
    //moving uploaded file to server folder
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        header("Location: ../registerT/registerS.php?error=imgerror");
        exit();
    }
    $userQuery = "SELECT tID FROM user WHERE tID='$userid';";
    $result = mysqli_query($connect, $userQuery);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect));
    } else {
        if (mysqli_num_rows($result) > 0) {
            header("Location: ../registerT/registerS.php?error=usertaken");
            exit();
        } else {
            $sql = "INSERT INTO user (tID,fName,lName,job,email,courseID,imagePath,pwd,magicN,gender,bday) VALUES ('$userid','$firstname','$lastname','student','$email',null,'$image','$password','$magic','$gender','$bday')";
            $result = mysqli_query($connect, $sql);
            if (!$result) {
                die("Could not successfully run query." . mysqli_error($connect));
            }

            header("Location: ../loginS/loginS.php");
            exit();
        }
    }
} else {
    header("Location: ../registerT/registerS.php");
    exit();
}
