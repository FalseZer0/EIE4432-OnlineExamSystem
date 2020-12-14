<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- my css under -->
    <link rel="stylesheet" href="registerT.css">

</head>
<body>
    <div id="registration">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-8" id="regbox">
                    <form enctype="multipart/form-data" id="signup-form" class="form" action="signupT.php" method="post">
                        <h2 class="text-center">Register</h2>
                        
                        <?php
                            if(isset($_GET['error']))
                            {
                                if($_GET['error']=="usertaken")
                                    echo '<p class="error_message">User already exists</p>';
                            }
                            
                        ?>
                        <div class="form-group" id="did">
                            <label for="userid" >ID</label><br>
                            <input type="text" name="userid" id="userid" class="form-control" placeholder="e.g12345678">
                        </div>
                        <div class="form-group" id="dlname">
                            <label for="lastname" >Last name</label><br>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="e.g Smith">
                        </div>
                        <div class="form-group" id="dfname">
                            <label for="firstname" >First name</label><br>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="e.g John">
                        </div>
                        <div class="form-group">
                            <label for="password" >Password</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group" id="dpass">
                            <label for="conf-password" >Confirm Password</label><br>
                            <input type="password" name="conf-password" id="conf_password" class="form-control">
                        </div>
                        <div class="form-group" id="dmail">
                            <label for="email" >Email</label><br>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Mike@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="fileup">Upload profile picture</label>
                            <input type="file" name="image" class="form-control-file" id="fileup">
                        </div>
                        <div class="form-group" id="courseidform">
                            <label for="courseid">Course ID</label><br>
                            <input type="courseid" name="courseid" id="courseid" class="form-control">
                        </div>
                        <div class="form-group" id="magicnumber">
                            <label for="magic">Enter you magic number (used if password is forgotten)</label><br>
                            <input type="magic" name="magic" id="magic" placeholder="5 digits" class="form-control">
                        </div>
                        <div class="form-group">
                              <div class="col text-center">
                                <input type="submit" onclick="return submitForm()" name="RegisterBtn" id="regBtn" class="btn btn-outline-info btn-md w-100" value="register">
                              </div>   
                        </div>
                        <!-- //sda       -->
                        <div class="control justify-content-center align-items-center">
                            <span style="float:left;">Already registered? <a href="../loginT/loginT.php">Sign in</a></span>
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
<script src="signup.js"></script>
</body>
</html>