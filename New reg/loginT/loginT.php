<?php
    session_start();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- my css under -->
    <link rel="stylesheet" href="loginT.css">
</head>
<body>
    <div id="loginT">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-8" id="logbox">
                    <form id="login-form" class="form" action="loginProc.php" method="post">
                        <h2 class="text-center">Login</h2>
                        <?php
                            if(isset($_GET['error']))
                            {
                                if($_GET['error']=="wrongpwd")
                                    echo '<p class="error_message">Wrong Login or Password</p>';
                            }
                            
                        ?>
                        <div class="form-group" id ="divid">
                            <label for="userid" >ID</label><br>
                            <input type="text" name="userid" id="userid" class="form-control" value="<?php if(isset($_COOKIE["uid"])) { echo $_COOKIE["uid"]; } ?>" placeholder="e.g 12345667">
                        </div>
                        <div class="form-group" id="divpass">
                            <label for="password" >Password</label><br>
                            <input type="password" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <a href="resetPT.php">Forgot password?</a>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" <?php if(isset($_COOKIE["uid"])) { ?> checked <?php } ?> name="remember" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label"  for="exampleCheck1">Remember <Menu></Menu></label>
                        </div>
                        <div class="form-group">
                            <div class="col text-center">
                                <input type="submit" onclick="return submitForm()" name="LoginBtn" id="logBtn" class="btn btn-outline-info btn-md w-100" value="Login">
                            </div>   
                        </div>
                        <div class="control justify-content-center align-items-center">
                            <span style="float:left;">Not yet registered? <a href="../registerT/registerT.php">Sign Up</a></span>
                            <span style="float:right;"><a href="../init.php">Go back</a></span>  
                        </div>
      
                    </form>
                </div>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="login.js"></script>
</body>
</html>