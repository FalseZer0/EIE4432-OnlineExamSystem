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
    $sql = "SELECT * FROM teacher WHERE tID='$uid'";
    $result = mysqli_query($connect,$sql);
    if (!$result) {
        die("Could not successfully run query." . mysqli_error($connect) );
    }
    if(mysqli_num_rows($result)>0)
    {
        $row = mysqli_fetch_assoc($result);
        if($row['magicN']==$magic)
        {
            $sql2 = "UPDATE teacher SET pwd = '$pass' WHERE tID = '$uid'";
            mysqli_query($connect,$sql2);
            header("Location: ../loginT/loginT.php");
        }
        else{
            header("Location: ../loginT/resetPT.php?error=nomagic");
            exit();
        }
    }
    else{
        header("Location: ../loginT/resetPT.php?error=nouser");
        exit();
    }

    // $sql = "SELECT * FROM teacher WHERE tID='$uid';";
    // // $sql.= "UPDATE teacher SET pwd = '$pass' WHERE tID = '$uid'";
    // $result = mysqli_multi_query($connect,$sql);
    // if (!$result) {
    //     die("Could not successfully run query." . mysqli_error($connect) );
    // }
    // $temp = mysqli_store_result($connect);
    // if (mysqli_num_rows($temp)>0) {
    //     $row = mysqli_fetch_assoc($temp);
    //     if($row['magicN']==$magic)
    //     {
    //         mysqli_next_result($connect);
    //         // header("Location: ../loginT/loginT.php");
    //         // exit();
    //         echo $row['magicN']
    //     }
    //     else{
    //         header("Location: ../loginT/loginT.php?error=nomagic");
    //         exit();
    //     }
    // }
    // else
    // {
    //     header("Location: ../loginT/loginT.php?error=nouser");
    //     exit();
    // }

}
else{
    header("Location: ../loginT/loginT.php");
    exit();
}
