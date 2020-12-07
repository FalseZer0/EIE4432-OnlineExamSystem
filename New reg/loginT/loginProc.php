<?php
if(isset($_POST['LoginBtn']))
{
    require "../mysql-connect.php";
    $connect = mysqli_connect($server,$user,$pw,$db,$port);
    if(!$connect)
        die("Connection failed: ".mysqli_connect_error());
    
    $uid = $_POST['userid'];
    $pass = $_POST['password'];
    $sql = "SELECT * FROM teacher WHERE tID='$uid' OR pwd='$pass'";
    $result = mysqli_query($connect,$sql);
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
            header("Location: ../dashboard.php");
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
