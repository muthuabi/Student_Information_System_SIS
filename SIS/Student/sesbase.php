<?php
    session_start();
    $_SESSION['sredirect']=$_SERVER['REQUEST_URI'];
    //print_r($_SESSION);
    if(isset($_SESSION['student']))
    {
        $user=$_SESSION['student'];
        require_once("../Connection/Connection.php");
        $qry="SELECT * FROM student where SID='$user'";
        if($result=mysqli_query($conn,$qry))
        {
            $SessionBase=mysqli_fetch_assoc($result);
        }
    
    }
    else
    {
        echo "<center><h5>Please Login and Come</h5><a href='../Login.php?Loger=Student'>Login Here</a></center>";
        exit(0);
    }
?>