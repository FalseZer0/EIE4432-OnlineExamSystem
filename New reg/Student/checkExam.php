<?php
session_start();
$userID = $_SESSION['userID']; 
include "../mysql-connect.php";
if(isset($_POST['submit']))
{
    print_r($_POST);
}