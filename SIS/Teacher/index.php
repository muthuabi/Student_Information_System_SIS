
<?php 
session_start();
if(isset($_SESSION['teacher']))
{
    $teacher=$_SESSION['teacher'];
    header("Location:dashboard.php");
}
else 
{
    header("Location:../Login.php?Loger=Teacher");
}
?>

