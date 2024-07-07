<?php 
if(isset($_SESSION['student']))
    header("Location:Student/dashboard.php");
if(isset($_SESSION['teacher']))
    header("Location:Teacher/dashboard.php");
header("Location:MIndex.php#heyuser");
?>