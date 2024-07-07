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
    <form action="" method="get" class="col-md-12">
            <table class="table table-bordered">
                <thread> 
                    <th>Department Name</th>
                    <th>HOD Name</th>
                    <th>Started</th>
                    <th>HOD Contact No</th>
                    <th>HOD Mail</th>
                    <th>College Name</th>
                    <th colspan="2" styles="text-align:center;">Actions</th>
</thread>
<tbody>
<caption>One Record at a Time</caption>
    <?php
    $qry="SELECT * from department;";
    if($res=mysqli_query($conn,$qry))
    {
        while($result=mysqli_fetch_assoc($res))
        {
            $did=$result['DID'];
            //echo $did;
            echo "<tr>";
            echo "<td><input type='text' required class='form-control' name='DName_$did' value='".$result['DName']."'></td>";
            echo "<td><input type='text' required class='form-control' name='Head_$did' value='".$result['Head']."'></td>";
            echo "<td><input type='date' required class='form-control' name='Started_$did' value='".$result['Started']."'></td>";
            echo "<td><input type='number'  class='form-control' name='HeadNo_$did' value='".$result['HeadNo']."'></td>";
            echo "<td><input type='email' class='form-control' name='HeadMail_$did' value='".$result['HeadMail']."'></td>";
            echo"<td><select class='form-control' name='CID_$did'>";
            $qry="SELECT CID,CollegeName from college";
            if($res1=mysqli_query($conn,$qry))
            {
                while($result1=mysqli_fetch_assoc($res1))
                {
                    $cid=$result1['CID'];
                    $cname=$result1['CollegeName'];
                    echo "<option value='$cid'";
                    if($cid==$result['CID'])
                    echo "selected";
                    echo">$cname</option>";

                }
            }
            echo "</select></td>";
            echo "<td style=text-align; center;'><button type='submit' class='btn btn-success' name='Edit' value='".$result['DID']."'>Update</button></td>";
            echo "<td style=text-align; center;'><button type='submit' class='btn btn-danger' name='Delete' value='".$result['DID']."'>Delete</button></td>";
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
            $qry="DELETE FROM department where DID=$deleteid";
            if(mysqli_query($conn,$qry))
            {
                echo "<script>alert('Delete Success');</script>";
                echo "<script> window.location.href='DepartmentList.php' </script>";
            }
            else
            echo "<script>alert('Delete Failed');</script>";
          }    
    ?>
    <?php
    if(isset($_GET['Edit']))
    {
        //print_r($_GET);
        $editid=$_GET['Edit'];
        $dname=$_GET["DName_$editid"];
        $head=$_GET["Head_$editid"];
        $started=$_GET["Started_$editid"];
        $headno=$_GET["HeadNo_$editid"];
        $headmail=$_GET["HeadMail_$editid"];
        $cid=$_GET["CID_$editid"];
        $qry="UPDATE department SET DName='$dname',Head='$head',Started='$started',HeadNo='$headno',HeadMail='$headmail',CID='$cid' where DID=$editid";
        if(mysqli_query($conn,$qry))
        {
            echo "<script>alert('Update Success');</script>";
            echo "<script> window.location.href='DepartmentList.php' </script>";
        }
        else
        echo "<script>alert('Update Failed');</script>";
       

    }
?>
</form>
</div>
</body>
</html>
