<?php
if(isset($_POST['ResetBtn']))
{
    require "../mysql-connect.php";
    $connect = mysqli_connect($server,$user,$pw,$db,$port);
    if(!$connect)
        die("Connection failed: ".mysqli_connect_error());
    
    $magic = $_POST['magic'];
    $uid = $_POST['userid'];
    $pass = $_POST['password'];
    $sql = "SELECT * FROM user WHERE tID='$uid'";
    $result = mysqli_query($connect,$sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect) );
    }
    if(mysqli_num_rows($result)>0)
    {
        $row = mysqli_fetch_assoc($result);
        if(strcmp($row['job'], "student")!=0)
        {
            header("Location: ../loginS/loginS.php?error=wronguser");
            exit();
        } 
        if($row['magicN']==$magic)
        {
            $sql2 = "UPDATE user SET pwd = '$pass' WHERE tID = '$uid'";
            mysqli_query($connect,$sql2);
            header("Location: ../loginS/loginS.php");
        }
        else{
            header("Location: ../loginS/resetPS.php?error=nomagic");
            exit();
        }
    }
    else{
        header("Location: ../loginS/resetPS.php?error=nouser");
        exit();
    }
}
else{
    header("Location: ../loginS/loginS.php");
    exit();
}
