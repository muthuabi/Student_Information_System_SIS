<?php
    require_once("Connection/Connection.php");
    if(isset($_GET['college']))
    {
        $cid=$_GET['college'];

        $qry="Select DID,DName from department where CID='$cid' order by Dname";
        $r=mysqli_query($conn,$qry);
        $jsonar=[];
        while($res=mysqli_fetch_assoc($r))
        {
            $jsonar[]=$res;
        }
        echo json_encode($jsonar);
    }

?>