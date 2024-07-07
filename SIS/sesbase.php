<?php
    session_start();
    $SessionBase=array(null,null);
    if(isset($_SESSION['student']))
    {
        $user=$_SESSION['student'];
        require_once("Connection/Connection.php");
        $qry="SELECT * FROM student where SID='$user'";
        if($result=mysqli_query($conn,$qry))
        {
            $SessionBase=mysqli_fetch_array($result);
        }
    }
    if(isset($_SESSION['teacher']))
    {
        $user=$_SESSION['teacher'];
        require_once("Connection/Connection.php");
        $qry="SELECT * FROM teacher where TID='$user'";
        if($result=mysqli_query($conn,$qry))
        {
            $SessionBase=mysqli_fetch_array($result);
        }
    }
   
    
?>