<?php
    session_start();
    $_SESSION['tredirect']=$_SERVER['REQUEST_URI'];
    if(isset($_SESSION['teacher']))
    {
        $user=$_SESSION['teacher'];
        $teacher=$_SESSION['teacher'];
        require_once("../Connection/Connection.php");
        $qry="SELECT * FROM teacher where TID='$user'";
        if($result=mysqli_query($conn,$qry))
        {
            $SessionBase=mysqli_fetch_assoc($result);
        }
    }
    else
    {
        header("HTTP/1.0 403 Access Forbidden");
        echo "<center><h5>Please Login and Come</h5><a href='../Login.php?Loger=Teacher'>Login Here</a></center>";
        exit(0);
    }
?>