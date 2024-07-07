<?php
    session_start();
    $_SESSION['aredirect']=$_SERVER['REQUEST_URI'];
    if(isset($_SESSION['admin']))
    {
        $user=$_SESSION['admin'];
        require_once("../Connection/Connection.php");
        $qry="SELECT * FROM admin where ADMINID='$user'";
        if($result=mysqli_query($conn,$qry))
        {
            $SessionBase=mysqli_fetch_assoc($result);
        }
    }
    else
    {
        echo "<center><h5>Please Login and Come</h5><a href='../Login.php?Loger=Admin'>Login Here</a></center>";
        exit(0);
    }
?>