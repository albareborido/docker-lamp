<?php
    session_start();
    $SESSION = array();
    session_destroy();
    header("Location:login.php");

?>