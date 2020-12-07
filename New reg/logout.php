<?php
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../New Reg/init.php");
?>
