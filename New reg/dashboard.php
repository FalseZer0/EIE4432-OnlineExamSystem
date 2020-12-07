<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
</head>
<body>
    <?php
        if(isset($_SESSION['userID']))
        {
            echo "yes";
        }
    ?>

    <p>idi nahui</p>
    <form id="login-form" class="form" action="logout.php" method="post">
        <input type="submit" name="LogoutBtn" id="logoutBtn" class="btn btn-outline-info btn-md w-100" value="Logout">
    </form>
</body>
</html>