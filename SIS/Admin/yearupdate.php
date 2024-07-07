<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
//mysqli_report(MYSQLI_REPORT_ERROR);

require_once("../Connection/Connection.php");
$year_update=array( "2021"=>array('1'=>"2022-04-01",'2'=>"2023-04-01",'3'=>"2024-04-01"),
                    "2022"=>array('1'=>"2023-04-01",'2'=>"2024-04-01",'3'=>"2025-04-01"),
                    "2020"=>array('1'=>"2021-04-01",'2'=>"2022-04-01",'3'=>"2023-04-01"),
                    "2023"=>array('1'=>"2024-04-01",'2'=>"2025-04-01",'3'=>"2026-04-01")
) ;
$qry="SELECT SID,Year,Batch from academicdetails";
if($res=mysqli_query($conn,$qry))
{
    while($result=mysqli_fetch_assoc($res))
    {
        $now=date("Y-m-d");
        $sid=$result['SID'];
        $batch=$result['Batch'];
        $yearto=1;
        if(isset($year_update[$batch]))
        {
            for($i=1;$i<count($year_update[$batch]);$i++)
            {
                if(strtotime($now)>strtotime($year_update[$batch][$i]))
                {
                    $yearto=$i+1;
                }
            }
        }
        $qry0="UPDATE academicdetails set Year=$yearto,Status='Active' where SID='$sid'";
        if($yearto>3)
        {
            $qry0="UPDATE academicdetails set Year=$yearto,Status='InActive' where SID='$sid'";
        }
        mysqli_query($conn,$qry0);
    }
}
?>
</body>
</html>

