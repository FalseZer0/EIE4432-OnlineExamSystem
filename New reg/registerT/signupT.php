<?php
    if(isset($_POST['RegisterBtn']))
    {
        require "../mysql-connect.php";
        $connect = mysqli_connect($server,$user,$pw,$db,$port);
        if(!$connect)
            die("Connection failed: ".mysqli_connect_error());
        $userid = $_POST['userid'];
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['conf-password'];
        $email = $_POST['email'];
        $course = $_POST['courseid'];
        $imagepath = $_POST['images'];
        $magic = $_POST['magic'];
        $userQuery = "SELECT tID FROM teacher WHERE tID='$userid';";
        $userQuery.= "INSERT INTO teacher (tID,fName,lName,email,courseID,imagePath,pwd,magicN) VALUES ('$userid','$firstname','$lastname','$email','$course','$imagepath','$password','$magic')";
        
        $result = mysqli_multi_query($connect,$userQuery);
        if (!$result) {
            die("Could not successfully run query." . mysqli_error($connect) );
        }
        else{
            $temp = mysqli_store_result($connect);
            if(mysqli_num_rows($temp)>0)
            {
                header("Location: ../registerT/registerT.php?error=usertaken");
                exit();
            }
            else{
                mysqli_next_result($connect);
                $temp = mysqli_store_result($connect);
                header("Location: ../loginT/loginT.php");
                exit();

            }

        }
    }
    else{
        header("Location: ../registerT/registerT.php");
        exit();
    }