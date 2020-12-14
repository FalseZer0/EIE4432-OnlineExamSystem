<?php
if(isset($_POST['LoginBtn']))
{
    require "../mysql-connect.php";
    $connect = mysqli_connect($server,$user,$pw,$db,$port);
    if(!$connect)
        die("Connection failed: ".mysqli_connect_error());
    
    $uid = $_POST['userid'];
    $pass = $_POST['password'];
    $sql = "SELECT * FROM user WHERE tID='$uid'";
    $result = mysqli_query($connect,$sql);
    if(mysqli_num_rows($result)==0)
    {
        header("Location: ../loginT/loginT.php?error=usernot");
        exit();
    }
    if($row = mysqli_fetch_assoc($result))
    {
        if($pass==$row['pwd'])
        {
            session_start();
            if(!empty($_POST['remember']))
            {
                setcookie ("uid",$uid,time()+ (10 * 365 * 24 * 60 * 60),'/');  
                setcookie ("password",$pass,time()+ (10 * 365 * 24 * 60 * 60),'/');
            }
            else
            {
                if(isset($_COOKIE["uid"]))   
                {  
                    setcookie ("uid","",time()-3600,'/');  
                }  
                if(isset($_COOKIE["password"]))   
                {  
                    setcookie ("password","",time()-3600,'/');  
                }  
            }
            $_SESSION['userID'] = $row['tID'];
            header("Location: ../Teacher/dashboard.php");
            exit();
        }
        else if($pass!=$row['pwd']){
            header("Location: ../loginT/loginT.php?error=wrongpwd");
            exit();
        }
    }


}
else{
    header("Location: ../loginT/loginT.php");
    exit();
}
