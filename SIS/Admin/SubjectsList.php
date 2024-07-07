<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="MyStyles.css">
    <?php include_once("../Connection/connection.php");
        //mysqli_report(MYSQLI_REPORT_ERROR);
    ?>
</head>
<style>

</style>
<body>
<?php include_once("navbar.php"); ?>
<div class="container" style="display:flex;flex-direction:column;">
<!-- <a class="btn btn-dark" href="dashboard.php">Go to Dashboard</a>  -->
<form action="" class="col-md-12" method="get">
    <table class="table table-bordered">
        <thead>
            <th>Subject Title</th>
            <th>Subject Type</th>
            <th colspan="2" style="text-align:center;">Actions</th>
</thead>
<tbody>
    <?php
    $qry="SELECT * from school_subjects;";
    if($res=mysqli_query($conn,$qry))
    {
        while($result=mysqli_fetch_assoc($res))
        {
            $subid=$result['Subject_ID'];
            //echo $subid;
            echo "<tr>";
             echo "<td><input type='text' required class='form-control' name='Subject_Title_$subid' value='".$result['Subject_Title']."' ></td>";
            echo "<td><input type='text' required class='form-control' palceholder='Theory/Practical' pattern='Theory|Practical' name='Subject_Type_$subid' value='".$result['Subject_Type']."'></td>";
            echo "<td style-'text-align: center;'><button type='submit' class='btn btn-warning' name='Edit' value='".$result['Subject_ID']."'>Edit</button></td>";
            echo "<td style-'text-align: center;'><button type='submit' class='btn btn-danger' name='Delete' value='".$result['Subject_ID']."'>Delete</button></td>";
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
    $qry="DELETE FROM school_subjects where Subject_ID=$deleteid";
    if(mysqli_query($conn,$qry))
    {
        echo "<script>alert('Delete Success');</script>";
        //header("Location:SchoolSubjects.html");
        echo "<script>window.location.href='SubjectsList.php'</script>";

    }
    else
    {
        echo "<script>alert('Delete Failed');</script>";
    }
}
if(isset($_GET['Edit']))
{
     $editid=$_GET['Edit'];
    $subtitle=$_GET["Subject_Title_$editid"];
    $subtype=$_GET["Subject_Type_$editid"];
    $qry="UPDATE school_subjects set Subject_Title='$subtitle',Subject_Type='$subtype' where Subject_ID=$editid";
    if(mysqli_query($conn,$qry))
    {
       
       echo "<script>alert('Update Success');</script>";
       echo "<script>window.location.href='SubjectsList.php'</script>";
   }
   else
   echo "<script>alert('Update Failed');</script>";
}
?>
</form>
</div>
</body>
</html>