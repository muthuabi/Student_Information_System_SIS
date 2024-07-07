<?php
    require_once("Connection/Connection.php");
    $qry="Select CID,CollegeName from college order by CollegeName";
    $r=mysqli_query($conn,$qry);
    $jsonar=[];
    while($res=mysqli_fetch_assoc($r))
    {
        $jsonar[]=$res;
    }
    echo json_encode($jsonar);

?>