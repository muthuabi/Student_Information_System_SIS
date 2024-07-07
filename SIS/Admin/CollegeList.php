<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
</head>
<body>
 <?php 
    //mysqli_report(MYSQLI_REPORT_ERROR);
    include_once("../Connection/connection.php");
    
    ?>
    <?php include_once("navbar.php"); ?>
<div class="container">
<!-- <a class="btn btn-dark" href="dashboard.php">Go to Dashboard</a>  -->
    <div class="container">
        <form action="" method="get" class="col-md-12">
            <table class="table table-bordered">
                <thread>
                    <th>College Name</th>
                    <th>College Location</th>
                    <th>Started</th>
                    <th>Principal Name</th>
                    <th>Colllege Type</th>
                    <th>College Mail</th>
                    <th>CollegeNumber</th>
                    <th colspan="2" styles="text-align:center;">Actions</th>
</thread>
<tbody>
    <caption>One Record at a Time</caption>
    <?php
    $qry="SELECT * from college";
    if($res=mysqli_query($conn,$qry))
    {
        while($result=mysqli_fetch_assoc($res))
        {
            $cid=$result['CID'];
            
            echo "<tr>";
            echo "<td><input type='text' class='form-control' name='CollegeName_$cid' value=";
            echo escapeshellarg($result['CollegeName']);
            echo"></td>";
            echo "<td><input type='text' class='form-control' name='Location_$cid' value=".escapeshellarg($result['Location'])."></td>";
            echo "<td><input type='date' class='form-control' name='EstablishedDate_$cid' value='".$result['EstablishedDate']."'></td>";
            echo "<td><input type='text' class='form-control' name='PrincipalName_$cid' value='".$result['PrincipalName']."'></td>";
            echo "<td><input type='text' class='form-control' name='CollegeType_$cid' value='".$result['CollegeType']."'></td>";
            echo "<td><input type='email' class='form-control' name='ContactMail_$cid' value='".$result['ContactMail']."'></td>";
            echo "<td><input type='number' class='form-control' name='ContactNumber_$cid' value='".$result['ContactNumber']."'></td>";
            echo "<td style=text-align; center;'><button type='submit' class='btn btn-success' name='Edit' value='".$result['CID']."'>Update</button></td>";
            echo "<td style=text-align; center;'><button type='submit' class='btn btn-danger' name='Delete' value='".$result['CID']."'>Delete</button></td>";
            echo "</tr>";
    

        }  
    }
    ?>
</tbody>
</table>
    <?php
          if(isset($_GET['Delete']))
          {
            $deleteid=$_GET['Delete'];
            $qry="DELETE FROM college where CID=$deleteid";
            echo "Deletede";
            if(mysqli_query($conn,$qry))
            {
                echo "<script>alert('Deleted')</script>";
                echo "<script> window.location.href='CollegeList.php' </script>";
            }
            else
            {
                echo "<script>alert('Delete Failed');</script>";
            }
          }    
    ?>
    <?php
    if(isset($_GET['Edit']))
    {
       
        $editid=$_GET['Edit'];
       $cname=$_GET["CollegeName_$editid"];
       $cname=mysqli_real_escape_string($conn,$cname);
         $chead=$_GET["PrincipalName_$editid"];
        $cstarted=$_GET["EstablishedDate_$editid"];
       $cheadno=$_GET["ContactNumber_$editid"];
     $cheadmail=$_GET["ContactMail_$editid"];
        $ctype=$_GET["CollegeType_$editid"];
       $clocation=$_GET["Location_$editid"];
       $clocation=mysqli_real_escape_string($conn,$clocation);
        $qry="UPDATE college set CollegeName='$cname',PrincipalName='$chead',EstablishedDate='$cstarted',ContactNumber=$cheadno,ContactMail='$cheadmail',CollegeType='$ctype',Location='$clocation' where CID=$editid";
        if(mysqli_query($conn,$qry))
        {
            echo "<script>alert('Update Success');</script>";
           echo "<script> window.location.href='CollegeList.php' </script>";
        }
        else
        echo "<script>alert('Update Failed');</script>";
       

    }
?>
</form>
</div>
</body>
</html>