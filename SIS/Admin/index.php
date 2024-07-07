<?php 
    session_start();
    if(isset($_SESSION['admin']))
    {
        $admin=$_SESSION['admin'];
        header("Location:dashboard.php");
    }
    else 
    {
        header("HTTP/1.0 403 Access Forbidden");
    }
?>
